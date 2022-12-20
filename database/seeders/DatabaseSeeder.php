<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Holiday;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([UserSeeder::class,]);
        $this->call([Notification::class],);
        $this->call([Reservation::class],);
        $this->call([Organization::class],);
        $this->call([Holiday::class],);

    }
    }

