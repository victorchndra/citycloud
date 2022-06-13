<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class MotherKBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->mother_name = "Nama Ibu";        
        $kb->kb_name = "Nama KB";        
        $kb->kb_date = "1";        
        $kb->created_by = 1;
        $kb->save();

        

        $this->command->info("All KB Variant success inserted");
    }
}
