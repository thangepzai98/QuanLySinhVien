<?php

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
        factory(App\Models\Product::class, 20)->create()->each(function($product) {
            $productDetails = factory(App\Models\ProductDetail::class, 4)->make();
            $product->product_details()->saveMany($productDetails);
        });
    }
}
