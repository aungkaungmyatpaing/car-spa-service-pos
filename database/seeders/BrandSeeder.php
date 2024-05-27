<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'description' => 'Description for Apple brand'],
            ['name' => 'Samsung', 'description' => 'Description for Samsung brand'],
            ['name' => 'Huawei', 'description' => 'Description for Huawei brand'],
            ['name' => 'Xiaomi', 'description' => 'Description for Xiaomi brand'],
            ['name' => 'OnePlus', 'description' => 'Description for OnePlus brand'],
        ];

        DB::table('brands')->insert($brands);
    }
}
