<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Psy\Readline\Transient;

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
            'name' => 'Maksuda Zaman Helen',
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

        Settings::create([
            'shop_id' => 1,
            'user_id' => 2,
            'key' => 'Shop Name',
            'value' => "Zamans' Cafe"
        ]);

        Settings::create([
            'shop_id' => 1,
            'user_id' => 3,
            'key' => 'Tag Line',
            'value' => 'best cafe of the town'
        ]);

        Settings::create([
            'shop_id' => 1,
            'user_id' => 4,
            'key' => 'Banner Image',
            'value' => 'main_bg.jpg',
        ]);

        Account::create([
            'shop_id' => 1,
            'user_id' => 1,
            'name' => 'Cash',
            'initial_balance' => 1000,
            'balance' => 1000,
        ]);

        Account::create([
            'shop_id' => 1,
            'user_id' => 1,
            'name' => 'Mobile Banking',
            'initial_balance' => 1500,
            'balance' => 7000,
        ]);

        for($x=0;$x<100;$x++){

            $from_select = ($x % 2 == 0) ? 'user' : 'account' ;
            $to_select = ($x % 3 == 0) ? 'user' : 'account';
            $status = ['active','pending','deleted','banned','restricted'];
            $type = ['sell','purchase','salary','deposite','withdraw','transfer','other'];

            Transaction::create([
                'shop_id'       => 1,
                'user_id'       => mt_rand(1,5),
                'from_account'  => (strcmp($from_select,'user')==0) ? null : rand(1,2),
                'from_user'     => (strcmp($from_select,'user')==0) ? rand(1,5) : null,
                'to_account'    => (strcmp($to_select,'user')==0) ? null : rand(1,2),
                'to_user'       => (strcmp($to_select,'user')==0) ? rand(1,5) : null,
                'sell_id'       => null,
                'purchase_id'   => null,
                'type'          => $type[rand(0,6)],
                'status'        => $status[rand(0,4)],
                'from_select'   => $from_select,
                'to_select'     => $to_select,
                'amount'        => rand(1,10000),
                'created_at'    => date('Y-m-d H:m:s',rand(strtotime('2000-01-01'),strtotime('2023-12-31 23:59:59'))),
            ]);
        }
    }
}
