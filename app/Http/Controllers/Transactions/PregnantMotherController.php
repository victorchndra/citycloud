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
use App\Models\Transactions\PregnantMother;

class PregnantMotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citizen = Citizens::get();
        $datas = PregnantMother::paginate(10);
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherpregnant.index', compact('datas', 'citizen'));
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
        PregnantMother::create($validatedData);
        $data = PregnantMother::get()->where('uuid')->firstOrFail();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Ibu Hamil <strong>[' . $data->motherUser->name . ']</strong>', //name = nama tag di view (file index)
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
}
