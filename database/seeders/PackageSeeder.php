<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::create([
            'name' => '1kW Rooftop Basic',
            'system_size_kw' => 1,
            'price' => 45000,
            'estimated_generation' => '4-5 units/day',
            'warranty_details' => '25 years panel, 5 years inverter',
            'type' => 'domestic',
        ]);

        Package::create([
            'name' => '3kW Rooftop Standard',
            'system_size_kw' => 3,
            'price' => 135000,
            'estimated_generation' => '12-15 units/day',
            'warranty_details' => '25 years panel, 5 years inverter',
            'type' => 'domestic',
        ]);

        Package::create([
            'name' => '5kW Rooftop Premium',
            'system_size_kw' => 5,
            'price' => 225000,
            'estimated_generation' => '20-25 units/day',
            'warranty_details' => '25 years panel, 10 years inverter',
            'type' => 'domestic',
        ]);

        Package::create([
            'name' => '10kW Rooftop Pro',
            'system_size_kw' => 10,
            'price' => 450000,
            'estimated_generation' => '40-50 units/day',
            'warranty_details' => '25 years panel, 10 years inverter',
            'type' => 'domestic',
        ]);

        Package::create([
            'name' => '50kW Commercial',
            'system_size_kw' => 50,
            'price' => 2000000,
            'estimated_generation' => '200-250 units/day',
            'warranty_details' => '25 years panel, 10 years inverter, AMC',
            'type' => 'commercial',
        ]);

        Package::create([
            'name' => '100kW Industrial',
            'system_size_kw' => 100,
            'price' => 3800000,
            'estimated_generation' => '400-500 units/day',
            'warranty_details' => '25 years panel, 10 years inverter, AMC included',
            'type' => 'commercial',
        ]);
    }
}
