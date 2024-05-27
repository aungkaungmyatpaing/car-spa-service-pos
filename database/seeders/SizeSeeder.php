<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['size' => 'Small'],
            ['size' => 'Medium'],
            ['size' => 'Large'],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
