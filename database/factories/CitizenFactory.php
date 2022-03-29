<?php

namespace Database\Factories;

use App\Models\Citizens;
use Faker\Factory as Faker;
//panggil fakernya
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CitizenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
   
        $faker = Faker::create('id_ID');
        $religion = ["Islam", "Kristen", "Hindu", "Budha", "Konguchu"];
        $gender = ["m", "f"];
        $family_status = ["child", "wife", "head"];
        $job = ["karyawan swasta","tidak bekerja","karyawan bumn","PNS","Polri","Pedagang","IRT"];
        $blood = ["A","AB","B","O"];
        $marriage = ["Kawin Tercatat","Belum Kawen"];
        $rt = ["001","002","003","004","005","006","007","008","009"];
        $rw = ["001","002","003"];

        return [
            'nik' => $faker->nik(),
            'kk' => $faker->numerify('10##############'),
            'name' => $faker->name(),
            'gender' => $faker->unique()->randomElement($gender),
            'date_birth' => $faker->date(), 
            'place_birth' => $faker->city(), 
            'job' => $faker->city(), 
            'religion' => $faker->unique()->randomElement($religion),
            'job' => $faker->unique()->randomElement($job),
            'blood' => $faker->unique()->randomElement($blood),
            'marriage' => $faker->unique()->randomElement($marriage),
            'family_status' => $faker->unique()->randomElement($family_status),
            'rt' => $faker->unique()->randomElement($rt),
            'rw' => $faker->unique()->randomElement($rw),
            'village' => 'Lembah Sari',
            'sub_districts' => 'Rumbai Pesisir', 
            'districts' => 'Pekanbaru', 
            'province' => 'Riau', 
            'created_by' => 1,
            'created_at' => Carbon::now(), 
        ];
 
}
}
