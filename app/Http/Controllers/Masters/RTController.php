<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Masters\RT;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data dari table citizen dengan urutan ascending 10 pertama
        // $datas = RT::first()->paginate(10);
        $datas = RT::first()->cari(request(['search']))->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('masters.rt.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = RT::first();

        return view('masters.rt.form', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|required|max:255'

        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        RT::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => 'Menambah data RT : ' . $request->name, //name = nama tag di view (file index)
            'category' => 'Data RT',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai



        return redirect('/rt')->with('success', 'Data RT Berhasil Ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RT  $rT
     * @return \Illuminate\Http\Response
     */
    public function show(RT $rT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RT  $rT
     * @return \Illuminate\Http\Response
     */
    public function edit(RT $rT, $uuid)
    {
        $datas = RT::where('uuid', $uuid)->get();

        return view('masters.rt.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RT  $rT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {


        $validatedData = $request->validate([
            'name' => 'string|required|max:255'

        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        RT::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => 'Merubah data RT : ' . $request->name, //name = nama tag di view (file index)
            'category' => 'Data RT',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/rt')->with('success', 'Data RT Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RT  $rT
     * @return \Illuminate\Http\Response
     */
    public function destroy(RT $rT, $uuid)
    {
        $data = RT::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => 'Menghapus data RT : ' . $data->name, //name = nama tag di view (file index)
            'category' => 'Data RT',
            'created_at' => now(),
        ];
    
        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('rt.index')->with('success', 'Data berhasil dihapus!');
    }
}
