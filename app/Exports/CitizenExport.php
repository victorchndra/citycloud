<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class CitizenExport implements FromView
{
    public $datas;
    public $nik;
    public $kk;
    public $name;
    public $genderSelected;
    public $place_birth;
    public $address;
    public $religion;
    public $familyStatusSelected;
    public $bloodSelected;
    public $job;
    public $phone;
    public $vaccine1Selected;
    public $vaccine2Selected;
    public $vaccine3Selected;
    public $rt;
    public $rw;
    public $village;
    public $sub_districsSelected;
    public $districtSelected;
    public $province;
    public $last_education;
    public $health_assurance;


    function __construct($datas,$nik,$kk,$name,$genderSelected,$place_birth,$religion,$familyStatusSelected,$bloodSelected,$job,$phone,$address,$vaccine1Selected,
    $vaccine2Selected,$vaccine3Selected,$rt,$rw,$village,$sub_districsSelected,$districtSelected,$province,$last_education,$health_assurance) {

        $this->datas = $datas;
        $this->nik = $nik;
        $this->kk = $kk;
        $this->name = $name;
        $this->genderSelected = $genderSelected;
        $this->place_birth = $place_birth;
        $this->religion = $religion;
        $this->address = $address;
        $this->familyStatusSelected = $familyStatusSelected;
        $this->bloodSelected = $bloodSelected;
        $this->job = $job;
        $this->phone = $phone;
        $this->vaccine1Selected = $vaccine1Selected;
        $this->vaccine2Selected = $vaccine2Selected;
        $this->vaccine3Selected = $vaccine3Selected;
        $this->rt = $rt;
        $this->rw = $rw;
        $this->village = $village;
        $this->sub_districsSelected = $sub_districsSelected;
        $this->districtSelected = $districtSelected;
        $this->province = $province;
        $this->last_education = $last_education;
        $this->health_assurance = $health_assurance;
    }

    /**
    * @return \Illuminate\Support\Collection
    */



    public function view(): View
    {
        return view('transactions.citizens.export', [
            'datas' => $this->datas,
            'nik' => $this->nik,
            'kk' => $this->kk,
            'name' => $this->name,
            'address' => $this->address,
            'genderSelected' => $this->genderSelected,
            'place_birth' => $this->place_birth,
            'religion' => $this->religion,
            'familyStatusSelected' => $this->familyStatusSelected,
            'bloodSelected' => $this->bloodSelected,
            'job' => $this->job,
            'phone' => $this->phone,
            'vaccine1Selected' => $this->vaccine1Selected,
            'vaccine2Selected' => $this->vaccine2Selected,
            'vaccine3Selected' => $this->vaccine3Selected,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'village' => $this->village,
            'sub_districsSelected' => $this->sub_districsSelected,
            'districtSelected' => $this->districtSelected,
            'province' => $this->province,
            'last_education' => $this->last_education,
            'health_assurance' => $this->health_assurance,
        ]);
        
    }
}
