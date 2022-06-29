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
                    ->join('mother_k_b_s', 'mother_k_b_s.citizen_id', '=', 'citizens.id')
                    ->join('pregnant_mothers','pregnant_mothers.citizen_id', '=', 'citizens.id')
                    // ->join('citizens','citizens.nik', '=', 'citizens.nik')
                    ->paginate(10);

        // dd($datas);
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');

        $citizen_id  =  $request->get('citizen_id');
        $name  =  $request->get('name');
        $date_birth  =  $request->get('date_birth');
        $number_lives  =  $request->get('number_lives');
        $number_death  =  $request->get('number_death');
        $lila  =  $request->get('lila');
        $tt1Selected    =  $request->get('tt1');
        $tt2Selected    =  $request->get('tt2');
        $tt3Selected    =  $request->get('tt3');
        $tt4Selected    =  $request->get('tt4');
        $tt5Selected    =  $request->get('tt5');
        $contraception_typeSelected    =  $request->get('contraception_type');
        $kb_nameSelected    =  $request->get('kb_name');
        $kb_date    =  $request->get('kb_date');
        $jkn    =  $request->get('jkn');

        if ($request->has('tt1')) {
            if (!empty($tt1Selected))
                $datas->where('tt1', $tt1Selected);
        }
        
        if ($request->has('tt2')) {
            if (!empty($tt2Selected))
                $datas->where('tt2', $tt2Selected);
        }
        
        if ($request->has('tt3')) {
            if (!empty($tt3Selected))
                $datas->where('tt3', $tt3Selected);
        }
        
        if ($request->has('tt4')) {
            if (!empty($tt4Selected))
                $datas->where('tt4', $tt4Selected);
        }
        
        if ($request->has('tt5')) {
            if (!empty($tt5Selected))
                $datas->where('tt5', $tt5Selected);
        }
        
        if ($request->has('kb_name')) {
            if (!empty($kb_nameSelected))
                $datas->where('kb_name', $kb_nameSelected);
        }

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.wuspus.index', compact('citizen','kbs','kbSelected','datas',
                                                        'citizen_id','name','date_birth','number_lives','number_death','lila',
                                                        'tt1Selected','tt2Selected','tt3Selected','tt4Selected','tt5Selected','kb_nameSelected','kb_date'
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

    public function exportWusPus(Request $request)
    {

        $data = Citizens::select('citizens.*','mother_k_b_s.*','pregnant_mothers.*')
                    ->where('citizens.gender','perempuan')
                    ->where('mother_k_b_s.deleted_at',null)
                    ->join('mother_k_b_s', 'mother_k_b_s.citizen_id', '=', 'citizens.id')
                    ->join('pregnant_mothers','pregnant_mothers.citizen_id', '=', 'citizens.id');
        // $data = Citizens::select('citizens.*','kids_weights.*','childrens.*')
        //                     ->where('kids_weights.deleted_at', null)
        //                     ->join('kids_weights', 'kids_weights.citizen_id', '=', 'citizens.id')
        //                     ->join('childrens', 'childrens.citizens_id', '=', 'citizens.id');
        // $data = KidsWeight::latest()->filter(
        //     request([
        //         'nik', 'name', 'weight', 'height', 'head_width', 'imdb', 'method_measure', 'vitamin', 'kms', 'imunitation', 'booster', 'e1', 'e2', 'e3', 'e4', 'e5', 'e6', 'notes'
        //     ])
        // );

        $citizen_id  =  $request->get('citizen_id');
        $name  =  $request->get('name');
        $date_birth  =  $request->get('date_birth');
        $number_lives  =  $request->get('number_lives');
        $number_death  =  $request->get('number_death');
        $lila  =  $request->get('lila');
        $tt1Selected    =  $request->get('tt1');
        $tt2Selected    =  $request->get('tt2');
        $tt3Selected    =  $request->get('tt3');
        $tt4Selected    =  $request->get('tt4');
        $tt5Selected    =  $request->get('tt5');
        $contraception_typeSelected    =  $request->get('contraception_type');
        $kb_nameSelected    =  $request->get('kb_name');
        $kb_date    =  $request->get('kb_date');
        $jkn    =  $request->get('jkn');

        if ($request->has('tt1')) {
            if (!empty($tt1Selected))
                $datas->where('tt1', $tt1Selected);
        }
        
        if ($request->has('tt2')) {
            if (!empty($tt2Selected))
                $datas->where('tt2', $tt2Selected);
        }
        
        if ($request->has('tt3')) {
            if (!empty($tt3Selected))
                $datas->where('tt3', $tt3Selected);
        }
        
        if ($request->has('tt4')) {
            if (!empty($tt4Selected))
                $datas->where('tt4', $tt4Selected);
        }
        
        if ($request->has('tt5')) {
            if (!empty($tt5Selected))
                $datas->where('tt5', $tt5Selected);
        }
        
        if ($request->has('kb_name')) {
            if (!empty($kb_nameSelected))
                $datas->where('kb_name', $kb_nameSelected);
        }
       
        // $data->orderBy('id', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data WUS/PUS', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return Excel::download(new WusPusExport(
            $datas,    

        ), 'Laporan Data WUS dan PUS.xls');
    }
}
