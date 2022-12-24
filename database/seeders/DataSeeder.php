<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        User::create([
            'shop_id' => $shop->id,
            'name' => 'Md. Maksuduzzaman Maun',
            'email' => 'heemaun@gmail.com',
            'phone' => '01751430596',
            'user_name' => 'heemaun',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'male',
            'role' => 'super_admin',
            'salary' => '0',
            'date_of_birth' => '1993-11-8',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);

        User::create([
            'shop_id' => $shop->id,
            'name' => 'Heem Zaman',
            'email' => 'heemzaman@gmail.com',
            'phone' => '01847437223',
            'user_name' => 'heemzaman',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'male',
            'role' => 'admin',
            'salary' => '0',
            'date_of_birth' => '1993-11-8',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);
        User::create([
            'shop_id' => $shop->id,
            'name' => 'Tasnim Tuhin',
            'email' => 'tasnimtuhin@gmail.com',
            'phone' => '01771723729',
            'user_name' => 'tasnimtuhin',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'female',
            'role' => 'manager',
            'salary' => '0',
            'date_of_birth' => '2003-10-15',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);
        User::create([
            'shop_id' => $shop->id,
            'name' => 'Maksuda Zaman Helem',
            'email' => 'maksudazamanhelem@gmail.com',
            'phone' => '01715577541',
            'user_name' => 'helen',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'female',
            'role' => 'seller',
            'salary' => '0',
            'date_of_birth' => '1968-11-11',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);
        User::create([
            'shop_id' => $shop->id,
            'name' => 'Nusrat Zaman Nisa',
            'email' => 'nusrat@gmail.com',
            'phone' => '01111111111',
            'user_name' => 'nusrat',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'gender' => 'female',
            'role' => 'customer',
            'salary' => '0',
            'date_of_birth' => '2003-1-17',
            'picture' => '',
            'address' => 'Suihary-Ramnagor Road, Kalitola, Dinajpur - 5200',
        ]);

        $status = ['pending','active','deleted','banned','restricted'];

        for($x=0;$x<5;$x++){
            Category::create([
                'shop_id' => $shop->id,
                'user_id' => 1,
                'name' => 'Category '.($x+1),
                'status' => $status[rand(0,4)],
            ]);
        }

        for($x=0;$x<50;$x++){
            Product::create([
                'shop_id' => $shop->id,
                'user_id' => 1,
                'category_id' => rand(1,5),
                'name' => 'Product '.($x+1),
                'status' => $status[rand(0,4)],
                'picture' => 'product_'.rand(1,7).'.jpg',
            ]);
        }
    }
}
