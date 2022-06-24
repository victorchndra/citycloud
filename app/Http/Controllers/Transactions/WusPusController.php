<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Masters\Information;
use App\Models\Masters\KB;
use App\Models\Transactions\Citizens;
use App\Models\Transactions\MotherKb;
use App\Models\Transactions\WusPus;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use App\Exports\WusPusExport;

class WusPusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citizen = Citizens::where('gender','perempuan')->paginate(10);
        // $kepalakeluarga = Citizens::where('family_status','kepala keluarga')->where('jenis_kelamin','laki-laki');
        $datas = Citizens::select('citizens.*','mother_k_b_s.*','pregnant_mothers.*')
                    ->where('citizens.gender','perempuan')
                    ->where('mother_k_b_s.deleted_at',null)
                    ->join('mother_k_b_s', 'mother_k_b_s.mother_id', '=', 'citizens.id')
                    ->join('pregnant_mothers','pregnant_mothers.citizen_id', '=', 'citizens.id')
                    // ->join('citizens','citizens.nik', '=', 'citizens.nik')
                    ->paginate(10);

                    // dd($datas);
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');
        $datass = Citizens::
                        // where('gender','perempuan')
                        // ->with('citizens') // bring along details of the friend
                        // ->join('mother_k_b_s', 'mother_k_b_s.mother_id', '=', 'citizens.id')
                        // ->get(['mother_k_b_s.*','citizens.*']) // exclude extra details from friends table
                        paginate(10);

                        // dd($datas);
        // $data = Citizens::latest()->filter(
        //     request([
        //         'wuspus_id', 'couple_id', 'klp_dawasima', 'alive', 'death','size', 
        //         'immune1', 'immune2', 'immune3', 'immune4', 'immune5',
        //         'contraception_type', 'contraception_date', 'jkn'
        //     ])
        // );

        // $wuspus_id  =  $request->get('wuspus_id');
        // $couple_id    =  $request->get('couple_id');
        // $status_kk    =  $request->get('status_kk');
        // $klp_dawasima    =  $request->get('klp_dawasima');
        // $alive    =  $request->get('alive');
        // $death    =  $request->get('death');
        // $size    =  $request->get('size');
        // $immune1Selected    =  $request->get('immune1');
        // $immune2Selected    =  $request->get('immune2');
        // $immune3Selected    =  $request->get('immune3');
        // $immune4Selected    =  $request->get('immune4');
        // $immune5Selected    =  $request->get('immune5');
        // $contraception_typeSelected    =  $request->get('contraception_type');
        // $contraception_date    =  $request->get('contraception_date');
        // $jkn    =  $request->get('jkn');

        // if ($request->has('immune1')) {
        //     if (!empty($immune1Selected))
        //         $datas->where('immune1', $immune1Selected);
        // }
        
        // if ($request->has('immune2')) {
        //     if (!empty($immune2Selected))
        //         $datas->where('immune2', $immune2Selected);
        // }
        
        // if ($request->has('immune3')) {
        //     if (!empty($immune3Selected))
        //         $datas->where('immune3', $immune3Selected);
        // }
        
        // if ($request->has('immune4')) {
        //     if (!empty($immune4Selected))
        //         $datas->where('immune4', $immune4Selected);
        // }
        
        // if ($request->has('immune5')) {
        //     if (!empty($immune5Selected))
        //         $datas->where('immune5', $immune5Selected);
        // }
        
        // if ($request->has('contraception_type')) {
        //     if (!empty($contraception_typeSelected))
        //         $datas->where('contraception_type', $contraception_typeSelected);
        // }

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.wuspus.index', compact('citizen','kbs','kbSelected','datas',
                                                        // 'wuspus_id','couple_id','status_kk','klp_dawasima','alive','death','size'
                                                        // ,'immune1Selected','immune2Selected','immune3Selected','immune4Selected','immune5Selected'
                                                        // ,'contraception_typeSelected','contraception_date'
                                                    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // // $age = Carbon::parse($data->wuspusUser->date_birth)->age;
        // $citizen = Citizens::where('gender','perempuan')
        //             // ->whereBetween( Carbon::parse($data->wuspusUser->date_birth)->age , [15, 49])
        //             ->get();
        // $couple = Citizens::where('gender','laki-laki')
        //             ->where('family_status','kepala keluarga')
        //             ->get();
        // $kbs = KB::get();
        // $kbSelected =  $request->get('rt');

//render view dengan variable yang ada menggunakan 'compact', method bawaan php
return view('transactions.wuspus.form', compact('citizen','couple','kbs', 'kbSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
