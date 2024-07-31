<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jelly McSquid',
            'email' => 'jelly@laravel.livewire.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Store::create([
            'name' => 'MLM Industries',
            'user_id' => 1,
        ]);

        Product::create(['name' => 'Energy Drink', 'store_id' => 1]);
        Product::create(['name' => 'Water Purifier', 'store_id' => 1]);
        Product::create(['name' => 'Toothpaste', 'store_id' => 1]);
        Product::create(['name' => 'Magic Bracelet', 'store_id' => 1]);

        Order::factory(902)->create(['product_id' => '1']);
        Order::factory(760)->create(['product_id' => '2']);
        Order::factory(543)->create(['product_id' => '3']);
        Order::factory(632)->create(['product_id' => '4']);
    }
}
