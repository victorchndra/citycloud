<?php

namespace App\Http\Controllers\Masters;
use Ramsey\Uuid\Uuid;

use App\Models\ageRange;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Masters\ageRange as MastersAgeRange;
use Illuminate\Support\Facades\Auth;

class AgeRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data dari table citizen dengan urutan ascending 10 pertama
        $datas = MastersAgeRange::first()->cari(request(['search']))->paginate(10);


       //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('masters.ageRange.index', compact('datas'));
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
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function show(ageRange $ageRange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function edit(ageRange $ageRange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ageRange $ageRange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function destroy(ageRange $ageRange)
    {
        //
    }
}
