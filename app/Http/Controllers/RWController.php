<?php

namespace App\Http\Controllers;

use App\Models\RW;
use Illuminate\Http\Request;

class RWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = RW::first()->paginate(10);
        return view('masters.rw.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('masters.rw.form');
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
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function show(RW $rW)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function edit(RW $rW)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RW $rW)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function destroy(RW $rW)
    {
        //
    }
}
