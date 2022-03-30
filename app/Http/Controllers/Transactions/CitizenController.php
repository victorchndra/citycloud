<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Transactions;

//wajib menggunakan use App\Http\Controllers\Controller untuk di controller
use Ramsey\Uuid\Uuid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $datas = Citizens::latest()->paginate(10);


       //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('masters.citizens.index', compact('datas'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.citizens.form', [
            'page' => 'create',
        ]);
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
            'nik' => 'numeric|min:16',
            'kk' => 'numeric|min:16',
            'name' => 'required|max:255',
            'date_birth' => 'required|date',
            'place_birth' => 'required',
            'religion' => 'required',
            'job' => 'required',
            'phone' => 'numeric|required',
            'marriage' => 'required',
            'move_date' => 'date|nullable',
            'death_date' => 'date|nullable',
            'gender' => 'required',
            'family_status' => 'required',
            'blood' => 'required',
            'vaccine_1' => 'nullable',
            'vaccine_2' => 'nullable',
            'vaccine_3' => 'nullable',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'village' => 'nullable',
            'sub_districts' => 'nullable',
            'districts' => 'nullable',
            'province' => 'nullable',
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        Citizens::create($validatedData);

        return redirect('/citizens')->with('success','Data kependudukan berhasil ditambah!');
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
    public function edit($uuid)
    {
        $citizen = Citizens::where('uuid', $uuid)->get();
        return view('masters.citizens.edit', compact('citizen'));
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
        $validatedData = $request->validate([
            'nik' => 'numeric|min:16',
            'kk' => 'numeric|min:16',
            'name' => 'required|max:255',
            'date_birth' => 'required|date',
            'place_birth' => 'required',
            'religion' => 'required',
            'job' => 'required',
            'phone' => 'numeric|required',
            'marriage' => 'required',
            'move_date' => 'date|nullable',
            'death_date' => 'date|nullable',
            'gender' => 'required',
            'family_status' => 'required',
            'blood' => 'required',
            'vaccine_1' => 'nullable',
            'vaccine_2' => 'nullable',
            'vaccine_3' => 'nullable',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'village' => 'nullable',
            'sub_districts' => 'nullable',
            'districts' => 'nullable',
            'province' => 'nullable',
        ]);

        Citizens::where('uuid', $uuid)->first()->update($validatedData);

        return redirect('/citizens')->with('success','Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $data = Citizens::get()->where('uuid', $uuid);
        // $data = Citizens::where('id', $id)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        // $data->save();
        // $data->delete();

        // return redirect()->route('transactions.citizens.index');
        // return redirect('transactions.citizens.index');
        Citizens::destroy($data);
        return redirect('/citizens')->with('success','Data berhasil dihapus!');
    }
}
