<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transactions\Citizens;
use App\Models\Masters\Immunization;
use App\Models\Transactions\KidsWeight;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\KidsWeightExport;


class KidsWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $datas = KidsWeight::first()->paginate(20);
        $data = KidsWeight::latest()->filter(
            request([
                'nik', 'name', 'weight', 'height', 'head_width', 'imdb', 'method_measure', 'vitamin', 'kms', 'imunitation', 'booster', 'e1', 'e2', 'e3', 'e4', 'e5', 'e6', 'notes'
            ])
        );
        // $datas = MotherKb::where('uuid', $uuid)->firstOrFail()->paginate(10);

        $nik =  $request->get('nik');
        $name =  $request->get('name');
        $weight =  $request->get('weight');
        $height =  $request->get('height');
        $imdbSelected =  $request->get('imdb');
        $headWidth =  $request->get('head_width');
        $methodMeasureSelected =  $request->get('method_measure');
        $vitaminSelected =  $request->get('vitamin');
        $kmsSelected =  $request->get('kms');
        $imunitationSelected =  $request->get('imunitation');
        $boosterSelected =  $request->get('booster');
        $e1Selected =  $request->get('e1');
        $e2Selected =  $request->get('e2');
        $e3Selected =  $request->get('e3');
        $e4Selected =  $request->get('e4');
        $e5Selected =  $request->get('e5');
        $e6Selected =  $request->get('e6');
        $notes =  $request->get('notes');

        

        if ($request->has('imdb')) {
            if (!empty($imdbSelected))
                $datas->where('imdb', $imdbSelected);
        }

        if ($request->has('method_measure')) {
            if (!empty($methodMeasureSelected))
                $datas->where('method_measure', $methodMeasureSelected);
        }

        if ($request->has('vitamin')) {
            if (!empty($vitaminSelected))
                $datas->where('vitamin', $vitaminSelected);
        }

        if ($request->has('kms')) {
            if (!empty($kmsSelected))
                $datas->where('kms', $kmsSelected);
        }

        if ($request->has('imunitation')) {
            if (!empty($imunitationSelected))
                $datas->where('imunitation', $imunitationSelected);
        }

        if ($request->has('booster')) {
            if (!empty($boosterSelected))
                $datas->where('booster', $boosterSelected);
        }

        if ($request->has('e1')) {
            if (!empty($e1Selected))
                $datas->where('e1', $e1Selected);
        }

        if ($request->has('e2')) {
            if (!empty($e2Selected))
                $datas->where('e2', $e2Selected);
        }

        if ($request->has('e3')) {
            if (!empty($e3Selected))
                $datas->where('e3', $e3Selected);
        }

        if ($request->has('e4')) {
            if (!empty($e4Selected))
                $datas->where('e4', $e4Selected);
        }

        if ($request->has('e5')) {
            if (!empty($e5Selected))
                $datas->where('e5', $e5Selected);
        }

        if ($request->has('e6')) {
            if (!empty($e6Selected))
                $datas->where('e6', $e6Selected);
        }

        if ($request->has('notes')) {
            if (!empty($notes))
                $datas->where('notes', $notes);
        }
        

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.kidsweight.index', compact('datas','nik','name','weight','height','imdbSelected','headWidth','methodMeasureSelected','vitaminSelected','kmsSelected','imunitationSelected','boosterSelected','e1Selected','e2Selected','e3Selected','e4Selected','e5Selected','e6Selected','notes'));
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


        return redirect('/kidsweight')->with('success', 'Data berhasil dihapus');
    }
    public function exportKidsWeight(Request $request)
    {

        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = KidsWeight::latest()->filter(
            request([
                'nik', 'name', 'weight', 'height', 'head_width', 'imdb', 'method_measure', 'vitamin', 'kms', 'imunitation', 'booster', 'e1', 'e2', 'e3', 'e4', 'e5', 'e6', 'notes'
            ])
        );

        $nik =  $request->get('nik');
        $name =  $request->get('name');
        $weight =  $request->get('weight');
        $height =  $request->get('height');
        $imdbSelected =  $request->get('imdb');
        $headWidth =  $request->get('head_width');
        $methodMeasureSelected =  $request->get('method_measure');
        $vitaminSelected =  $request->get('vitamin');
        $kmsSelected =  $request->get('kms');
        $imunitationSelected =  $request->get('imunitation');
        $boosterSelected =  $request->get('booster');
        $e1Selected =  $request->get('e1');
        $e2Selected =  $request->get('e2');
        $e3Selected =  $request->get('e3');
        $e4Selected =  $request->get('e4');
        $e5Selected =  $request->get('e5');
        $e6Selected =  $request->get('e6');
        $notes =  $request->get('notes');


        if ($request->has('imdb')) {
            if (!empty($imdbSelected))
                $data->where('imdb', $imdbSelected);
        }

        if ($request->has('method_measure')) {
            if (!empty($methodMeasureSelected))
                $data->where('method_measure', $methodMeasureSelected);
        }

        if ($request->has('vitamin')) {
            if (!empty($vitaminSelected))
                $data->where('vitamin', $vitaminSelected);
        }

        if ($request->has('kms')) {
            if (!empty($kmsSelected))
                $data->where('kms', $kmsSelected);
        }

        if ($request->has('imunitation')) {
            if (!empty($imunitationSelected))
                $data->where('imunitation', $imunitationSelected);
        }

        if ($request->has('booster')) {
            if (!empty($boosterSelected))
                $data->where('booster', $boosterSelected);
        }

        if ($request->has('e1')) {
            if (!empty($e1Selected))
                $data->where('e1', $e1Selected);
        }

        if ($request->has('e2')) {
            if (!empty($e2Selected))
                $data->where('e2', $e2Selected);
        }

        if ($request->has('e3')) {
            if (!empty($e3Selected))
                $data->where('e3', $e3Selected);
        }

        if ($request->has('e4')) {
            if (!empty($e4Selected))
                $data->where('e4', $e4Selected);
        }

        if ($request->has('e5')) {
            if (!empty($e5Selected))
                $data->where('e5', $e5Selected);
        }

        if ($request->has('e6')) {
            if (!empty($e6Selected))
                $data->where('e6', $e6Selected);
        }

        if ($request->has('notes')) {
            if (!empty($notes))
                $data->where('notes', $notes);
        }
       
        $data->orderBy('id', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data timbang anak', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return Excel::download(new KidsWeightExport(
            $datas,
            $nik,            
            $name,
            $weight,
            $height,
            $imdbSelected,
            $headWidth,
            $methodMeasureSelected,
            $vitaminSelected,
            $kmsSelected,
            $imunitationSelected,
            $boosterSelected,
            $e1Selected,
            $e2Selected,
            $e3Selected,
            $e4Selected,
            $e5Selected,
            $e6Selected,
            $notes,            

        ), 'Laporan Data Timbang.xls');
    }
}
