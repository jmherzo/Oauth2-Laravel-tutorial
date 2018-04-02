<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Product::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Product::create([
                'name' => $faker->word,
                'description' => $faker->text,
                'code' => $faker->md5,
                'buyPrice' => $faker->randomDigit,
                'sellPrice' => $faker->RandomDigit
            ]);
        }
    }
}
