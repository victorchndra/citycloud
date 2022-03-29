<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Transactions;

//wajib menggunakan use App\Http\Controllers\Controller untuk di controller
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\Transactions\Citizens;


class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // tempat nampilin data
    public function index(Request $request)
    {

       //get data dari table citizen dengan urutan ascending 10 pertama
        $datas = Citizens::first()->paginate(10);


       //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.index', compact('datas'));
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = Citizens::where('id', $id)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $data->delete();

        return redirect()->route('transactions.citizens.index');
    }
}
