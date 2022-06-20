<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Masters\Information;
use App\Models\Masters\KB;
use App\Models\Transactions\Citizens;
use App\Models\Transactions\MotherKB;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\MotherKbExport;

class MotherKbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citizen = Citizens::get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');
        $datas = MotherKb::paginate(10);
        $data = MotherKB::latest()->filter(
            request([
                'mother_id', 'kb_name', 'kb_date'
            ])
        );

        $mother_id  =  $request->get('mother_id');
        $kb_name    =  $request->get('kb_name');
        $kb_date    =  $request->get('kb_date');

        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherkb.index', compact('datas', 'kbs', 'kbSelected', 'citizen','data','mother_id','kb_name','kb_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $citizen = Citizens::where([
                                    ['gender', '=', 'perempuan'],
                                    ['family_status', '=', 'kepala keluarga']
                            ])->orwhere([
                                    ['gender', '=', 'perempuan'],
                                    ['family_status', '=', 'istri']
                            ])->get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.motherkb.form', compact('kbs', 'kbSelected', 'citizen'));
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
            'mother_id' => 'required',
            'kb_name' => 'required',
            'kb_date' => 'required',
        ]);

        // $validatedData['nik'] = $citizen->nik;
        // $validatedData['name'] = $citizen->name;

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;

        $panggil = MotherKb::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Ibu KB <strong>[' . $panggil->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai



        return redirect('/motherkb')->with('success', 'Data KB Berhasil Ditambah!!');
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
    public function edit($uuid, Request $request)
    {
        $motherkb = MotherKb::where('uuid', $uuid)->get();
        $citizen = Citizens::where([
                    ['gender', '=', 'perempuan'],
                    ['family_status', '=', 'kepala keluarga']
            ])->orwhere([
                    ['gender', '=', 'perempuan'],
                    ['family_status', '=', 'istri']
            ])->get();
        $kbs = KB::get();
        $kbSelected =  $request->get('rt');
        $datas = MotherKb::first()->paginate(10);

        return view('transactions.motherkb.edit',compact(['motherkb','citizen','kbs','kbSelected','datas']));
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
            'mother_id' => 'required',
            'kb_name' => 'required',
            'kb_date' => 'required'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        MotherKb::where('uuid', $uuid)->first()->update($validatedData);
        $data = MotherKb::get()->where('uuid', $uuid)->first();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Ibu KB <strong>[' . $data->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/motherkb')->with('success', 'Data KB Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $data = MotherKb::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data ibu KB <strong>[' . $data->motherUser->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('motherkb.index')->with('success', 'Data berhasil dihapus!');
    }

    //EXPORT GOES HERE
    public function exportMotherKb(Request $request)
    { 
        $data =  MotherKB::latest()->filter(
            request([
                'mother_id', 'kb_name', 'kb_date',
            ]));

        $mother_id  =  $request->get('mother_id');
        $kb_name    =  $request->get('kb_name');
        $kb_date    =  $request->get('kb_date');

        // $nik =  $request->get('nik');
        // $kk =  $request->get('kk');
        // $name =  $request->get('name');
        // $genderSelected =  $request->get('gender');
        // $date_birth =  $request->get('date_birth');
        // $date_birth2 =  $request->get('date_birth2');
        // $place_birth =  $request->get('place_birth');
        // $address =  $request->get('address');
        // $religionSelected =  $request->get('religion');
        // $familyStatusSelected =  $request->get('family_status');
        // $healthAssurancesSelected =  $request->get('health_assurance');
        // $bloodSelected =  $request->get('blood');
        // $job =  $request->get('job');
        // $phone =  $request->get('phone');
        // $vaccine1Selected =  $request->get('vaccine_1');
        // $vaccine2Selected =  $request->get('vaccine_2');
        // $vaccine3Selected =  $request->get('vaccine_3');
        // $dtks =  $request->get('dtks');
        // $rtSelected =  $request->get('rt');
        // $rwSelected =  $request->get('rw');
        // $villageSelected =  $request->get('village');
        // $sub_districsSelected =  $request->get('sub_district');
        // $districtSelected =  $request->get('district');
        // $provinceSelected =  $request->get('province');


        // if ($request->has('gender')) {
        //     if (!empty($genderSelected))
        //         $data->where('gender', $genderSelected);
        // }

        // if ($request->has('religion')) {
        //     if (!empty($religionSelected))
        //         $data->where('religion', $religionSelected);
        // }

        // if ($request->has('health_assurance')) {
        //     if (!empty($healthAssurancesSelected))
        //         $data->where('health_assurance', $healthAssurancesSelected);
        // }

        // if ($request->has('family_status')) {
        //     if (!empty($familyStatusSelected))
        //         $data->where('family_status', $familyStatusSelected);
        // }

        // if ($request->has('blood')) {
        //     if (!empty($bloodSelected))
        //         $data->where('blood', $bloodSelected);
        // }

        // if ($request->has('vaccine_1')) {
        //     if (!empty($vaccine1Selected))
        //         $data->where('vaccine_1', $vaccine1Selected);
        // }

        // if ($request->has('vaccine_2')) {
        //     if (!empty($vaccine2Selected))
        //         $data->where('vaccine_2', $vaccine2Selected);
        // }

        // if ($request->has('vaccine_3')) {
        //     if (!empty($vaccine3Selected))
        //         $data->where('vaccine_3', $vaccine3Selected);
        // }

        // if ($request->has('rt')) {
        //     if (!empty($rtSelected))
        //         $data->where('rt', $rtSelected);
        // }

        // if ($request->has('rw')) {
        //     if (!empty($rwSelected))
        //         $data->where('rw', $rwSelected);
        // }

        // if ($request->has('village')) {
        //     if (!empty($villageSelected))
        //         $data->where('village', $villageSelected);
        // }

        // if ($request->has('sub_district')) {
        //     if (!empty($sub_districsSelected))
        //         $data->where('sub_district', $sub_districsSelected);
        // }

        // if ($request->has('district')) {
        //     if (!empty($districtSelected))
        //         $data->where('district', $districtSelected);
        // }

        // if ($request->has('province')) {
        //     if (!empty($provinceSelected))
        //         $data->where('province', $provinceSelected);
        // }



        // $data = Citizens::orderBy('kk', 'desc');
        $data->orderBy('id', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data Ibu KB', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);


        return Excel::download(new MotherKbExport(
            $datas
            // $nik,
            // $kk,
            // $name,
            // $genderSelected,
            // $date_birth,
            // $date_birth2,
            // $place_birth,
            // $religionSelected,
            // $address,
            // $familyStatusSelected,
            // $healthAssurancesSelected,
            // $bloodSelected,
            // $job,
            // $phone,
            // $vaccine1Selected,
            // $vaccine2Selected,
            // $vaccine3Selected,
            // $rtSelected,
            // $rwSelected,
            // $villageSelected,
            // $sub_districsSelected,
            // $districtSelected,
            // $provinceSelected,

        ), 'Laporan Ibu KB.xls');
    }
}
