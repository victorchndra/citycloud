<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class KBSeeder extends Seeder
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
        $kb->name = "MOW";        
        $kb->created_by = 1;
        $kb->save();

        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "Pil";        
        $kb->created_by = 1;
        $kb->save();

        $kb =new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "Suntikan";        
        $kb->created_by = 1;
        $kb->save();

        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "IUD";        
        $kb->created_by = 1;
        $kb->save();

        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "Implan ";        
        $kb->created_by = 1;
        $kb->save();

        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "MOP";        
        $kb->created_by = 1;
        $kb->save();

        $kb = new \App\Models\Masters\KB();
        $kb->uuid = Uuid::uuid4()->getHex();        
        $kb->name = "Kondom";        
        $kb->created_by = 1;
        $kb->save();

        

        $this->command->info("All KB Variant success inserted");
    }
}
