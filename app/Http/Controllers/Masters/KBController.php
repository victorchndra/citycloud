<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Masters\KB;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KBController extends Controller
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
        $datas = KB::first()->cari(request(['search']))->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('masters.kb.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = KB::first();

        return view('masters.kb.form', compact('datas'));
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
        KB::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data KB <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai



        return redirect('/kb')->with('success', 'Data KB Berhasil Ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KB  $kB
     * @return \Illuminate\Http\Response
     */
    public function show(KB $kB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KB  $kB
     * @return \Illuminate\Http\Response
     */
    public function edit(KB $kB, $uuid)
    {
        $datas = KB::where('uuid', $uuid)->get();

        
        return view('masters.kb.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KB  $kB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {


        $validatedData = $request->validate([
            'name' => 'string|required|max:255'

        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        KB::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data KB <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/kb')->with('success', 'Data KB Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KB  $kB
     * @return \Illuminate\Http\Response
     */
    public function destroy(KB  $kB, $uuid)
    {
        $data = KB::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data KB <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('kb.index')->with('success', 'Data berhasil dihapus!');
    }
}
