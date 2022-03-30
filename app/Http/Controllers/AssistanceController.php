<?php

namespace App\Http\Controllers;

//wajib menggunakan use App\Http\Controllers\Controller untuk di controller
use Ramsey\Uuid\Uuid;

use App\Models\Assistance;
use Illuminate\Http\Request;
use App\Http\Controllers\AssistanceController;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data dari table citizen dengan urutan ascending 10 pertama
        $datas = Assistance::first()->paginate(10);


       //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('masters.assistance.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.assistance.form');
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
            'name' => 'required',
            'nominal' => 'numeric|min:10'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        Assistance::create($validatedData);

        return redirect('/assistance')->with('success','Data Bantuan Sosial berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function show(Assistance $assistance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistance $assistance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistance $assistance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        // $data = Assistance::get()->where('uuid', $uuid);
        // $assistance::destroy($data);
        // return redirect('/assistance')->with('success', 'Bansos terhapus');

        $data = Assistance::get()->where('uuid', $uuid);
        
        Assistance::destroy($data);
        return redirect('/assistance')->with('success','Data berhasil dihapus!');
    }
}
