<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatarwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rw = new \App\Models\Masters\RW();
        $rw->uuid = Uuid::uuid4()->getHex();
        $rw->name = "001";
        $rw->created_by = 1;
        $rw->save();

        $rw = new \App\Models\Masters\RW();
        $rw->uuid = Uuid::uuid4()->getHex();
        $rw->name = "002";
        $rw->created_by = 1;
        $rw->save();

        $rw = new \App\Models\Masters\RW();
        $rw->uuid = Uuid::uuid4()->getHex();
        $rw->name = "003";
        $rw->created_by = 1;
        $rw->save();

        $rw = new \App\Models\Masters\RW();
        $rw->uuid = Uuid::uuid4()->getHex();
        $rw->name = "004";
        $rw->created_by = 1;
        $rw->save();

        $rw = new \App\Models\Masters\RW();
        $rw->uuid = Uuid::uuid4()->getHex();
        $rw->name = "005";
        $rw->created_by = 1;
        $rw->save();
    }
}
