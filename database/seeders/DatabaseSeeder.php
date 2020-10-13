<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Phone;
use App\Models\Email;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'testuser@gmail.com',
            'password' => Hash::make('password'),
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\ProductType::factory(2)->create();
        \App\Models\Product::factory(5)->create();
        \App\Models\Customer::factory(50)
            ->has(Order::factory()
                ->has(OrderDetail::factory()
                    ->count(10))
                ->count(5))
            ->has(Phone::factory()->count(2))
            ->has(Email::factory()->count(2))
            ->create();
    }
}
