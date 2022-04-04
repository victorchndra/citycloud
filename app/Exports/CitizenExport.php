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
    public $religion;
    public $familyStatusSelected;
    public $bloodSelected;
    public $job;
    public $phone;
    public $vaccine1Selected;
    public $vaccine2Selected;
    public $vaccine3Selected;


    function __construct($datas,$nik,$kk,$name,$genderSelected,$place_birth,$religion,$familyStatusSelected,$bloodSelected,$job,$phone,$vaccine1Selected,
    $vaccine2Selected,$vaccine3Selected) {

        $this->datas = $datas;
        $this->nik = $nik;
        $this->kk = $kk;
        $this->name = $name;
        $this->genderSelected = $genderSelected;
        $this->place_birth = $place_birth;
        $this->religion = $religion;
        $this->familyStatusSelected = $familyStatusSelected;
        $this->bloodSelected = $bloodSelected;
        $this->job = $job;
        $this->phone = $phone;
        $this->vaccine1Selected = $vaccine1Selected;
        $this->vaccine2Selected = $vaccine2Selected;
        $this->vaccine3Selected = $vaccine3Selected;
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
            
        ]);
        
    }
}
