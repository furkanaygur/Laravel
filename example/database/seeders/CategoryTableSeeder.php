<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Category::truncate();

        Category::insert([
            'name' => 'Men',
            'slug' => 'men',
        ]);

        Category::insert([
            'name' => 'Women',
            'slug' => 'women'
        ]);

        Category::insert([
            'name' => 'Kid',
            'slug' => 'kid'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
