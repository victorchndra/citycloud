<?php

namespace Database\Seeders;

use Database\Seeders\RTSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\DatarwSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\AssistanceSeeder;
use Database\Seeders\CitizenTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //panggil semua table seeder di database seeder ini.
        $this->call(CitizenTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RTSeeder::class);
        $this->call(DatarwSeeder::class);
        $this->call(AssistanceSeeder::class);
    }
}
