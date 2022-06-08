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
        $kb->mother_name = "nama ibu";        
        $kb->kb_name = "nama kb";        
        $kb->kb_date = "";        
        $kb->created_by = 1;
        $kb->save();

        

        $this->command->info("All KB Variant success inserted");
    }
}
