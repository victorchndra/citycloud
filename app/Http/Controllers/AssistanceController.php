<?php

namespace App\Http\Controllers;

//wajib menggunakan use App\Http\Controllers\Controller untuk di controller
use Ramsey\Uuid\Uuid;

use App\Models\Assistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $datas = Assistance::first()->cari(request(['search']))->paginate(10);


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

        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        Assistance::create($validatedData);

        return redirect('/assistance')->with('success','Data has been created successfully');
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
    public function edit($uuid)
    {
        $assistance = Assistance::where('uuid', $uuid)->get();

        return view('masters.assistance.edit',compact(['assistance']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData['updated_by'] = Auth::user()->id;
        
        // Assistance::where('uuid', $uuid)->first()->update($validatedData);
        Assistance::where('uuid',$uuid)->first()->update($request->all());

        return redirect('/assistance')->with('success', 'Data has been updated successfully');
    }

    /**     
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        
        // $data->deleted_by = Auth::user()->id;
        // $data = Assistance::get()->where('uuid', $uuid);
        
        // Assistance::destroy($data);
        // return redirect('/assistance')->with('success','Data berhasil dihapus!');
        
        $data = Assistance::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $data->delete();
        
        return redirect()->route('assistance.index')->with('success', 'Data has been deleted successfully');
    }

}
