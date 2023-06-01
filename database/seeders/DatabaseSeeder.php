<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create(
            [
                'type' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
            \App\Models\User::factory()->create(
            [
                'type' => 2,
                'name' => 'Seller 01',
                'email' => 'seller1@gmail.com',
                'password' => Hash::make('sell@1234'),
            ]);
            \App\Models\User::factory()->create(
            [
                'type' => 3,
                'name' => 'Customer 01',
                'email' => 'cus1@gmail.com',
                'password' => Hash::make('cus@1234'),
            ]);
    }
}
