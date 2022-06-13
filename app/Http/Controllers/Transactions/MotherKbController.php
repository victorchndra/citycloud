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

class MotherKbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citizen = Citizens::get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');
        $datas = MotherKb::first()->paginate(10);
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherkb.index', compact('datas', 'kbs', 'kbSelected', 'citizen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $citizen = Citizens::where([
                                    ['gender', '=', 'perempuan'],
                                    ['family_status', '=', 'kepala keluarga']
                            ])->orwhere([
                                    ['gender', '=', 'perempuan'],
                                    ['family_status', '=', 'istri']
                            ])->get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherkb.form', compact('kbs', 'kbSelected', 'citizen'));
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
            'mother_id' => 'required',
            'kb_name' => 'required',
            'kb_date' => 'required',
        ]);

        // $citizen           = Citizens::findOrFail($request->get('citizens'));
        // $validatedData['citizen_id']     = $citizen->id;
        // $validatedData['nik'] = $citizen->nik;
        // $validatedData['name'] = $citizen->name;

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;

        MotherKb::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Ibu KB <strong>[' . $request->mother_id . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai



        return redirect('/motherkb')->with('success', 'Data KB Berhasil Ditambah!!');
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
    public function edit($uuid, Request $request)
    {
        $motherkb = MotherKb::where('uuid', $uuid)->get();
        $citizen = Citizens::where([
                    ['gender', '=', 'perempuan'],
                    ['family_status', '=', 'kepala keluarga']
            ])->orwhere([
                    ['gender', '=', 'perempuan'],
                    ['family_status', '=', 'istri']
            ])->get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');
        $datas = MotherKb::first()->paginate(10);

        return view('transactions.motherkb.edit',compact(['motherkb','citizen','kbs','kbSelected','datas']));
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
            'mother_id' => 'required',
            'kb_name' => 'required',
            'kb_date' => 'required'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        MotherKb::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Ibu KB <strong>[' . $request->mother_id . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/motherkb')->with('success', 'Data KB Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $data = MotherKb::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data ibu kb <strong>[' . $data->mother_id . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('motherkb.index')->with('success', 'Data berhasil dihapus!');
    }
}
