<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color_name' => 'Red', 'color_code' => '#FF0000'],
            ['color_name' => 'Blue', 'color_code' => '#0000FF'],
            ['color_name' => 'Green', 'color_code' => '#00FF00'],
            ['color_name' => 'Yellow', 'color_code' => '#FFFF00'],
            ['color_name' => 'Black', 'color_code' => '#000000'],
            ['color_name' => 'White', 'color_code' => '#FFFFFF'],
        ];
        DB::table('colors')->insert($colors);
    }
}
