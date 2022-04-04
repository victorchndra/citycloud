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
            $newData->date_birth        = $row[6];
            $newData->address           = $row[7];
            $newData->job               = $row[8];
            $newData->phone             = $row[9];
            $newData->religion          = $row[10];
            $newData->blood             = $row[11];
            $newData->family_status     = $row[12];
            $newData->marriage          = $row[13];
            $newData->last_education    = $row[14];
            $newData->health_assurance  = $row[15];
            $newData->dtks              = $row[16];
            $newData->vaccine_1         = $row[17];
            $newData->vaccine_2         = $row[18];
            $newData->vaccine_3         = $row[19];
            $newData->move_to           = $row[20];
            $newData->move_date         = $row[21];
            $newData->death_date        = $row[22];
            $newData->rt                = $row[23];
            $newData->rw                = $row[24];
            $newData->village           = $row[25];
            $newData->sub_districts     = $row[26];
            $newData->districts         = $row[27];
            $newData->province          = $row[28];
            $newData->created_by        = \Auth::user()->id;

            $newData->save();

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
