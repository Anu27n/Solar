<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SolarProduct;

class SolarProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "name" => "Mono PERC Solar Panel 540W",
                "description" => "High-efficiency half-cut cell technology ideal for Indian climate. 22% Efficiency, 25 Years Warranty.",
                "image_url" => "https://images.unsplash.com/photo-1581093458891-9f302295b8cd?auto=format&fit=crop&w=800&q=80",
                "category" => "Solar Panels",
                "price" => "₹14,500"
            ],
            [
                "name" => "Bifacial Solar Panel 550W",
                "description" => "Generates power from both front and back sides for extra output. Double Glass, 30 Years Life.",
                "image_url" => "https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=800&q=80",
                "category" => "Solar Panels",
                "price" => "₹16,000"
            ],
            [
                "name" => "Solar Hybrid Inverter 5kVA",
                "description" => "Smart hybrid inverter with pure sine wave output. IoT Enabled, 98% Efficiency.",
                "image_url" => "https://images.unsplash.com/photo-1663089842751-1d898c60cb81?auto=format&fit=crop&w=800&q=80",
                "category" => "Inverters",
                "price" => "₹45,000"
            ],
            [
                "name" => "Lithium Ferro Phosphate Battery",
                "description" => "Long-life storage solution for solar off-grid systems. 5000+ Cycles, Fast Charging.",
                "image_url" => "https://images.unsplash.com/photo-1617130237731-f2f2e519c720?auto=format&fit=crop&w=800&q=80",
                "category" => "Batteries",
                "price" => "₹32,000"
            ],
            [
                "name" => "Solar Water Heater 200L",
                "description" => "ETC technology for hot water even on cloudy days. Glass Lined Tank, 5 Year Warranty.",
                "image_url" => "https://images.unsplash.com/photo-1558449028-b53a39d100fc?auto=format&fit=crop&w=800&q=80",
                "category" => "Water Heaters",
                "price" => "₹18,500"
            ],
            [
                "name" => "All-in-One Solar Street Light",
                "description" => "Automatic dusk-to-dawn LED street light with motion sensor. IP65 Waterproof.",
                "image_url" => "https://images.unsplash.com/photo-1612451000780-6060c23933c0?auto=format&fit=crop&w=800&q=80",
                "category" => "Lighting",
                "price" => "₹5,500"
            ],
            [
                "name" => "Solar Submersible Pump 2HP",
                "description" => "High-power DC pump for irrigation without electricity grid. MPPT Drive, Dry Run Protection.",
                "image_url" => "https://images.unsplash.com/photo-1516086781283-7d9a3b8364ea?auto=format&fit=crop&w=800&q=80",
                "category" => "Agriculture",
                "price" => "₹55,000"
            ],
            [
                "name" => "MPPT Charge Controller 60A",
                "description" => "Optimizes solar energy harvest by up to 30% compared to PWM. 99% Tracking Eff., LCD Display.",
                "image_url" => "https://images.unsplash.com/photo-1592833159057-69de44ebbcfa?auto=format&fit=crop&w=800&q=80",
                "category" => "Accessories",
                "price" => "₹6,000"
            ],
            [
                "name" => "Rooftop Solar Installation",
                "description" => "Complete turnkey solutions for residential homes. Reduce your electricity bill by up to 90%.",
                "image_url" => "https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80",
                "category" => "Services",
                "price" => null
            ],
            [
                "name" => "Commercial Solar Plants",
                "description" => "Custom-designed solar infrastructure for factories, hospitals, and schools in UP.",
                "image_url" => "https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=800&q=80",
                "category" => "Services",
                "price" => null
            ],
            [
                "name" => "AMC & Maintenance",
                "description" => "Reliable cleaning, checkups, and repair services for all solar brands.",
                "image_url" => "https://images.unsplash.com/photo-1582823616835-08e503375bde?auto=format&fit=crop&w=800&q=80",
                "category" => "Services",
                "price" => null
            ],
            [
                "name" => "Sharma Residency",
                "description" => "5kW Rooftop • Residential installation saving ₹6,000/month.",
                "image_url" => "https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=800&q=80",
                "category" => "Projects",
                "price" => null
            ],
            [
                "name" => "Green Valley School",
                "description" => "50kW Plant • Full campus powered by green energy.",
                "image_url" => "https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80",
                "category" => "Projects",
                "price" => null
            ]
        ];

        foreach ($products as $p) {
            SolarProduct::updateOrCreate(
                ['name' => $p['name']],
                [
                    'category' => $p['category'],
                    'short_description' => mb_strimwidth($p['description'], 0, 100, '...'),
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'image_url' => $p['image_url'],
                    'source_url' => 'https://uprsolargreenenergy.com/#' . \Illuminate\Support\Str::slug($p['name']),
                    'contact_info' => "UPR Solar Green Energy\nWebsite: https://uprsolargreenenergy.com",
                    'scraped_at' => now(),
                ]
            );
        }
    }
}
