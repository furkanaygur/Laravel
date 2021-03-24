<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\UserDetail;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Users::truncate();
        UserDetail::truncate();

        $adminUser = Users::create([
            'full_name' => 'Furkan AYGUR',
            'email' => 'furkan.aygur.1@gmail.com',
            'password' => bcrypt('123123'),
            'isActive' => 1,
            'isAdmin' => 1
        ]);

        $adminUser->detail()->create([
            'address' => 'Turkey / Istanbul',
            'phone' => '1234567890',
            'phone2' => '0987654321'
        ]);

        for ($i = 0; $i < 50; $i++) {
            $user = Users::create([
                'full_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $faker->password,
                'isActive' => 1,
            ]);

            $user->detail()->create([
                'address' => $faker->address,
                'phone' => '1234567890',
                'phone2' => '0987654321'
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
