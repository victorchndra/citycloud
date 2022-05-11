<?php

namespace App\Http\Controllers\Masters;

use Ramsey\Uuid\Uuid;
use Illuminate\support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Masters\Information;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $datas = Information::first()->paginate(10);
        return view('masters.information.index', compact('datas'));
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
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        //
        $in = Information::where('uuid', $uuid)->get();
        return view('masters.information.edit',compact(['in']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        //
        $validatedate = $request->validate([
            'letter_index' => 'required|max:255',
            'village_name' => 'required|max:255',
            'sub_district_name' => 'required',
            'district_name' => 'required|max:255',
            'province_name' => 'required|max:255',
            'header' => 'image|file|max:50024',
            'signature' => 'image|file|max:50024',
            'logo' => 'image|file|max:50024',
            'code' => 'required',
        ]);

         if($request->file('header')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedate['header'] = $request->file('header')->store('information');
        }

        if($request->file('signature')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedate['signature'] = $request->file('signature')->store('information');
        }

        if($request->file('logo')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedate['logo'] = $request->file('logo')->store('information');
        }



        $validatedate['updated_by'] = Auth::user()->id;
        $validatedate['uuid'] = Uuid::uuid4()->getHex();
    
        Information::where('uuid',$uuid)->first()->update($validatedate);
    
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> Data Informasi <strong>[' . $request->header . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];
    
        DB::table('logs')->insert($log);

        return redirect('/information')->with('success', 'Data has been updated successfully');
        // return view('masters.information.index')->with('success', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        //
    }
}
