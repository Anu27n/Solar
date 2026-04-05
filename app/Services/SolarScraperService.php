<?php

namespace App\Services;

use App\Models\SolarProduct;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class SolarScraperService
{
    protected Client $client;
    protected string $baseUrl;
    protected array $visitedUrls = []; // Performance: Cache to prevent infinite loops

    public function __construct()
    {
        $this->baseUrl = rtrim(config('scraper.base_url', 'https://www.uprsolargreenenergy.com'), '/');
        $this->client = new Client([
            'base_uri' => $this->baseUrl . '/',
            'timeout'  => 30.0,
            'headers'  => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ]
        ]);
    }

    public function scrape(): void
    {
        $urlsToScrape = [
            '/' => 'General',
            '/products' => 'Products',
            '/services' => 'Services',
            '/solar-panels' => 'Solar Panels',
            '/inverters' => 'Inverters'
        ];

        foreach ($urlsToScrape as $url => $category) {
            $this->scrapePage($url, $category);
        }
    }

    protected function scrapePage(string $url, string $defaultCategory): void
    {
        // Performance: Skip if already visited
        $fullUrlPath = parse_url($url, PHP_URL_PATH) ?? $url;
        if (in_array($fullUrlPath, $this->visitedUrls)) {
            return;
        }
        $this->visitedUrls[] = $fullUrlPath;

        try {
            $response = $this->client->get(ltrim($url, '/'));
            $html = (string) $response->getBody();
            if (empty(trim($html))) return;

            $crawler = new Crawler($html, $this->baseUrl);

            // Accuracy: More specific selectors, targeting exact structural content blocks
            $selectors = 'article, .product-card, .service-card, [data-testid="product-card"], .item-details, .elementor-widget-theme-post-content';
            
            $crawler->filter($selectors)->each(function (Crawler $node) use ($url, $defaultCategory) {
                // Feature 1: Fallback logic for Name Extraction
                $name = $this->extractText($node, 'h1, h2, h3, .title, .product-title, strong');
                
                // Data Quality: Hard guards against generic layout strings
                $bannedNames = ['read more', 'learn more', 'buy now', 'click here', 'contact us', 'home', 'menu'];
                if (!$name || strlen($name) < 3 || in_array(strtolower($name), $bannedNames)) {
                    return;
                }

                $price = $this->extractText($node, '.price, .amount, .woocommerce-Price-amount', true);
                
                // Feature 2: Fallback logic for Description Extraction
                $description = $this->extractText($node, 'p, .description, .summary, .excerpt', false, true);
                $shortDescription = $description ? mb_strimwidth($description, 0, 150, '...') : null;
                
                // Validate Image - Check primary img tag, then data attributes, then inline background images
                $imageUrl = $this->extractImage($node, 'img, .product-image, [style*="background-image"]');
                
                $link = $this->extractLink($node, 'a');
                $sourceUrl = $link ? $link : $this->baseUrl . ltrim($url, '/');
                $sourceUrl = filter_var($sourceUrl, FILTER_VALIDATE_URL) ? $sourceUrl : $this->baseUrl . '/' . ltrim($sourceUrl, '/');

                SolarProduct::updateOrCreate(
                    ['source_url' => $sourceUrl],
                    [
                        'name' => $name,
                        'category' => $this->extractText($node, '.category, .badge, .tag, [rel="tag"]') ?: $defaultCategory,
                        'short_description' => $shortDescription,
                        'price' => $price,
                        'description' => $description,
                        'image_url' => $imageUrl,
                        'contact_info' => "UPR Solar Green Energy\nWebsite: " . $this->baseUrl,
                        'scraped_at' => now(),
                    ]
                );
            });

            $this->handlePagination($crawler, $defaultCategory);
        } catch (\Exception $e) {
            Log::error("Scraper Error on {$url}: " . $e->getMessage());
        }
    }

    protected function handlePagination(Crawler $crawler, string $defaultCategory): void
    {
        $crawler->filter('.pagination a.next, a[rel="next"], .next-page')->each(function (Crawler $node) use ($defaultCategory) {
            $nextUrl = $node->attr('href');
            if ($nextUrl && filter_var($nextUrl, FILTER_VALIDATE_URL)) {
                $path = parse_url($nextUrl, PHP_URL_PATH) ?? '';
                if ($path) {
                    $this->scrapePage($path, $defaultCategory);
                }
            }
        });
    }

    protected function extractText(Crawler $node, string $selector, bool $isPrice = false, bool $isLongText = false): ?string
    {
        if ($node->filter($selector)->count() > 0) {
            $text = trim(preg_replace('/\s+/', ' ', $node->filter($selector)->first()->text()));
            $text = strip_tags($text);
            $text = html_entity_decode($text);
            
            if ($text === '') return null;

            if ($isPrice) {
                // Ensure price actually contains numbers
                if (!preg_match('/\d/', $text)) return null;
                return preg_replace('/[^\d.,$₹€£]/', '', $text) ?: null;
            }

            return ($isLongText && strlen($text) > 1000) ? mb_strimwidth($text, 0, 997, '...') : $text;
        }
        return null;
    }

    // Advanced Image Extractor
    protected function extractImage(Crawler $node, string $selector): ?string
    {
        if ($node->filter($selector)->count() > 0) {
            $imgNode = $node->filter($selector)->first();
            
            // Check src, data-src, fallback to background-image style if it's a div
            $src = $imgNode->attr('src') ?? $imgNode->attr('data-src');
            
            if (!$src) {
                $style = $imgNode->attr('style');
                if ($style && preg_match('/url\((["\']?)(.*?)\1\)/', $style, $match)) {
                    $src = $match[2];
                }
            }
            
            if ($src) {
                // Validate extension or data-url to prevent capturing pixel trackers
                if (!filter_var($src, FILTER_VALIDATE_URL) && !str_starts_with($src, 'data:image')) {
                    $src = rtrim($this->baseUrl, '/') . '/' . ltrim($src, '/');
                }
                
                // Reject obvious broken tracks or SVGs if needed (optional)
                return $src;
            }
        }
        return null;
    }

    protected function extractLink(Crawler $node, string $selector): ?string
    {
        if ($node->filter($selector)->count() > 0) {
            foreach ($node->filter($selector)->extract(['href']) as $href) {
                if ($href && !str_starts_with($href, '#') && !str_starts_with(strtolower($href), 'javascript')) {
                    return $href;
                }
            }
        }
        return null;
    }
}
