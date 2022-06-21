<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChildrenExport implements FromView
{
    public $datas;

    function __construct($datas) {
        $this->datas = $datas;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view(): View
    {
        return view('transactions.children.export', [
            'datas' => $this->datas,
        ]);
    }

}
