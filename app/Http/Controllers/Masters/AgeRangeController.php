<?php

namespace App\Http\Controllers\Masters;
use Ramsey\Uuid\Uuid;

use App\Models\Masters\ageRange;
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
        return view('masters.agerange.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.agerange.form');
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
            'start' => 'numeric|required',
            'end' => 'numeric|required',
            'notes' => 'string|required|max:255'

        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        
        MastersAgeRange::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Rentang Umur <strong>[' . $request->notes . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/agerange')->with('success', 'Data Rentang Usia Berhasil Ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function show(MastersAgeRange $ageRange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function edit(MastersAgeRange $ageRange, $uuid)
    {
        $datas = MastersAgeRange::where('uuid', $uuid)->get();

        return view('masters.agerange.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MastersAgeRange $ageRange, $uuid)
    {
        

        

        $validatedData = $request->validate([
            'start' => 'numeric|required',
            'end' => 'numeric|required',
            'notes' => 'string|required|max:255'

        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        MastersAgeRange::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Rentang Usia <strong>[' . $request->notes . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/agerange')->with('success', 'Data Rentang Usia Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ageRange  $ageRange
     * @return \Illuminate\Http\Response
     */
    public function destroy(MastersAgeRange $ageRange, $uuid)
    {
        $data = MastersAgeRange::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Rentang Usia <strong>[' . $data->notes . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('agerange.index')->with('success', 'Data Rentang Usia Berhasil Dihapus!');
    }
}
