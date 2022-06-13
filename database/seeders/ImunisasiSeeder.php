<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $im = new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "HEPATITIS B";        
        $im->created_by = 1;
        $im->save();

        $im = new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "DPT-1";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "POLIO-2";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "BCG (BACILLUS CALMETTE GUERIN)";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "DPT-2";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "POLIO-3";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "POLIO-1";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "DPT-3";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "CAMPAK";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "VITAMIN C";        
        $im->created_by = 1;
        $im->save();

        $im =new \App\Models\Masters\Immunization();
        $im->uuid = Uuid::uuid4()->getHex();        
        $im->name = "IVP";        
        $im->created_by = 1;
        $im->save();

        

        $this->command->info("All User success inseimed");
    }
}
