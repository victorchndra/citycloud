<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\Transactions\Citizens;

//jangan lupa import ini jika pakai faker
use Faker\Factory as Faker;

class CitizenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<50; $i++) {
            $faker = Faker::create('id_ID');
            $religion = ["Islam", "Kristen Protestan", "Kristen Katolik", "Hindu", "Buddha", "Khonghucu"];
            $gender = ["l", "p"];
            $family_status = ["Kepala Keluarga", "Istri", "Anak"];
            $job = ["karyawan swasta","tidak bekerja","karyawan bumn","PNS","Polri","Pedagang","IRT"];
            $blood = ["A","AB","B","O"];
            $vaccine_1 = ["Sudah Vaksin","Belum Vaksin"];
            $vaccine_2 = ["Sudah Vaksin","Belum Vaksin"];
            $vaccine_3 = ["Sudah Vaksin","Belum Vaksin"];
            $marriage = ["Belum Kawin","Kawin","Cerai Hidup","Cerai Mati"];
            $rt = ["001","002","003","004","005","006","007","008","009"];
            $rw = ["001","002","003"];
            $dtks = ["y","t"];
            $last_education = ["TAMAT SD / SEDERAJAT","TIDAK / BELUM SEKOLAH","SLTA / SEDERAJAT","SLTP/SEDERAJAT","BELUM TAMAT SD/SEDERAJAT","DIPLOMA IV/ STRATA I","	DIPLOMA I / II","AKADEMI/ DIPLOMA III/S. MUDA","STRATA II","STRATA III"];
            $health_assurance = ["bpjs","kis","askes","-"];

            Citizens::create([
            'nik' => $faker->nik(),
            'kk' => $faker->numerify('10##############'),
            'uuid' => $faker->uuid(),
            'name' => $faker->name(),
            'gender' => $faker->unique()->randomElement($gender),
            'date_birth' => $faker->date(),
            'place_birth' => $faker->city(),
            'job' => $faker->city(),
            'religion' => $faker->unique()->randomElement($religion),
            'job' => $faker->unique()->randomElement($job),
            'phone' => $faker->phoneNumber(),
            'blood' => $faker->unique()->randomElement($blood),
            'vaccine_1' => $faker->randomElement($vaccine_1),
            'vaccine_2' => $faker->randomElement($vaccine_2),
            'vaccine_3' => $faker->randomElement($vaccine_3),
            'dtks' => $faker->randomElement($dtks),
            'last_education' => $faker->randomElement($last_education),
            'health_assurance' => $faker->randomElement($health_assurance),
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
            ]);
        }
    }
}
