<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('category')->truncate();
        $id = DB::table('category')->insertGetId(['category_name' => 'Electronic', 'slug' => 'electronic']);
        DB::table('category')->insert(['category_name' => 'Computer/Tablet', 'slug' => 'computer-tablet', 'parent_id' => $id]);
        DB::table('category')->insert(['category_name' => 'TV', 'slug' => 'tv', 'parent_id' => $id]);
        DB::table('category')->insert(['category_name' => 'Camera', 'slug' => 'camera', 'parent_id' => $id]);

        $id = DB::table('category')->insertGetId(['category_name' => 'Book', 'slug' => 'book']);
        DB::table('category')->insert(['category_name' => 'Literature', 'slug' => 'literature', 'parent_id' => $id]);
        DB::table('category')->insert(['category_name' => 'Computer', 'slug' => 'computer', 'parent_id' => $id]);
        DB::table('category')->insert(['category_name' => 'Children', 'slug' => 'children', 'parent_id' => $id]);


        DB::table('category')->insert(['category_name' => 'Magazine', 'slug' => 'magazine']);
        DB::table('category')->insert(['category_name' => 'Furniture', 'slug' => 'furniture']);
        DB::table('category')->insert(['category_name' => 'Decoration', 'slug' => 'decoration']);
        DB::table('category')->insert(['category_name' => 'Cosmetic', 'slug' => 'cosmetic']);
        DB::table('category')->insert(['category_name' => 'Personal Care', 'slug' => 'personal-care']);
        DB::table('category')->insert(['category_name' => 'Clothing & Fashion', 'slug' => 'clothing-fashion']);
        DB::table('category')->insert(['category_name' => 'Mom & Baby', 'slug' => 'mom-baby']);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
