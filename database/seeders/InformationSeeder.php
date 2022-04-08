<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $information = new \App\Models\Information();
        $information->uuid = Uuid::uuid4()->getHex();
        $information->letter_index = "ini test";
        $information->village_name = "Rumbai";
        $information->sub_district_name = "Rumbai 1";
        $information->district_name = "R";
        $information->province_name = "Riau";
        $information->header = "Anto";
        $information->code = 1;
        $information->save();

    }
}