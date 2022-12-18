<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop = Shop::create([
            'shop_name' => 'default_shop',
        ]);

        $superAdmin = User::create([
            'shop_id' => $shop->id,
            'name' => 'Md. Maksuduzzaman Maun',
            'email' => 'heemaun@gmail.com',
            'phone' => '01751430596',
            'user_name' => 'heemaun',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'male',
            'salary' => '0',
            'date_of_birth' => '1993-11-8',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);
    }
}
