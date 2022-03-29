<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

//panggil library uuidnya ramsey
use Ramsey\Uuid\Uuid;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User;
        $user->uuid = Uuid::uuid4()->getHex();
        $user->username = "support";
        $user->name = "support";
        $user->password = \Hash::make("123456");
        $user->created_by = 1;
        $user->save();

        $this->command->info("All User success inserted");
    }
}
