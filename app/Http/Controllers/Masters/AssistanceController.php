<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Masters;
use Ramsey\Uuid\Uuid;


//wajib menggunakan use App\Http\Controllers\Controller untuk di controller
use Illuminate\Http\Request;

use App\Models\Masters\Assistance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


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

        // tambahkan baris kode ini di setiap controller
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data bantuan sosial <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

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
        $validatedData = $request->validate([
            'name' => 'required',
            'nominal' => 'numeric|min:10'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        Assistance::where('uuid', $uuid)->first()->update($validatedData);

        // tambahkan baris kode ini di setiap controller
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data bantuan sosial <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

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
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data bantuan sosial <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('assistance.index')->with('success', 'Data has been deleted successfully');
    }

}
