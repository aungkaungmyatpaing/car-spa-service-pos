<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brands = [1, 2, 3, 4, 5];
        $categories = [1, 2, 3, 4, 5];

        $products = [];

        for ($i = 0; $i < 30; $i++) {
            $randomBrand = $brands[array_rand($brands)];
            $randomCategory = $categories[array_rand($categories)];
            $randomPrice = rand(500, 2000);
            $randomPurchasePrice = $randomPrice - rand(0, 50);
            $randomStock = rand(5, 50);

            $products[] = [
                'brand_id' => $randomBrand,
                'category_id' => $randomCategory,
                'name' => 'Product ' . ($i + 1),
                'description' => 'Mobile phone related description',
                'design' => 'Design ' . ($i + 1),
                'model' => 'Model ' . ($i + 1),
                'price' => $randomPrice,
                'purchase_price' => $randomPurchasePrice,
                'stock' => $randomStock,
                'barcode' => '1234567890' . ($i + 1),
                'sku' => 'SKU' . ($i + 1),
            ];
        }

        DB::table('products')->insert($products);
    }
}
