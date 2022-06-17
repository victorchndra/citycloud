<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transactions\Citizens;
use App\Models\Transactions\MotherKB;
use App\Models\Masters\Immunization;
use App\Models\Transactions\KidsWeight;


class KidsWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = KidsWeight::first()->paginate(10);
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.kidsweight.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $imuns = Immunization::get();
        $imunSelected =  $request->get('imuns');
        $citizen = Citizens::orderBy('name', 'asc')->get();

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.kidsweight.form', compact('citizen', 'imuns', 'imunSelected'));
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
        $validatedData = $request->validate([            
            'weight' => 'required',
            'height' => 'required',
            'head_width' => 'required',
            'imdb' => 'required',
            'method_measure' => 'required',
            'vitamin' => 'required',
            'kms' => 'required',
            'imunitation' => 'required',
            'booster' => 'required',
            'e1' => 'required',
            'e2' => 'required',
            'e3' => 'required',
            'e4' => 'required',
            'e5' => 'required',
            'e6' => 'required',
            'notes' => 'required',
            'imunitation_date' => 'required'
        ]);

        $citizen           = Citizens::findOrFail($request->get('citizen_id'));    
        $validatedData['citizen_id']     = $citizen->id;
        $validatedData['nik'] = $citizen->nik;
        $validatedData['name'] = $citizen->name;

        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        $data = KidsWeight::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> Data Timbang Anak <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/kidsweight')->with('success', 'Data Timbang Anak Berhasil Ditambah!!');
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
    public function edit(Request $request, $uuid)
    {
        //
        $datas = KidsWeight::where('uuid', $uuid)->get();
        $citizen = KidsWeight::where('uuid', $uuid)->get();
        $imuns = Immunization::get();
        $imunSelected =  $request->get('imuns');

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.kidsweight.edit', compact('datas', 'citizen', 'imuns', 'imunSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        //        
        $validatedData = $request->validate([            
            'weight' => 'required',
            'height' => 'required',
            'head_width' => 'required',
            'imdb' => 'required',
            'method_measure' => 'required',
            'vitamin' => 'required',
            'kms' => 'required',
            'imunitation' => 'required',
            'booster' => 'required',
            'e1' => 'required',
            'e2' => 'required',
            'e3' => 'required',
            'e4' => 'required',
            'e5' => 'required',
            'e6' => 'required',
            'notes' => 'required',
            'imunitation_date' => 'required'

        ]);        
        $validatedData['updated_by'] = Auth::user()->id;
    
        KidsWeight::where('uuid', $uuid)->first()->update($validatedData);

        $data = KidsWeight::get()->where('uuid', $uuid)->firstOrFail();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Timbang Anak <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/kidsweight')->with('success', 'Data Timbang Anak Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
        $data = KidsWeight::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> Data Timbang Anak <strong>[' . $data->name . ']</strong>',
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();


        return redirect('/kidsweight')->with('success','Data berhasil dihapus');
    }
    
}
