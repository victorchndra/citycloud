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
        $information = new \App\Models\Masters\Information();
        $information->uuid = Uuid::uuid4()->getHex();
        $information->letter_index = "474/";
        $information->village_name = "Lembah Sari";
        $information->sub_district_name = "Rumbai Timur";
        $information->district_name = "Pekanbaru";
        $information->province_name = "Riau";
        $information->header = "Anto";
        $information->code = 001;
        $information->save();

    }
}
