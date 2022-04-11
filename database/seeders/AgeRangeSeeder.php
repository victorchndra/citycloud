<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ageRange = new \App\Models\Masters\ageRange();
        $ageRange->uuid = Uuid::uuid4()->getHex();        
        $ageRange->start = 0;        
        $ageRange->end = 4;        
        $ageRange->notes = "BALITA";        
        $ageRange->created_by = 1;
        $ageRange->save();

        $ageRange = new \App\Models\Masters\ageRange();
        $ageRange->uuid = Uuid::uuid4()->getHex();        
        $ageRange->start = 5;        
        $ageRange->end = 10;        
        $ageRange->notes = "ANAK ANAK";        
        $ageRange->created_by = 1;
        $ageRange->save();

        $ageRange = new \App\Models\Masters\ageRange();
        $ageRange->uuid = Uuid::uuid4()->getHex();        
        $ageRange->start = 11;        
        $ageRange->end = 19;        
        $ageRange->notes = "REMAJA";        
        $ageRange->created_by = 1;
        $ageRange->save();

        $ageRange = new \App\Models\Masters\ageRange();
        $ageRange->uuid = Uuid::uuid4()->getHex();        
        $ageRange->start = 20;        
        $ageRange->end = 57;        
        $ageRange->notes = "DEWASA";        
        $ageRange->created_by = 1;
        $ageRange->save();

        $ageRange = new \App\Models\Masters\ageRange();
        $ageRange->uuid = Uuid::uuid4()->getHex();        
        $ageRange->start = 58;        
        $ageRange->end = 99;        
        $ageRange->notes = "LANSIA";        
        $ageRange->created_by = 1;
        $ageRange->save();

    }
}
