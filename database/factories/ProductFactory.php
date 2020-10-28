<?php

use Faker\Generator as Faker;
use App\Helpers\CommonFunctions;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence($nbWords = 4, $variableNbWords = true),
        'category_id' => 1,
        'image' => CommonFunctions::getRandomImage('/photos/shares'),
        'sku_code' => $faker->swiftBicNumber,
    ];
});

$factory->define(App\Models\ProductDetail::class, function (Faker $faker) {
    $price = $faker->numberBetween($min = 1000000, $max = 20000000);
    return [
        'color' => $faker->unique()->word,
        'quantity' => 100,
        'import_quantity' => 100,
        'sale_price' => ($price + 1000000),
        'import_price' => $price,
        'image' => CommonFunctions::getRandomImage('/photos/shares'),
    ];
});
