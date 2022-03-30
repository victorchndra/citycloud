<?php

namespace App\Http\Controllers;

use App\Models\RW;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function edit($uuid)
    {
        //
        
        // $data = RW::where('id', $id)->first();
        // return view('masters.rw.edit',compact('data'));
        // return view('masters.rw.edit',[
        //     'rw' => $rW,
        //     'data' => RW::where('id',$rW->id)->first()
        // ]);
        
        $rw = RW::where('uuid', $uuid)->get();

        return view('masters.rw.edit',compact(['rw']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RW  $rW
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RW $rW,$uuid)
    {
    // $rules = [
    //     'name' => 'required|max:255',      
    // ];
    
    // $validatedData = $request->validate($rules);
    
    //     RW::where('id',$id->id)->update($validatedData);

    // $rw = RW::where('uuid', $uuid)->get();
    // $input = $request->all();
    // $rw->update($input);

    RW::where('uuid',$uuid)->first()->update($request->all());
    
        return redirect('/rw')->with('success', 'Data has been updated successfully');

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
