<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Models\User;
use App\Models\Transactions\Citizens;
use Maatwebsite\Excel\Concerns\ToModel;

//generate uuid pas ngimport
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;



class CitizenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


            $newData                    = new Citizens;
            $newData->uuid              = Uuid::uuid4()->getHex();
            $newData->nik               = $row[1];
            $newData->kk                = $row[2];
            $newData->name              = $row[3];
            $newData->gender            = $row[4];
            $newData->place_birth       = $row[5];
            $newData->date_birth        = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
            $newData->address           = $row[7];
            $newData->job               = $row[8];
            $newData->phone             = $row[9];
            $newData->religion          = $row[10];
            $newData->blood             = $row[11];
            $newData->family_status     = $row[12];
            $newData->marriage          = $row[13];
            $newData->father_name       = $row[14];
            $newData->mother_name       = $row[15];
            $newData->last_education    = $row[16];
            $newData->health_assurance  = $row[17];
            $newData->dtks              = $row[18];
            $newData->disability        = $row[19];
            $newData->vaccine_1         = $row[20];
            $newData->vaccine_2         = $row[21];
            $newData->vaccine_3         = $row[22];
            $newData->move_to           = $row[23];
            $newData->move_date         = $row[24];
            $newData->death_date        = $row[25];
            $newData->rt                = $row[26];
            $newData->rw                = $row[27];
            $newData->village           = $row[28];
            $newData->sub_districts     = $row[29];
            $newData->districts         = $row[30];
            $newData->province          = $row[31];
            $newData->created_by        = \Auth::user()->id;

            $newData->save();

          
            $user                        = new User;
            $user->username              = $row[1];
            $user->uuid                  = Uuid::uuid4()->getHex();
            $user->name                  = $row[3];
            $user->roles                 = "citizens";
            $user->password              = \Hash::make($row[1]);
            $user->citizens_id           = $newData->id;
            $user->avatar                = "";
            $user->phone                 = $row[10];
            $user->village_sub           = "";
            $user->rt                    = $row[26];
            $user->rw                    = $row[27];
            $user->village               = $row[28];
            $user->sub_districts         = $row[29];
            $user->districts             = $row[30];
            $user->province              = $row[31];
            $user->created_by            = \Auth::user()->id;
            $user->save();            


    }

    public function rules(): array
    {
        return [
            '*.1' => ['unique:citizens,nik']
        ];
    }
    public function customValidationMessages()
    {
        return [
            '1' => 'NIK sudah ada di sistem.',
        ];
    }
}
