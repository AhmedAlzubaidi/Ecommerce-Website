<?php

use App\Product;
use App\ProductOption;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 20)->create()->each(function ($product) {
            $faker = \Faker\Factory::create();
            $amount = $faker->numberBetween(1, 3);
            factory(ProductOption::class, $amount)->create(['product_id' => $product->id]);
        });
    }
}
