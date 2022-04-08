<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Transactions;

use Ramsey\Uuid\Uuid;

use Illuminate\Http\Request;
use App\Exports\CitizenExport;
//panggil uuid library
use App\Exports\CitizenDTKSExport;

//definisikan model
use Illuminate\Support\Facades\DB;

//use export class
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Transactions\Citizens;
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
        $datas = Citizens::latest()->whereNull('death_date')->whereNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
            ])
        )->paginate(20)->withQueryString();

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
                $datas->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religion))
                $datas->where('religion', $religion);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $datas->where('family_status', $familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $datas->where('blood', $bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $datas->where('vaccine_1', $vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $datas->where('vaccine_2', $vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $datas->where('vaccine_3', $vaccine3Selected);
        }


        if ($request->has('rt')) {
            if (!empty($rtSelected))
                $datas->where('rt', $rtSelected);
        }

        if ($request->has('rw')) {
            if (!empty($rwSelected))
                $datas->where('rw', $rwSelected);
        }

        if ($request->has('village')) {
            if (!empty($villageSelected))
                $datas->where('village', $villageSelected);
        }

        if ($request->has('sub_district')) {
            if (!empty($sub_districsSelected))
                $datas->where('sub_district', $sub_districsSelected);
        }

        if ($request->has('district')) {
            if (!empty($districtSelected))
                $datas->where('district', $districtSelected);
        }


        if ($request->has('province')) {
            if (!empty($provinceSelected))
                $datas->where('province', $provinceSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($health_assuranceSelected))
                $datas->where('health_assurance', $health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {
            if (!empty($lastEducationSelected))
                $datas->where('lastEducation', $lastEducationSelected);
        }

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.index', compact(
            'datas',
            'nik',
            'kk',
            'name',
            'genderSelected',
            'place_birth',
            'address',
            'religionSelected',
            'familyStatusSelected',
            'bloodSelected',
            'job',
            'phone',
            'vaccine1Selected',
            'vaccine2Selected',
            'vaccine3Selected',
            'rtSelected',
            'rwSelected',
            'villageSelected',
            'sub_districsSelected',
            'provinceSelected',
            'health_assuranceSelected',
            'lastEducationSelected'
        ));
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
            'move_to' => 'nullable',
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
            'address' => 'required',
            'dtks'=> 'required',
            'last_education' => 'required',
            'health_assurance' => 'required'
        ]);

        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        Citizens::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data penduduk baru <strong>[' . $request->name . ']</strong>',
            'category' => 'Semua Kependudukan',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/citizens')->with('success', 'Data kependudukan berhasil ditambah!');
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
            'address' => 'required',
            'dtks'=> 'required',
            'last_education' => 'required',
            'move_to' => 'nullable',
            'health_assurance' => 'required'
        ]);

        $validatedData['updated_by'] = Auth::user()->id;

        Citizens::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data penduduk <strong>[' . $request->name . ']</strong>',
            'category' => 'Semua Kependudukan',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/citizens')->with('success', 'Data berhasil diperbarui!');
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
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data penduduk <strong>[' . $data->name . ']</strong>',
            'category' => 'Semua Kependudukan',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('citizens.index')->with('success', 'Data berhasil dihapus!');
    }


        // View Family
        public function familyCitizens(Request $request){
            $datas = Citizens::latest()->filter(
                request([
                    'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                    'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                    'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
                ])
            )->where('family_status','=','kepala keluarga')->paginate(20)->withQueryString();
    
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
            return view('transactions.citizens.family', compact('datas','nik','kk','name','genderSelected','place_birth','address',
            'religionSelected','familyStatusSelected','bloodSelected','job','phone','vaccine1Selected','vaccine2Selected','vaccine3Selected',
            'rtSelected','rwSelected','villageSelected','sub_districsSelected','provinceSelected','health_assuranceSelected','lastEducationSelected'));
        }
        //End View Death Date
    
        // Export Family Date
        public function exportFamilyCitizen(Request $request)
        {
    
            // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
            $data = Citizens::latest()->filter(
                request([
                    'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                    'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                    'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
                ])
            )->where('family_status','=','kepala keluarga');
    
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
            $lastEducationSelected), 'Laporan Kartu Keluarga.xls');
    
    
        }
        // End Export Death Date
    

    // View Move Date
    public function moveCitizens(Request $request){
        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
        'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
        'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
        )->whereNull('death_date')->whereNotNull('move_date')->paginate(10)->withQueryString();

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
        return view('transactions.citizens.move', compact('datas','nik','kk','name','genderSelected','place_birth','address',
        'religionSelected','familyStatusSelected','bloodSelected','job','phone','vaccine1Selected','vaccine2Selected','vaccine3Selected',
        'rtSelected','rwSelected','villageSelected','sub_districsSelected','provinceSelected','health_assuranceSelected','lastEducationSelected'));
    }
    //End View Move Date

    public function moveUpdateCitizen(Request $request, $uuid)
    {
        $data = Citizens::get()->where('uuid', $uuid)->whereNull('move_date')->firstOrFail();
        $data->update([
            'updated_by' =>Auth::user()->id,
            'move_date' => $data->move_date,
            'move_to' => $data->move_to,
        ]);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data penduduk <strong>[' . $request->name . ']</strong>',
            'category' => 'Semua Kependudukan',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/move')->with('success', 'Data berhasil diperbarui!');
    }

    // Rollback Move Date
    public function rollBackMoveDate(Request $request, $uuid)
    {
        $data = Citizens::get()->where('uuid', $uuid)->whereNotNull('move_date')->firstOrFail();
        $data->update([
            'updated_by' =>Auth::user()->id,
            'move_date' => null,
            'move_to' => null,
        ]);

        // tambahkan baris kode ini di setiap controller
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data dari penduduk pindah <strong>[' . $data->name . ']</strong>',
            'category' => 'Bantuan Sosial',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/move')->with('success', 'Data Penduduk Pindah berhasil dihapus!');
    }
    // End Rollback Move Date

    // Export Move Date
    public function exportMoveCitizen(Request $request)
    {

        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
        'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
        'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
        )->whereNull('death_date')->whereNotNull('move_date');

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

        // tambahkan baris kode ini di setiap controller
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> data penduduk pindah', //name = nama tag di view (file index)
            'category' => 'Penduduk Pindah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return Excel::download(new CitizenExport($datas,$nik,$kk,$name,$genderSelected,$place_birth,$religionSelected,$address,
        $familyStatusSelected,$bloodSelected,$job,$phone,$vaccine1Selected,$vaccine2Selected,$vaccine3Selected,$rtSelected,
        $rwSelected,$villageSelected,$sub_districsSelected,$districtSelected,$provinceSelected,$health_assuranceSelected,
        $lastEducationSelected), 'Laporan Penduduk Pindah.xls');


    }
    //End Export Move Date

    // View Death Date
    public function deathCitizens(Request $request){
        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
        'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
        'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
        )->whereNotNull('death_date')->paginate(10)->withQueryString();

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
        return view('transactions.citizens.death', compact('datas','nik','kk','name','genderSelected','place_birth','address',
        'religionSelected','familyStatusSelected','bloodSelected','job','phone','vaccine1Selected','vaccine2Selected','vaccine3Selected',
        'rtSelected','rwSelected','villageSelected','sub_districsSelected','provinceSelected','health_assuranceSelected','lastEducationSelected'));
    }
    //End View Death Date

    // Export Death Date
    public function exportDeathCitizen(Request $request)
    {

        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood',
        'job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date',
        'rt','rw','village','sub_districts','districts','province','last_education','health_assurance'])
        )->whereNotNull('death_date');

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

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> data penduduk meninggal',
            'category' => 'Penduduk Meninggal',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return Excel::download(new CitizenExport($datas,$nik,$kk,$name,$genderSelected,$place_birth,$religionSelected,$address,
        $familyStatusSelected,$bloodSelected,$job,$phone,$vaccine1Selected,$vaccine2Selected,$vaccine3Selected,$rtSelected,
        $rwSelected,$villageSelected,$sub_districsSelected,$districtSelected,$provinceSelected,$health_assuranceSelected,
        $lastEducationSelected), 'Laporan Penduduk Meninggal.xls');


    }
    // End Export Death Date

    // Rollback Death Date
    public function rollBackDeathDate(Request $request, $uuid)
    {
        $data = Citizens::get()->where('uuid', $uuid)->whereNotNull('death_date')->firstOrFail();
        $data->update([
            'updated_by' =>Auth::user()->id,
            'death_date' => null,
        ]);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data penduduk dari penduduk meninggal <strong>[' . $data->name . ']</strong>',
            'category' => 'Bantuan Sosial',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/death')->with('success', 'Data meninggal berhasil dihapus!');
    }
    // End Rollback Death Date

    public function importCitizen(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new CitizenImport(), storage_path('app/public/excel/' . $nama_file));


        //remove from server
        Storage::delete($path);

        if ($import) {
            //redirect
            return redirect()->route('citizens.index')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('citizens.index')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function exportCitizen(Request $request)
    {


        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
            ])
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
                $data->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religionSelected))
                $data->where('religion', $religionSelected);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $data->where('family_status', $familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $data->where('blood', $bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $data->where('vaccine_1', $vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $data->where('vaccine_2', $vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $data->where('vaccine_3', $vaccine3Selected);
        }

        if ($request->has('rt')) {
            if (!empty($rtSelected))
                $data->where('rt', $rtSelected);
        }

        if ($request->has('rw')) {
            if (!empty($rwSelected))
                $data->where('rw', $rwSelected);
        }

        if ($request->has('village')) {
            if (!empty($villageSelected))
                $data->where('village', $villageSelected);
        }

        if ($request->has('sub_district')) {
            if (!empty($sub_districsSelected))
                $data->where('sub_district', $sub_districsSelected);
        }

        if ($request->has('district')) {
            if (!empty($districtSelected))
                $data->where('district', $districtSelected);
        }


        if ($request->has('province')) {
            if (!empty($provinceSelected))
                $data->where('province', $provinceSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($health_assuranceSelected))
                $data->where('health_assurance', $health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {
            if (!empty($lastEducationSelected))
                $data->where('lastEducation', $lastEducationSelected);
        }



        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data penduduk', //name = nama tag di view (file index)
            'category' => 'Semua Kependudukan',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return Excel::download(new CitizenExport(
            $datas,
            $nik,
            $kk,
            $name,
            $genderSelected,
            $place_birth,
            $religionSelected,
            $address,
            $familyStatusSelected,
            $bloodSelected,
            $job,
            $phone,
            $vaccine1Selected,
            $vaccine2Selected,
            $vaccine3Selected,
            $rtSelected,
            $rwSelected,
            $villageSelected,
            $sub_districsSelected,
            $districtSelected,
            $provinceSelected,
            $health_assuranceSelected,
            $lastEducationSelected
        ), 'Laporan Penduduk.xls');
    }

    public function citizendtks(Request $request)
    {
        $datas = Citizens::latest()->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance', 'dtks'
            ])
        )->whereNotNull('dtks')->orderBy('id', 'desc')->paginate(10)->withQueryString();

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
                $datas->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religion))
                $datas->where('religion', $religion);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $datas->where('family_status', $familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $datas->where('blood', $bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $datas->where('vaccine_1', $vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $datas->where('vaccine_2', $vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $datas->where('vaccine_3', $vaccine3Selected);
        }


        if ($request->has('rt')) {
            if (!empty($rtSelected))
                $datas->where('rt', $rtSelected);
        }

        if ($request->has('rw')) {
            if (!empty($rwSelected))
                $datas->where('rw', $rwSelected);
        }

        if ($request->has('village')) {
            if (!empty($villageSelected))
                $datas->where('village', $villageSelected);
        }

        if ($request->has('sub_district')) {
            if (!empty($sub_districsSelected))
                $datas->where('sub_district', $sub_districsSelected);
        }

        if ($request->has('district')) {
            if (!empty($districtSelected))
                $datas->where('district', $districtSelected);
        }


        if ($request->has('province')) {
            if (!empty($provinceSelected))
                $datas->where('province', $provinceSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($health_assuranceSelected))
                $datas->where('health_assurance', $health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {
            if (!empty($lastEducationSelected))
                $datas->where('lastEducation', $lastEducationSelected);
        }



        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.dtks', compact(
            'datas',
            'nik',
            'kk',
            'name',
            'genderSelected',
            'place_birth',
            'address',
            'religionSelected',
            'familyStatusSelected',
            'bloodSelected',
            'job',
            'phone',
            'vaccine1Selected',
            'vaccine2Selected',
            'vaccine3Selected',
            'rtSelected',
            'rwSelected',
            'villageSelected',
            'sub_districsSelected',
            'provinceSelected',
            'health_assuranceSelected',
            'lastEducationSelected'
        ));
    }

    public function exportDtksCitizen(Request $request)
    {


        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
            ])
        )->where('dtks', '=', 'y')
            ->orderBy('id', 'desc');

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
                $data->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religionSelected))
                $data->where('religion', $religionSelected);
        }

        if ($request->has('family_status')) {
            if (!empty($familyStatusSelected))
                $data->where('family_status', $familyStatusSelected);
        }

        if ($request->has('blood')) {
            if (!empty($bloodSelected))
                $data->where('blood', $bloodSelected);
        }

        if ($request->has('vaccine_1')) {
            if (!empty($vaccine1Selected))
                $data->where('vaccine_1', $vaccine1Selected);
        }

        if ($request->has('vaccine_2')) {
            if (!empty($vaccine2Selected))
                $data->where('vaccine_2', $vaccine2Selected);
        }

        if ($request->has('vaccine_3')) {
            if (!empty($vaccine3Selected))
                $data->where('vaccine_3', $vaccine3Selected);
        }

        if ($request->has('rt')) {
            if (!empty($rtSelected))
                $data->where('rt', $rtSelected);
        }

        if ($request->has('rw')) {
            if (!empty($rwSelected))
                $data->where('rw', $rwSelected);
        }

        if ($request->has('village')) {
            if (!empty($villageSelected))
                $data->where('village', $villageSelected);
        }

        if ($request->has('sub_district')) {
            if (!empty($sub_districsSelected))
                $data->where('sub_district', $sub_districsSelected);
        }

        if ($request->has('district')) {
            if (!empty($districtSelected))
                $data->where('district', $districtSelected);
        }


        if ($request->has('province')) {
            if (!empty($provinceSelected))
                $data->where('province', $provinceSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($health_assuranceSelected))
                $data->where('health_assurance', $health_assuranceSelected);
        }

        if ($request->has('lastEducation')) {
            if (!empty($lastEducationSelected))
                $data->where('lastEducation', $lastEducationSelected);
        }



        $datas = $data->get();



        return Excel::download(new CitizenExport(
            $datas,
            $nik,
            $kk,
            $name,
            $genderSelected,
            $place_birth,
            $religionSelected,
            $address,
            $familyStatusSelected,
            $bloodSelected,
            $job,
            $phone,
            $vaccine1Selected,
            $vaccine2Selected,
            $vaccine3Selected,
            $rtSelected,
            $rwSelected,
            $villageSelected,
            $sub_districsSelected,
            $districtSelected,
            $provinceSelected,
            $health_assuranceSelected,
            $lastEducationSelected
        ), 'Laporan Penduduk DTKS.xls');
    }

    public function rollBackDtks(Request $request, $uuid)
    {

        $data = Citizens::get()->where('uuid', $uuid)->where('dtks', 'y')->firstOrFail();

        $data->update([
            'updated_by' =>Auth::user()->id,
            'dtks' => 't    ',
        ]);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data dari penduduk DTKS <strong>[' . $data->name . ']</strong>',
            'category' => 'Penduduk DTKS',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/citizendtks')->with('success', 'Data berhasil dihapus dari data DTKS!');
    }
}

