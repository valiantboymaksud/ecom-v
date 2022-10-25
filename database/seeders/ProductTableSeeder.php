<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Demo Product 1', 'slug'=> 'demo-product-1', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 120, 'offer_price' => 120, 'status'=> 1],
            ['name' => 'Demo Product 2', 'slug'=> 'demo-product-2', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 350, 'offer_price' => 300, 'status'=> 1],
            ['name' => 'Demo Product 3', 'slug'=> 'demo-product-3', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 450, 'offer_price' => 450, 'status'=> 0],
            ['name' => 'Demo Product 4', 'slug'=> 'demo-product-4', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 1200, 'offer_price' => 1200, 'status'=> 1],
            ['name' => 'Demo Product 5', 'slug'=> 'demo-product-5', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 7800, 'offer_price' => 7800, 'status'=> 1],
            ['name' => 'Demo Product 6', 'slug'=> 'demo-product-6', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 700, 'offer_price' => 700, 'status'=> 1],
            ['name' => 'Demo Product 7', 'slug'=> 'demo-product-7', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 800, 'offer_price' => 800, 'status'=> 1],
            ['name' => 'Demo Product 8', 'slug'=> 'demo-product-8', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 900, 'offer_price' => 900, 'status'=> 1],
            ['name' => 'Demo Product 9', 'slug'=> 'demo-product-9', 'description' => 'This is demo description',    'image'=> 'assets/default.png',    'price' => 2100, 'offer_price' => 2100, 'status'=> 0],
            ['name' => 'Demo Product 10', 'slug'=> 'demo-product-10', 'description' => 'This is demo description',  'image'=> 'assets/default.png',    'price' => 3400, 'offer_price' => 3400, 'status'=> 1],
        ];
        Product::insert($products);

        $attributes = [
            ['product_id' => 1, 'attribute_id' => 1, 'attribute_object_id' => 1],
            ['product_id' => 1, 'attribute_id' => 1, 'attribute_object_id' => 2],
            ['product_id' => 2, 'attribute_id' => 1, 'attribute_object_id' => 1],
            ['product_id' => 2, 'attribute_id' => 2, 'attribute_object_id' => 1],
            ['product_id' => 3, 'attribute_id' => 1, 'attribute_object_id' => 2],
            ['product_id' => 4, 'attribute_id' => 1, 'attribute_object_id' => 1],
            ['product_id' => 5, 'attribute_id' => 1, 'attribute_object_id' => 2],
            ['product_id' => 6, 'attribute_id' => 1, 'attribute_object_id' => 1],
            ['product_id' => 7, 'attribute_id' => 2, 'attribute_object_id' => 2],
            ['product_id' => 8, 'attribute_id' => 1, 'attribute_object_id' => 2],
            ['product_id' => 9, 'attribute_id' => 2, 'attribute_object_id' => 1],
            ['product_id' => 10, 'attribute_id' => 1, 'attribute_object_id' => 1],
        ];
        ProductAttribute::insert($attributes);
    }
}
