<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name'=>'superuser',
            'email'=>'super@marumaru.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>9,
            'domain_organization'=>'marumaru.co.jp',
        ],
        [
            'name'=>'admin',
            'email'=>'admin@marumaru.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>1,
            'domain_organization'=>'marumaru.co.jp',
        ],
        [
            'name'=>'user',
            'email'=>'user@marumaru.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>0,
            'domain_organization'=>'marumaru.co.jp',
        ],

        [
            'name'=>'superuser',
            'email'=>'super@test1.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>9,
            'domain_organization'=>'test1.co.jp',
        ],
        [
            'name'=>'admin',
            'email'=>'admin@test1.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>1,
            'domain_organization'=>'test1.co.jp',
        ],
        [
            'name'=>'user',
            'email'=>'user@test1.co.jp',
            'password'=>Hash::make('Password123'),
            'mode_admin'=>0,
            'domain_organization'=>'test1.co.jp',
        ],
        


    ]);
}

}

