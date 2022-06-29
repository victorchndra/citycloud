<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class WusPusExport implements FromView
{
    public $datas;


    function __construct($datas) {

        $this->datas = $datas;
        
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('transactions.wuspus.exportWusPus', [
            'datas' => $this->datas,
        ]);
        
    }
}
