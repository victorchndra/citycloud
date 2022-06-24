<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transactions\Citizens;
use App\Models\Transactions\KidsWeight;
use App\Models\Transactions\KidsWeightMonth;
use App\Models\Masters\Immunization;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\KidsWeightMonthExport;

class KidsWeightMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        // $datas = KidsWeight::select('citizens.*','kids_weights.*')
        //                     ->join('citizens','citizens.id','=','kids_weights.citizen_id')
        //                     // ->where('')
        //                     ->first()->paginate(10);
        $datas = Citizens::select('citizens.*','kids_weights.*')
                            ->where('kids_weights.deleted_at', null)
                            ->join('kids_weights', 'kids_weights.citizen_id', '=', 'citizens.id')
                            // ->join('citizens','citizens.nik', '=', 'citizens.nik')
                            ->paginate(10);                    
        // dd($datas);
        $data = KidsWeight::latest()->filter(
            request([
                'nik', 'name', 'weight', 'height', 'head_width', 'imdb', 'method_measure', 'vitamin', 'kms', 'imunitation', 'booster', 'e1', 'e2', 'e3', 'e4', 'e5', 'e6', 'notes'
            ])
        );
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        $nik =  $request->get('nik');
        $name =  $request->get('name');
        $weight =  $request->get('weight');
        $height =  $request->get('height');
        $imdbSelected =  $request->get('imdb');
        $headWidth =  $request->get('head_width');
        $methodMeasureSelected =  $request->get('method_measure');
        $vitaminSelected =  $request->get('vitamin');
        $kmsSelected =  $request->get('kms');
        $imunitationSelected =  $request->get('imunitation');
        $boosterSelected =  $request->get('booster');
        $e1Selected =  $request->get('e1');
        $e2Selected =  $request->get('e2');
        $e3Selected =  $request->get('e3');
        $e4Selected =  $request->get('e4');
        $e5Selected =  $request->get('e5');
        $e6Selected =  $request->get('e6');
        $notes =  $request->get('notes');

        

        if ($request->has('imdb')) {
            if (!empty($imdbSelected))
                $datas->where('imdb', $imdbSelected);
        }

        if ($request->has('method_measure')) {
            if (!empty($methodMeasureSelected))
                $datas->where('method_measure', $methodMeasureSelected);
        }

        if ($request->has('vitamin')) {
            if (!empty($vitaminSelected))
                $datas->where('vitamin', $vitaminSelected);
        }

        if ($request->has('kms')) {
            if (!empty($kmsSelected))
                $datas->where('kms', $kmsSelected);
        }

        if ($request->has('imunitation')) {
            if (!empty($imunitationSelected))
                $datas->where('imunitation', $imunitationSelected);
        }

        if ($request->has('booster')) {
            if (!empty($boosterSelected))
                $datas->where('booster', $boosterSelected);
        }

        if ($request->has('e1')) {
            if (!empty($e1Selected))
                $datas->where('e1', $e1Selected);
        }

        if ($request->has('e2')) {
            if (!empty($e2Selected))
                $datas->where('e2', $e2Selected);
        }

        if ($request->has('e3')) {
            if (!empty($e3Selected))
                $datas->where('e3', $e3Selected);
        }

        if ($request->has('e4')) {
            if (!empty($e4Selected))
                $datas->where('e4', $e4Selected);
        }

        if ($request->has('e5')) {
            if (!empty($e5Selected))
                $datas->where('e5', $e5Selected);
        }

        if ($request->has('e6')) {
            if (!empty($e6Selected))
                $datas->where('e6', $e6Selected);
        }

        if ($request->has('notes')) {
            if (!empty($notes))
                $datas->where('notes', $notes);
        }
        

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.kidsweightmonth.index', compact('data','datas','nik','name','weight','height','imdbSelected','headWidth','methodMeasureSelected','vitaminSelected','kmsSelected','imunitationSelected','boosterSelected','e1Selected','e2Selected','e3Selected','e4Selected','e5Selected','e6Selected','notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
