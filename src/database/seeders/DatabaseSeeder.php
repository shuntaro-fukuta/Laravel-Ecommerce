<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Front\User;
use App\Models\Back\Operator;
use App\Models\Back\Maker;
use App\Models\Back\Category;
use App\Models\Back\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tarou',
            'email' => 'tarou@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'address' => '東京都八王子市 hogehoge',
            'phone_number' => '08012341234',
        ]);

        User::factory(10)->create();

        Operator::create([
            'name' => 'fukuta',
            'email' => 'fukuta@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Operator::factory(100)->create();

        Maker::create([
            'name' => '株式会社福田',
            'email' => 'fukuta_co@example.com',
            'phone_number' => '0312341234',
            'address' => '東京都八王子市hoge',
        ]);
        Maker::factory(10)->create();

        Category::create(['name' => 'fukuta']);
        Category::factory(10)->create();

        Product::factory(30)->create();
    }
}
