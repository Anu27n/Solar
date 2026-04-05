<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SolarScraperService;

class ScrapeSolarCommand extends Command
{
    protected $signature = 'scrape:solar';
    protected $description = 'Scrape solar products from the target website';

    public function handle(SolarScraperService $scraperService): int
    {
        $this->info('Starting solar products scraper...');
        
        $scraperService->scrape();
        
        $this->info('Scraping completed successfully.');
        
        return Command::SUCCESS;
    }
}
