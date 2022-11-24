<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'first_name'=>'Ahmed',
             'last_name'=>'Nabib',
            'name'=> 'Admin',
            'email'=>'admin@gmail.com',
            'mobile'=>'01754706621',
             'address'=>'mirpur 10',
             'post_code'=>'12345',
             'image'=>'image1',
            'email_verified_at'=>now(),
            'password'=>Hash::make('12345678'),
            'is_admin'=>true,
        ]);



    }
}
