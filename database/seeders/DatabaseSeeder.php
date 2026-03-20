<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name'     => 'Seller',
            'last_name'      => 'Account',
            'email'          => 'seller@coirnest.com',
            'password'       => Hash::make('seller123'),
            'phone'          => '9123456789',
            'gender'         => 'Prefer not to say',
            'birthdate'      => '1990-01-01',
            'street_address' => '123 Coir Street',
            'city'           => 'Manila',
            'province'       => 'Metro Manila',
            'zip_code'       => '1000',
            'role'           => 'seller',
        ]);

        User::create([
            'first_name'     => 'Buyer',
            'last_name'      => 'Account',
            'email'          => 'buyer@coirnest.com',
            'password'       => Hash::make('buyer123'),
            'phone'          => '9987654321',
            'gender'         => 'Prefer not to say',
            'birthdate'      => '1995-06-15',
            'street_address' => '456 Fiber Ave',
            'city'           => 'Quezon City',
            'province'       => 'Metro Manila',
            'zip_code'       => '1100',
            'role'           => 'customer',
        ]);
    }
}