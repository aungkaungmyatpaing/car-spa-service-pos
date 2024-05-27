<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'Phone Cases', 'description' => 'Protective cases for mobile phones'],
            ['category' => 'Screen Protectors', 'description' => 'Protective films for mobile phone screens'],
            ['category' => 'Chargers', 'description' => 'Chargers and cables for mobile phones'],
            ['category' => 'Headphones', 'description' => 'Headphones and earphones for mobile phones'],
            ['category' => 'Power Banks', 'description' => 'Portable chargers for mobile phones'],
        ];

        DB::table('categories')->insert($categories);
    }
}
