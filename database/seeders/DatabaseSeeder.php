<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


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
    }
}
