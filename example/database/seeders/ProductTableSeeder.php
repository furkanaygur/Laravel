<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Products::truncate();

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->name;
            Products::insert([
                'title' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->sentence(30),
                'price' => $faker->randomFloat(3, 1, 20)
            ]);

            DB::table('category_product')->insert([
                'category_id' => rand(1, 3),
                'product_id' => rand(1, 30)
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
