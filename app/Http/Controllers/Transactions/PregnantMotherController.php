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
        $datas = PregnantMother::first()->paginate(10);
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherpregnant.index', compact('datas', 'kbs', 'kbSelected', 'citizen'));
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

        return view('masters.motherpregnant.form', compact('datas'));
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
            'citizen_id' => 'integer|required|max:255',
            'weight' => 'integer|required|max:255',
            'height' => 'integer|required|max:255',
            'pregnant to' => 'integer|required|max:255',
            'gestational_age' => 'integer|required|max:255',
            'disease' => 'string|required|max:255',
            'check_pregnancy' => 'string|required|max:255',
            'lila' => 'string|required|max:255',
            'number_lives' => 'string|required|max:255',
            'number_death' => 'string|required|max:255',
            'meninggal' => 'string|required|max:255',
            'tt1' => 'string|required|max:255',
            'tt2' => 'string|required|max:255',
            'tt3' => 'string|required|max:255',
            'tt4' => 'string|required|max:255',
            'tt5' => 'string|required|max:255',

        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        PregnantMother::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Ibu Hamil <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
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

        
        return view('masters.motherpregnant.edit', compact('datas'));
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
            'citizen_id' => 'integer|required|max:255',
            'weight' => 'integer|required|max:255',
            'height' => 'integer|required|max:255',
            'pregnant to' => 'integer|required|max:255',
            'gestational_age' => 'integer|required|max:255',
            'disease' => 'string|required|max:255',
            'check_pregnancy' => 'string|required|max:255',
            'lila' => 'string|required|max:255',
            'number_lives' => 'string|required|max:255',
            'number_death' => 'string|required|max:255',
            'meninggal' => 'string|required|max:255',
            'tt1' => 'string|required|max:255',
            'tt2' => 'string|required|max:255',
            'tt3' => 'string|required|max:255',
            'tt4' => 'string|required|max:255',
            'tt5' => 'string|required|max:255',

        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        PregnantMother::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Hamil <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
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
            'description' => '<em>Menghapus</em> data Ibu Hamil <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect('/motherpregnant')->with('success', 'Data berhasil dihapus!');
    }
}
