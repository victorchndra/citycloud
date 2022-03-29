<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "001";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "002";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "003";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "004";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "005";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "006";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "007";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "008";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "009";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "010";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "011";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "012";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "013";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "014";        
        $rt->created_by = 1;
        $rt->save();

        $rt = new \App\Models\RT();
        $rt->uuid = Uuid::uuid4()->getHex();        
        $rt->name = "015";        
        $rt->created_by = 1;
        $rt->save();

        $this->command->info("All User success inserted");
    }
}
