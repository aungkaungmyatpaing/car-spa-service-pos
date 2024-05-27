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
        // $this->call([
        //     CategorySeeder::class,
        //     ColorSeeder::class,
        //     BrandSeeder::class,
        //     SizeSeeder::class,
        //     ProductSeeder::class,
        // ]);

        \App\Models\User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
