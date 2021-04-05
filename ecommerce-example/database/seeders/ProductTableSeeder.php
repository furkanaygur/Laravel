<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\ProductDetail;
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

        for ($i = 0; $i < 300; $i++) {
            $name = $faker->name;
            $id = Products::insertGetId([
                'title' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->sentence(30),
                'price' => $faker->randomFloat(3, 1, 20)
            ]);

            ProductDetail::insert([
                'product_id' => $id,
                'in_index' => rand(0, 1),
                'statu' => rand(1, 3)
            ]);

            DB::table('category_product')->insert([
                'category_id' => rand(1, 3),
                'product_id' => $id
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
