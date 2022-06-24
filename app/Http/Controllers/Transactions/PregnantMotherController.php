<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Masters\Information;
use App\Models\Masters\KB;
use App\Models\Transactions\Citizens;
use App\Models\Transactions\PregnantMother;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\PregnantMotherExport;

class PregnantMotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citizen = Citizens::get();
        $datas = PregnantMother::paginate(10);
        // $datas = PregnantMother::where('uuid', $uuid)->firstOrFail()->paginate(10);

        $data = PregnantMother::latest()->filter(
            request([
                'citizen_id', 'weight', 'height','pregnant_to','gestational_age',
                'disease' ,'lila','check_pregnancy','number_lives','number_death',
                'meninggal', 'tt1','tt2','tt3','tt4','tt5'
            ])
        );
        
        $citizen_id  =  $request->get('citizen_id');
        $weight    =  $request->get('weight');
        $height    =  $request->get('height');
        $pregnant_to = $request->get('pregnant_to');
        $gestational_age    =  $request->get('gestational_age');
        $disease = $request->get('disease');
        $lila = $request->get('lila');
        $check_pregnancy    =  $request->get('check_pregnancy');
        $number_lives = $request->get('number_live');
        $number_death = $request->get('number_death');
        $meninggal = $request->get('meninggal');
        $tt1 = $request->get('tt1');
        $tt2 = $request->get('tt2');
        $tt3 = $request->get('tt3');
        $tt4 = $request->get('tt4');
        $tt5 = $request->get('tt5');
        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherpregnant.index', compact('data','datas', 'citizen','citizen_id','weight','height','pregnant_to',
    'gestational_age','disease','lila','check_pregnancy','number_lives','number_death','meninggal','tt1','tt2','tt3','tt4','tt5'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $datas = PregnantMother::first();
        $citizen = Citizens::get();
        return view('transactions.motherpregnant.form', compact('datas','citizen'));
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
        $validatedData = $request->validate([
            'citizen_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'pregnant_to' => 'required',
            'gestational_age' => 'required',
            'disease' => 'required',
            'check_pregnancy' => 'required',
            'lila' => 'required',
            'number_lives' => 'required',
            'number_death' => 'required',
            'meninggal' => 'required',
            'tt1' => 'required',
            'tt2' => 'required',
            'tt3' => 'required',
            'tt4' => 'required',
            'tt5' => 'required',

        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
      
        $panggil = PregnantMother::create($validatedData);
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Ibu Hamil <strong>[' . $panggil->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai



        return redirect('/motherpregnant')->with('success', 'Data Ibu Hamil Berhasil Ditambah!!');
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
    public function edit($uuid)
    {
        //
        $datas = PregnantMother::where('uuid', $uuid)->get();
        $citizen = Citizens::get();
        
        return view('transactions.motherpregnant.edit', compact('datas','citizen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'pregnant_to' => 'required',
            'gestational_age' => 'required',
            'disease' => 'required',
            'check_pregnancy' => 'required',
            'lila' => 'required',
            'number_lives' => 'required',
            'number_death' => 'required',
            'meninggal' => 'required',
            'tt1' => 'required',
            'tt2' => 'required',
            'tt3' => 'required',
            'tt4' => 'required',
            'tt5' => 'required',

        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        $data = PregnantMother::get()->where('uuid', $uuid)->firstOrFail();
        PregnantMother::where('uuid', $uuid)->first()->update($validatedData);
        
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Hamil <strong>[' . $data->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/motherpregnant')->with('success', 'Data Ibu Hamil Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
        $data = PregnantMother::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Ibu Hamil <strong>[' . $data->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect('/motherpregnant')->with('success', 'Data berhasil dihapus!');
    }

    public function exportPregnantMother(Request $request)
    { 
        $data =  PregnantMother::latest()->filter(
            request([
                'citizen_id', 'weight', 'height', 'pregnant_to', 'gestational_age', 'disease', 'lila','check_pregnancy',
                'number_live','number_death','meninggal','tt1','tt2','tt3','tt4','tt5',
            ]));

        $citizen_id  =  $request->get('citizen_id');
        $weight    =  $request->get('weight');
        $height    =  $request->get('height');
        $pregnant_to = $request->get('pregnant_to');
        $gestational_age    =  $request->get('gestational_age');
        $disease = $request->get('disease');
        $lila = $request->get('lila');
        $check_pregnancy    =  $request->get('check_pregnancy');
        $number_lives = $request->get('number_live');
        $number_death = $request->get('number_death');
        $meninggal = $request->get('meninggal');
        $tt1 = $request->get('tt1');
        $tt2 = $request->get('tt2');
        $tt3 = $request->get('tt3');
        $tt4 = $request->get('tt4');
        $tt5 = $request->get('tt5');


        // $data = Citizens::orderBy('kk', 'desc');
        $data->orderBy('id', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data Ibu Hamil', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);


        return Excel::download(new PregnantMotherExport(
            $datas
        ), 'Laporan Ibu Hamil.xls');
    }
}
