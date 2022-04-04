<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//panggil library uuidnya ramsey
use Ramsey\Uuid\Uuid;

class AssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "Sembako";
        $assistance->nominal = "300000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "Bantuan Sosial Tunai";
        $assistance->nominal = "600000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "BLT dana desa";
        $assistance->nominal = "600000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "Listrik gratis";
        $assistance->nominal = "500000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "Kartu Prakerja";
        $assistance->nominal = "3550000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "Subsidi gaji karyawan";
        $assistance->nominal = "600000";
        $assistance->created_by = 1;
        $assistance->save();
        
        $assistance = new \App\Models\Masters\Assistance;
        $assistance->uuid = Uuid::uuid4()->getHex();
        $assistance->name = "BLT usaha mikro";
        $assistance->nominal = "600000";
        $assistance->created_by = 1;
        $assistance->save();

        $this->command->info("All Assistance success inserted");
    }
}
