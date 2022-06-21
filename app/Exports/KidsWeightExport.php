<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class KidsWeightExport implements FromView
{
    public $datas;
    public $nik;
    public $name;
    public $weight;
    public $height;
    public $headWidth;
    public $imdbSelected;
    public $methodMeasureSelected;
    public $vitaminSelected;
    public $kmsSelected;
    public $imunitationSelected;
    public $boosterSelected;
    public $e1Selected;
    public $e2Selected;
    public $e3Selected;
    public $e4Selected;
    public $e5Selected;
    public $e6Selected;    
    public $notes;


    function __construct($datas,$nik,$name,$weight,$height,$imdbSelected,$methodMeasureSelected,$vitaminSelected,$kmsSelected,$imunitationSelected,$boosterSelected,$headWidth,$e1Selected,
    $e2Selected,$e3Selected,$e4Selected,$e5Selected,$e6Selected,$notes) {

        $this->datas = $datas;
        $this->nik = $nik;        
        $this->name = $name;
        $this->weight = $weight;
        $this->height = $height;
        $this->imdbSelected = $imdbSelected;
        $this->headWidth = $headWidth;
        $this->methodMeasureSelected = $methodMeasureSelected;
        $this->vitaminSelected = $vitaminSelected;
        $this->kmsSelected = $kmsSelected;
        $this->imunitationSelected = $imunitationSelected;
        $this->boosterSelected = $boosterSelected;
        $this->e1Selected = $e1Selected;
        $this->e2Selected = $e2Selected;
        $this->e3Selected = $e3Selected;
        $this->e4Selected = $e4Selected;
        $this->e5Selected = $e5Selected;
        $this->e6Selected = $e6Selected;    
        $this->notes = $notes;        
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('transactions.kidsweight.exportKidsWeight', [
            'datas' => $this->datas,
            'nik' => $this->nik,
            'name' => $this->name,
            'weight' => $this->weight,
            'height' => $this->height,
            'imdbSelected' => $this->imdbSelected,
            'headWidth' => $this->headWidth,
            'methodMeasureSelected' => $this->methodMeasureSelected,
            'vitaminSelected' => $this->vitaminSelected,
            'kmsSelected' => $this->kmsSelected,
            'imunitationSelected' => $this->imunitationSelected,
            'boosterSelected' => $this->boosterSelected,
            'e1Selected' => $this->e1Selected,
            'e2Selected' => $this->e2Selected,
            'e3Selected' => $this->e3Selected,
            'e4Selected' => $this->e4Selected,
            'e5Selected' => $this->e5Selected,
            'e6Selected' => $this->e6Selected,
            'notes' => $this->notes,            
        ]);
        
    }
}
