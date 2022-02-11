<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'empanadas',
                'reference' => 15,
                'price' => 2000,
                'weight'=> 2,
                'category'=> 'fritos',
                'stock'=> 20
            ],
            [
                'name' => 'pasteles',
                'reference' => 20,
                'price' => 1000,
                'weight'=> 2,
                'category'=> 'fritos',
                'stock'=> 25
            ],

            [
                'name' => 'jugo',
                'reference' => 2123,
                'price' => 2500,
                'weight'=> 2,
                'category'=> 'bebidas',
                'stock'=> 40
            ],

            [
                'name' => 'cafe',
                'reference' => 41234,
                'price' => 1000,
                'weight'=> 1,
                'category'=> 'bebidas',
                'stock'=> 0
            ],
            [
                'name' => 'papas',
                'reference' => 21234,
                'price' => 2500,
                'weight'=> 1,
                'category'=> 'mecato',
                'stock'=> 10
            ],

            [
                'name' => 'platanitos',
                'reference' => 212344,
                'price' => 2300,
                'weight'=> 3,
                'category'=> 'mecato',
                'stock'=> 15
            ],
        ];

        foreach ($products as $product) {
            $product = Product::factory(1)->create($product)->first();

        }
    }
}
