<?php

namespace App\Http\Controllers;

use App\Models\RW;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
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
        $validatedate = $request->validate([
            'name' => 'required|max:255',
            
        ]);
        $validatedate['uuid'] = Uuid::uuid4()->getHex();
        RW::create($validatedate);
        return redirect('/rw')->with('success', 'Data berhasil di tambah');

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
        // return view('masters.rw.edit');
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
        $rules = [
            'name' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        RW::where('id', $rW->id)->update($validatedData);
        return redirect('/rw')->with('success', 'Post has been update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function destroy(RW $rW, $uuid)
    {
        $data = RW::get()->where('uuid', $uuid);
        // RW::destroy($rW->id);
        $rW::destroy($data);
        return redirect('/rw')->with('success', 'Post terhapus');
    }
}
