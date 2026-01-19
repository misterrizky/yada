<?php

namespace Database\Seeders\Master;

use App\Models\Master\Product;
use App\Models\Master\ProductCategory;
use App\Models\Master\ProductUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call(\Database\Seeders\Master\ProductCategorySeeder::class);
        $this->call(\Database\Seeders\Master\ProductUnitSeeder::class);

        // 3. Products
        // $faker = \Faker\Factory::create();
        // $cats = ProductCategory::all();
        // $us = ProductUnit::all();

        // for ($i = 0; $i < 20; $i++) {
        //     Product::create([
        //         'ulid' => Str::ulid(),
        //         'sku' => strtoupper($faker->bothify('PROD-#####')),
        //         'name' => $faker->words(3, true),
        //         'category_id' => $cats->random()->id,
        //         'unit_id' => $us->random()->id,
        //         'purchase_price' => $faker->numberBetween(10000, 5000000),
        //         'selling_price' => $faker->numberBetween(15000, 6000000),
        //         'tax_rate' => 11,
        //         'is_active' => true,
        //     ]);
        // }
    }
}
