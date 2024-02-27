<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'tim',
            'surname' => 'vash',
            'email' => 'timvash90@gmail.com',
            'password' => Hash::make('timtim'),
            'balance' => 30
        ]);

        $user->assignRole('owner');

        Address::create([
            'user_id' => $user->id,
            'name' => 'Тимур',
            'surname' => 'Ващенко',
            'country_id' => Country::where('name', 'Russia')->first()->id,
            'region' => 'Краснодарский край',
            'city' => 'Кропоткин',
            'postal_code' => 352380,
            'street' => 'Красная 250',
            'phone_number' => 89181243115,
            'email' => $user->email
        ]);

        $test_order = Order::create([
            'user_id' => $user->id,
            'status_id' => 2,
            'title' => 'Заказ Пикселя'
        ]);

        OrderProduct::create([
            'order_id' => $test_order->id,
            'status_id' => 1,
            'shop_id' => 1,
            'link' => 'https://google.com',
            'title' => 'Google Pixel 7 Pro 512/12 Black',
            'price' => 70000,
            'quantity' => 2
        ]);
    }
}
