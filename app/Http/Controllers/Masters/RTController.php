<?php

namespace App\Http\Controllers\Masters;
use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Masters\RT;
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
        $datas = RT::first()->paginate(10);


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
        

        return redirect('/rt')->with('success','Data RT Berhasil Ditambah!!');
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
        RT::where('uuid',$uuid)->first()->update($request->all());

        $validatedData = $request->validate([
            'name' => 'string|required|max:255'
            
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
    
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
        $data->delete();

        return redirect()->route('rt.index')->with('success', 'Data berhasil dihapus!');
    }
}
