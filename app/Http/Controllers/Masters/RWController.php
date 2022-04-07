<?php

namespace App\Http\Controllers\Masters;
use App\Models\Log;

use Ramsey\Uuid\Uuid;
use App\Models\Masters\RW;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //


        $datas = RW::first()->cari(request(['search']))->paginate(10);
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
        $validatedate['created_by'] = Auth::user()->id;
        $validatedate['uuid'] = Uuid::uuid4()->getHex();

        RW::create($validatedate);

        // tambahkan baris kode ini di setiap controller
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data RW <strong>[' . $request->name . ']</strong>',
            'category' => 'Data RW',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

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
    //
    $validatedate = $request->validate([
        'name' => 'required|max:255',

    ]);
    $validatedate['updated_by'] = Auth::user()->id;
    $validatedate['uuid'] = Uuid::uuid4()->getHex();

    RW::where('uuid',$uuid)->first()->update($validatedate);

    $log = [
        'uuid' => Uuid::uuid4()->getHex(),
        'user_id' => Auth::user()->id,
        'description' => '<em>Mengubah</em> data RW <strong>[' . $request->name . ']</strong>',, //name = nama tag di view (file index)
        'category' => 'Data RW',
        'created_at' => now(),
    ];

    DB::table('logs')->insert($log);

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
        // $data = RW::get()->where('uuid', $uuid);
        // // RW::destroy($rW->id);
        // $rW::destroy($data);
        $data = RW::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;

        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data RW <strong>[' . $data->name . ']</strong>',, //name = nama tag di view (file index)
            'category' => 'Data RW',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();


        return redirect('/rw')->with('success', 'Post terhapus');
    }

    // public function view(Request $request){
    //    $search = $request['search'] ?? "";
    //    if($search != ""){
    //        //method where
    //        $rw = RW::where('name','LIKE',"%$search%")->get();
    //    }else{
    //        $rw = RW::all();
    //    }

    //    return view('layouts.app', compact('rw','search'));
    // }

}
