<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Transactions;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//panggil uuid library
use Ramsey\Uuid\Uuid;

//definisikan model
use App\Models\Transactions\Citizens;

//use export class
use App\Exports\CitizenExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

//use import class dan storage nya utk simpan data
use App\Imports\CitizenImport;



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

         // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
        'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
        'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
        )->whereNull('death_date')->whereNull('move_date')->paginate(10)->withQueryString();
  
        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $religionSelected =  $request->get('religion');
        $familyStatusSelected =  $request->get('family_status');
        $bloodSelected =  $request->get('blood');
        $job =  $request->get('job');
        $phone =  $request->get('phone');
        $vaccine1Selected =  $request->get('vaccine_1');
        $vaccine2Selected =  $request->get('vaccine_2');
        $vaccine3Selected =  $request->get('vaccine_3');
        $dtks =  $request->get('dtks');
        $rtSelected =  $request->get('rt');
        $rwSelected =  $request->get('rw');
        $villageSelected =  $request->get('village');
        $sub_districsSelected =  $request->get('sub_district');
        $districtSelected =  $request->get('district');
        $provinceSelected =  $request->get('province');
        $health_assuranceSelected =  $request->get('health_assurance');
        $lastEducationSelected =  $request->get('last_education');


        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $datas->where('gender',$genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religion))
                $datas->where('religion',$religion);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $datas->where('family_status',$familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $datas->where('blood',$bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $datas->where('vaccine_1',$vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $datas->where('vaccine_2',$vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $datas->where('vaccine_3',$vaccine3Selected);
        }


        if ($request->has('rt')) {      
            if (!empty($rtSelected))      
                $datas->where('rt',$rtSelected);
        }

        if ($request->has('rw')) {      
            if (!empty($rwSelected))      
                $datas->where('rw',$rwSelected);
        }

        if ($request->has('village')) {      
            if (!empty($villageSelected))      
                $datas->where('village',$villageSelected);
        }

        if ($request->has('sub_district')) {      
            if (!empty($sub_districsSelected))      
                $datas->where('sub_district',$sub_districsSelected);
        }

        if ($request->has('district')) {      
            if (!empty($districtSelected))      
                $datas->where('district',$districtSelected);
        }


        if ($request->has('province')) {      
            if (!empty($provinceSelected))      
                $datas->where('province',$provinceSelected);
        }

        if ($request->has('health_assurance')) {      
            if (!empty($health_assuranceSelected))      
                $datas->where('health_assurance',$health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {      
            if (!empty($lastEducationSelected))      
                $datas->where('lastEducation',$lastEducationSelected);
        }

        


       //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.index', compact('datas','nik','kk','name','genderSelected','place_birth','address',
        'religionSelected','familyStatusSelected','bloodSelected','job','phone','vaccine1Selected','vaccine2Selected','vaccine3Selected',
        'rtSelected','rwSelected','villageSelected','sub_districsSelected','provinceSelected','health_assuranceSelected','lastEducationSelected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.citizens.form', [
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

        $validatedData['created_by'] = Auth::user()->id;
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
        return view('transactions.citizens.edit', compact('citizen'));
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

        $validatedData['updated_by'] = Auth::user()->id;

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
        $data = Citizens::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $data->delete();

        return redirect()->route('citizens.index')->with('success', 'Data berhasil dihapus!');

    }


    public function exportCitizen(Request $request)
    {
    
       
        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
           $data = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
           'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
           'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
           )->whereNull('death_date')->whereNull('move_date');

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $religionSelected =  $request->get('religion');
        $familyStatusSelected =  $request->get('family_status');
        $bloodSelected =  $request->get('blood');
        $job =  $request->get('job');
        $phone =  $request->get('phone');
        $vaccine1Selected =  $request->get('vaccine_1');
        $vaccine2Selected =  $request->get('vaccine_2');
        $vaccine3Selected =  $request->get('vaccine_3');
        $dtks =  $request->get('dtks');
        $rtSelected =  $request->get('rt');
        $rwSelected =  $request->get('rw');
        $villageSelected =  $request->get('village');
        $sub_districsSelected =  $request->get('sub_district');
        $districtSelected =  $request->get('district');
        $provinceSelected =  $request->get('province');
        $health_assuranceSelected =  $request->get('health_assurance');
        $lastEducationSelected =  $request->get('last_education');

        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $data->where('gender',$genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religionSelected))
                $data->where('religion',$religionSelected);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $data->where('family_status',$familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $data->where('blood',$bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $data->where('vaccine_1',$vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $data->where('vaccine_2',$vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $data->where('vaccine_3',$vaccine3Selected);
        }

        if ($request->has('rt')) {      
            if (!empty($rtSelected))      
                $data->where('rt',$rtSelected);
        }

        if ($request->has('rw')) {      
            if (!empty($rwSelected))      
                $data->where('rw',$rwSelected);
        }

        if ($request->has('village')) {      
            if (!empty($villageSelected))      
                $data->where('village',$villageSelected);
        }

        if ($request->has('sub_district')) {      
            if (!empty($sub_districsSelected))      
                $data->where('sub_district',$sub_districsSelected);
        }

        if ($request->has('district')) {      
            if (!empty($districtSelected))      
                $data->where('district',$districtSelected);
        }


        if ($request->has('province')) {      
            if (!empty($provinceSelected))      
                $data->where('province',$provinceSelected);
        }

        if ($request->has('health_assurance')) {      
            if (!empty($health_assuranceSelected))      
                $data->where('health_assurance',$health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {      
            if (!empty($lastEducationSelected))      
                $data->where('lastEducation',$lastEducationSelected);
        }

        
    
        $datas = $data->get();

        
       
        return Excel::download(new CitizenExport($datas,$nik,$kk,$name,$genderSelected,$place_birth,$religionSelected,$address,
        $familyStatusSelected,$bloodSelected,$job,$phone,$vaccine1Selected,$vaccine2Selected,$vaccine3Selected,$rtSelected,
        $rwSelected,$villageSelected,$sub_districsSelected,$districtSelected,$provinceSelected,$health_assuranceSelected,
        $lastEducationSelected), 'Laporan Penduduk.xls');
        
    
}

public function importCitizen(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        // import data
        $import = Excel::import(new CitizenImport(), storage_path('app/public/excel/'.$nama_file));


        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('citizens.index')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('citizens.index')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

}
