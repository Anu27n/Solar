<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@uprsolar.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+91-9412452844',
            'city' => 'Kanpur',
            'state' => 'Uttar Pradesh',
        ]);

        User::create([
            'name' => 'Demo Partner',
            'email' => 'partner@uprsolar.com',
            'password' => Hash::make('partner123'),
            'role' => 'channel_partner',
            'phone' => '+91-9336852500',
            'city' => 'Kanpur',
            'state' => 'Uttar Pradesh',
        ]);

        User::create([
            'name' => 'Demo Employee',
            'email' => 'employee@uprsolar.com',
            'password' => Hash::make('employee123'),
            'role' => 'employee',
            'phone' => '+91-9000000001',
            'city' => 'Kanpur',
            'state' => 'Uttar Pradesh',
        ]);

        User::create([
            'name' => 'Demo Customer',
            'email' => 'customer@uprsolar.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'phone' => '+91-9000000002',
            'city' => 'Kanpur',
            'state' => 'Uttar Pradesh',
        ]);

        $this->call(PackageSeeder::class);
    }
}
