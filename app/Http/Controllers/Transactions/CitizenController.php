<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Http\Controllers\Transactions;

use Ramsey\Uuid\Uuid;

use App\Models\Masters\RT;
use App\Models\Masters\RW;
//panggil uuid library
use App\Models\Masters\Information;

//definisikan model
use Illuminate\Http\Request;

//use export class
use App\Exports\CitizenExport;
use App\Exports\CitizenDTKSExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//external model goes heree
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Transactions\Citizens;
use Illuminate\Support\Facades\Storage;

//use import class dan storage nya utk simpan data
use App\Imports\CitizenImport;
use App\Models\Transactions\Children;
use Carbon\Carbon;

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


            $datas = Citizens::latest()->filter(
                request([
                    'name', 'nik', 'kk', 'gender', 'date_birth','date_birth2','address', 'place_birth', 'religion', 'family_status', 'blood',
                    'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date','newcomer',
                    'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','disability'
                ])
            )->whereNull('death_date')->whereNull('move_date')->paginate(20)->withQueryString();




        $informations = Information::get();

        $disabilitys = Citizens::groupBy('disability')->get();
        $disabilitySelected =  $request->get('disability');

        $place_births = Citizens::groupBy('place_birth')->get();
        $place_birthSelected =  $request->get('place_birth');

        $jobs = Citizens::groupBy('job')->get();
        $jobSelected =  $request->get('job');

        $family_statuses = Citizens::groupBy('family_status')->get();
        $family_statusSelected =  $request->get('family_status');

        $marriages = Citizens::groupBy('marriage')->get();
        $marriageSelected =  $request->get('marriage');

        $religions = Citizens::groupBy('religion')->get();
        $religionSelected =  $request->get('religion');

        $last_educations = Citizens::groupBy('last_education')->get();
        $last_educationSelected = $request->get('last_education');

        $health_assurances = Citizens::groupBy('health_assurance')->get();
        $healthAssurancesSelected =  $request->get('health_assurance');

        $dtkses = Citizens::groupBy('dtks')->get();
        $dtksSelected =  $request->get('dtks');

        $vaccine1s = Citizens::groupBy('vaccine_1')->get();
        $vaccine1Selected =  $request->get('vaccine_1');

        $vaccine2s = Citizens::groupBy('vaccine_2')->get();
        $vaccine2Selected =  $request->get('vaccine_2');

        $vaccine3s = Citizens::groupBy('vaccine_3')->get();
        $vaccine3Selected =  $request->get('vaccine_3');

        $rts = Citizens::groupBy('rt')->get();
        $rtSelected =  $request->get('rt');

        $rws = Citizens::groupBy('rw')->get();
        $rwSelected =  $request->get('rw');

        $villages = Citizens::groupBy('village')->get();
        $villagesSelected =  $request->get('village');

        $sub_districtses = Citizens::groupBy('sub_districts')->get();
        $sub_districtSelected =  $request->get('sub_districts');

        $districtses = Citizens::groupBy('districts')->get();
        $districtsSelected =  $request->get('districts');

        $provinces = Citizens::groupBy('province')->get();
        $provincesSelected =  $request->get('province');
        //add for searching end

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $date_birth =  $request->get('date_birth');
        $date_birth2 =  $request->get('date_birth2');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $newcomer =  $request->get('newcomer');
        $familyStatusSelected =  $request->get('family_status');
        $bloodSelected =  $request->get('blood');
        $job =  $request->get('job');
        $phone =  $request->get('phone');
        $rtSelected =  $request->get('rt');
        $rwSelected =  $request->get('rw');
        $villageSelected =  $request->get('village');
        $sub_districsSelected =  $request->get('sub_district');
        $districtSelected =  $request->get('district');
        $provinceSelected =  $request->get('province');

        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $datas->where('gender', $genderSelected);
        }

        if ($request->has('newcomer')) {
            if (!empty($newcomer))
                $datas->where('newcomer', $newcomer);
        }

        if ($request->has('job')) {
            if (!empty($jobs))
                $datas->where('job', $jobs);
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
            if (!empty($healthAssurancesSelected))
                $datas->where('health_assurance', $healthAssurancesSelected);
        }

        if ($request->has('last_education')) {
            if (!empty($lastEducationSelected))
                $datas->where('last_education', $lastEducationSelected);
        }

        if ($request->has('disability')) {
            if (!empty($disabilitySelected))
                $datas->where('disability', $disabilitySelected);
        }




        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.index', compact(
            'datas',
            'nik',
            'kk',
            'name',
            'genderSelected',
            'date_birth',
            'date_birth2',
            'disabilitySelected',
            'disabilitys',
            'place_birth',
            'address',
            'newcomer',
            'religionSelected',
            'familyStatusSelected',
            'bloodSelected',
            'job',
            'phone',
            'villageSelected',
            'sub_districsSelected',
            'provinceSelected',
            //new add
            'marriages',
            'marriageSelected',
            'family_statuses',
            'family_statusSelected',
            'place_births',
            'place_birthSelected',
            'jobs',
            'jobSelected',
            'religions',
            'last_educations',
            'last_educationSelected',
            'health_assurances',
            'healthAssurancesSelected',
            'vaccine1s',
            'vaccine1Selected',
            'vaccine2s',
            'vaccine2Selected',
            'vaccine3s',
            'vaccine3Selected',
            'dtkses',
            'dtksSelected',
            'rts',
            'rtSelected',
            'rws',
            'rwSelected',
            'villages',
            'sub_districtses',
            'sub_districtSelected',
            'districtses',
            'districtsSelected',
            'provinces',
            'provincesSelected',
            'informations'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rws = RW::get();
        $rwSelected =  $request->get('rw');

        $rts = RT::get();
        $rtSelected =  $request->get('rt');

        $village = Information::get();
        $villageSelected =  $request->get('village_name');

        $districtses = Information::get();
        $districtsSelected =  $request->get('district_name');

        $sub_districtses = Information::get();
        $sub_districtSelected =  $request->get('sub_district_name');

        $provinces = Information::get();
        $provinceSelected =  $request->get('province_name');

        return view('transactions.citizens.form', [
            'page' => 'create',
        ],compact('rws','rwSelected','rts','rtSelected',
        'village','villageSelected','districtses','districtsSelected','sub_districtses','sub_districtSelected',
        'provinces','provinceSelected'));
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
            'job' => 'nullable',
            'phone' => 'nullable',
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
            'newcomer' => 'nullable',
            'in_date' => 'nullable',
            'dtks'=> 'required',
            'last_education' => 'nullable',
            'health_assurance' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'disability' => 'required',
        ]);

        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['uuid'] = Uuid::uuid4()->getHex();

        Citizens::create($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data penduduk baru <strong>[' . $request->name . ']</strong>',
            'category' => 'tambah',
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
    public function show($uuid)
    {
        $citizen = Citizens::where('uuid', $uuid)->get();
        return view('transactions.citizens.show', compact('citizen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid,Request $request)
    {

        $rws = RW::get();
        $rwSelected =  $request->get('rw');

        $rts = RT::get();
        $rtSelected =  $request->get('rt');

        $village = Information::get();
        $villageSelected =  $request->get('village_name');

        $districtses = Information::get();
        $districtsSelected =  $request->get('district_name');

        $sub_districtses = Information::get();
        $sub_districtSelected =  $request->get('sub_district_name');

        $provinces = Information::get();
        $provinceSelected =  $request->get('province_name');

        // $family_statuses = Citizens::get();
        // $family_statusSelected =  $request->get('family_status');

        $citizen = Citizens::where('uuid', $uuid)->get();

        return view('transactions.citizens.edit', compact('citizen','rws','rwSelected','rts','rtSelected',
    'village','villageSelected','districtses','districtsSelected','sub_districtses','sub_districtSelected',
    'provinces','provinceSelected'));


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
        if ($request->get('death_date')) {
            $deathData = $request->validate([
                'death_date' => 'date|required'
            ]);
            $deathData['updated_by'] = Auth::user()->id;
            $uuidValidated = $request->input('uuidValidate');
            Citizens::where('uuid', $uuidValidated)->update($deathData);
            // dd(Citizens::where('uuid', $uuid)->get());

            $citizenName = Citizens::where('uuid', $uuidValidated)->firstOrFail();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> penduduk <strong>[' . $citizenName->name . ']</strong> menjadi penduduk meninggal',
                'category' => 'edit',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);

            return redirect('/citizens')->with('success', 'Data berhasil diperbarui!');
        }

        if ($request->get('move_date') && $request->get('move_to')) {
            $moveData = $request->validate([
                'move_date' => 'date|required',
                'move_to' => 'max:255|required'
            ]);
            $moveData['updated_by'] = Auth::user()->id;
            $uuidValidated = $request->input('uuidValidate');
            Citizens::where('uuid', $uuidValidated)->update($moveData);
            // dd(Citizens::where('uuid', $uuid)->get());

            $citizenName = Citizens::where('uuid', $uuidValidated)->firstOrFail();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> penduduk <strong>[' . $citizenName->name . ']</strong> menjadi penduduk pindah',
                'category' => 'edit',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);

            return redirect('/citizens')->with('success', 'Data berhasil diperbarui!');
        }

        $validatedData = $request->validate([
            'nik' => 'numeric|min:16',
            'kk' => 'numeric|min:16',
            'name' => 'required|max:255',
            'date_birth' => 'required|date',
            'place_birth' => 'required',
            'religion' => 'nullable',
            'job' => 'nullable',
            'phone' => 'nullable',
            'marriage' => 'nullable',
            'move_date' => 'date|nullable',
            'death_date' => 'date|nullable',
            'gender' => 'nullable',
            'family_status' => 'nullable',
            'blood' => 'nullable',
            'vaccine_1' => 'nullable',
            'vaccine_2' => 'nullable',
            'vaccine_3' => 'nullable',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'village' => 'nullable',
            'sub_districts' => 'nullable',
            'districts' => 'nullable',
            'province' => 'nullable',
            'address' => 'nullable',
            'newcomer' => 'nullable',
            'in_date' => 'nullable',
            'dtks'=> 'nullable',
            'disability'=> 'nullable',
            'last_education' => 'nullable',
            'move_to' => 'nullable',
            'health_assurance' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
        ]);

        if ($validatedData) {
            $validatedData['updated_by'] = Auth::user()->id;
            Citizens::where('uuid', $uuid)->first()->update($validatedData);
        }

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data penduduk <strong>[' . $request->name . ']</strong>',
            'category' => 'edit',
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
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('citizens.index')->with('success', 'Data berhasil dihapus!');
    }

        // ---------------------FAMILY AREA ------------------

        public function showKK($uuid)
        {

            $citizen = Citizens::where('uuid', $uuid)->get();

            $data = Citizens::where('uuid', '=', $uuid)->first();
            $families = Citizens::where('kk','=',$data->kk)->orderBy('family_status','desc')->get();
            // $families = Citizens::where('kk',$data->kk)->orderBy('family_status','desc')->get();

            return view('transactions.citizens.show', compact('citizen','families','data'));
        }

        public function showKKActive($uuid)
        {

            $citizen = Citizens::where('uuid', $uuid)->whereNull('death_date')->whereNull('move_date')->get();

            $data = Citizens::where('uuid', '=', $uuid)->first();
            $families = Citizens::where('kk','=',$data->kk)->orderBy('family_status','desc')->whereNull('death_date')->whereNull('move_date')->get();
            // $families = Citizens::where('kk',$data->kk)->orderBy('family_status','desc')->get();

            return view('transactions.citizens.show', compact('citizen','families','data'));
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

         // ---------------------FAMILY AREA END ------------------


    // ---------------------MOVE AREA ------------------
    // View Move Date
    public function moveCitizens(Request $request)
    {

        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->whereNull('death_date')->whereNotNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'date_birth2', 'address', 'place_birth', 'religion', 'family_status', 'blood', 'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks','disability'
            ]))->paginate(20)->withQueryString();




        $informations = Information::get();

        $disabilitys = Citizens::groupBy('disability')->get();
        $disabilitySelected =  $request->get('disability');

        $place_births = Citizens::groupBy('place_birth')->get();
        $place_birthSelected =  $request->get('place_birth');

        $jobs = Citizens::groupBy('job')->get();
        $jobSelected =  $request->get('job');

        $family_statuses = Citizens::groupBy('family_status')->get();
        $family_statusSelected =  $request->get('family_status');

        $marriages = Citizens::groupBy('marriage')->get();
        $marriageSelected =  $request->get('marriage');

        $religions = Citizens::groupBy('religion')->get();
        $religionSelected =  $request->get('religion');

        $last_educations = Citizens::groupBy('last_education')->get();
        $last_educationSelected = $request->get('last_education');

        $health_assurances = Citizens::groupBy('health_assurance')->get();
        $healthAssurancesSelected =  $request->get('health_assurance');

        $dtkses = Citizens::groupBy('dtks')->get();
        $dtksSelected =  $request->get('dtks');

        $vaccine1s = Citizens::groupBy('vaccine_1')->get();
        $vaccine1Selected =  $request->get('vaccine_1');

        $vaccine2s = Citizens::groupBy('vaccine_2')->get();
        $vaccine2Selected =  $request->get('vaccine_2');

        $vaccine3s = Citizens::groupBy('vaccine_3')->get();
        $vaccine3Selected =  $request->get('vaccine_3');

        $rts = Citizens::groupBy('rt')->get();
        $rtSelected =  $request->get('rt');

        $rws = Citizens::groupBy('rw')->get();
        $rwSelected =  $request->get('rw');

        $villages = Citizens::groupBy('village')->get();
        $villagesSelected =  $request->get('village');

        $sub_districtses = Citizens::groupBy('sub_districts')->get();
        $sub_districtSelected =  $request->get('sub_districts');

        $districtses = Citizens::groupBy('districts')->get();
        $districtsSelected =  $request->get('districts');

        $provinces = Citizens::groupBy('province')->get();
        $provincesSelected =  $request->get('province');
        //add for searching end

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $date_birth =  $request->get('date_birth');
        $date_birth2 =  $request->get('date_birth2');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $familyStatusSelected =  $request->get('family_status');
        $bloodSelected =  $request->get('blood');
        $job =  $request->get('job');
        $phone =  $request->get('phone');
        $rtSelected =  $request->get('rt');
        $rwSelected =  $request->get('rw');
        $villageSelected =  $request->get('village');
        $sub_districsSelected =  $request->get('sub_district');
        $districtSelected =  $request->get('district');
        $provinceSelected =  $request->get('province');

        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $datas->where('gender', $genderSelected);
        }

        if ($request->has('job')) {
            if (!empty($jobs))
                $datas->where('job', $jobs);
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
            if (!empty($healthAssurancesSelected))
                $datas->where('health_assurance', $healthAssurancesSelected);
        }

        if ($request->has('last_education')) {
            if (!empty($lastEducationSelected))
                $datas->where('last_education', $lastEducationSelected);
        }

        if ($request->has('disability')) {
            if (!empty($disabilitySelected))
                $datas->where('disability', $disabilitySelected);
        }




        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.move', compact(
            'datas',
            'nik',
            'kk',
            'name',
            'genderSelected',
            'date_birth',
            'date_birth2',
            'disabilitySelected',
            'disabilitys',
            'place_birth',
            'address',
            'religionSelected',
            'familyStatusSelected',
            'bloodSelected',
            'job',
            'phone',
            'villageSelected',
            'sub_districsSelected',
            'provinceSelected',
            //new add
            'marriages',
            'marriageSelected',
            'family_statuses',
            'family_statusSelected',
            'place_births',
            'place_birthSelected',
            'jobs',
            'jobSelected',
            'religions',
            'last_educations',
            'last_educationSelected',
            'health_assurances',
            'healthAssurancesSelected',
            'vaccine1s',
            'vaccine1Selected',
            'vaccine2s',
            'vaccine2Selected',
            'vaccine3s',
            'vaccine3Selected',
            'dtkses',
            'dtksSelected',
            'rts',
            'rtSelected',
            'rws',
            'rwSelected',
            'villages',
            'sub_districtses',
            'sub_districtSelected',
            'districtses',
            'districtsSelected',
            'provinces',
            'provincesSelected',
            'informations'
        ));
    }
    //End View Move Date

    //move Update
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
            'description' => '<em>Mengubah</em> data penduduk pindah <strong>[' . $request->name . ']</strong>',
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/move')->with('success', 'Data berhasil diperbarui!');
    }
    //End move Update

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
            'category' => 'hapus',
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
        $data = Citizens::latest()->whereNull('death_date')->whereNotNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'date_birth2', 'address', 'place_birth', 'religion', 'family_status', 'blood', 'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks','disability'
        ]));

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $date_birth =  $request->get('date_birth');
        $date_birth2 =  $request->get('date_birth2');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $religionSelected =  $request->get('religion');
        $familyStatusSelected =  $request->get('family_status');
        $healthAssurancesSelected =  $request->get('health_assurance');
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


        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $data->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religionSelected))
                $data->where('religion', $religionSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($healthAssurancesSelected))
                $data->where('health_assurance', $healthAssurancesSelected);
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



        // $data = Citizens::orderBy('kk', 'desc');
        $data->orderBy('kk', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Ekspor</em> data penduduk pindah', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);


        return Excel::download(new CitizenExport(
            $datas,
            $nik,
            $kk,
            $name,
            $genderSelected,
            $date_birth,
            $date_birth2,
            $place_birth,
            $religionSelected,
            $address,
            $familyStatusSelected,
            $healthAssurancesSelected,
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

        ), 'Laporan Penduduk Pindah.xls');
    }
    //End Export Move Date
    // ---------------------MOVE AREA END ------------------

     // ---------------------DEATH AREA ------------------
    // View Death Date
    public function deathCitizens(Request $request){
        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->whereNotNull('death_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth','date_birth2', 'address', 'place_birth', 'religion', 'family_status', 'blood',
                'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks'
            ])
        )->paginate(20)->withQueryString();

        $informations = Information::get();

        $disabilitys = Citizens::groupBy('disability')->get();
        $disabilitySelected =  $request->get('disability');

        $place_births = Citizens::groupBy('place_birth')->get();
        $place_birthSelected =  $request->get('place_birth');

        $jobs = Citizens::groupBy('job')->get();
        $jobSelected =  $request->get('job');

        $family_statuses = Citizens::groupBy('family_status')->get();
        $family_statusSelected =  $request->get('family_status');

        $marriages = Citizens::groupBy('marriage')->get();
        $marriageSelected =  $request->get('marriage');

        $religions = Citizens::groupBy('religion')->get();
        $religionSelected =  $request->get('religion');

        $last_educations = Citizens::groupBy('last_education')->get();
        $last_educationSelected = $request->get('last_education');

        $health_assurances = Citizens::groupBy('health_assurance')->get();
        $healthAssurancesSelected =  $request->get('health_assurance');

        $dtkses = Citizens::groupBy('dtks')->get();
        $dtksSelected =  $request->get('dtks');

        $vaccine1s = Citizens::groupBy('vaccine_1')->get();
        $vaccine1Selected =  $request->get('vaccine_1');

        $vaccine2s = Citizens::groupBy('vaccine_2')->get();
        $vaccine2Selected =  $request->get('vaccine_2');

        $vaccine3s = Citizens::groupBy('vaccine_3')->get();
        $vaccine3Selected =  $request->get('vaccine_3');

        $rts = Citizens::groupBy('rt')->get();
        $rtSelected =  $request->get('rt');

        $rws = Citizens::groupBy('rw')->get();
        $rwSelected =  $request->get('rw');

        $villages = Citizens::groupBy('village')->get();
        $villagesSelected =  $request->get('village');

        $sub_districtses = Citizens::groupBy('sub_districts')->get();
        $sub_districtSelected =  $request->get('sub_districts');

        $districtses = Citizens::groupBy('districts')->get();
        $districtsSelected =  $request->get('districts');

        $provinces = Citizens::groupBy('province')->get();
        $provincesSelected =  $request->get('province');
        //add for searching end

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $date_birth =  $request->get('date_birth');
        $date_birth2 =  $request->get('date_birth2');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $familyStatusSelected =  $request->get('family_status');
        $bloodSelected =  $request->get('blood');
        $job =  $request->get('job');
        $phone =  $request->get('phone');
        $rtSelected =  $request->get('rt');
        $rwSelected =  $request->get('rw');
        $villageSelected =  $request->get('village');
        $sub_districsSelected =  $request->get('sub_district');
        $districtSelected =  $request->get('district');
        $provinceSelected =  $request->get('province');

        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $datas->where('gender', $genderSelected);
        }

        if ($request->has('job')) {
            if (!empty($jobs))
                $datas->where('job', $jobs);
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
            if (!empty($healthAssurancesSelected))
                $datas->where('health_assurance', $healthAssurancesSelected);
        }

        if ($request->has('last_education')) {
            if (!empty($lastEducationSelected))
                $datas->where('last_education', $lastEducationSelected);
        }

        if ($request->has('disability')) {
            if (!empty($disabilitySelected))
                $datas->where('disability', $disabilitySelected);
        }

        //render view dengan variable yang ada menggunakan 'compact', method bawaan php
        return view('transactions.citizens.death', compact(
            'datas',
            'nik',
            'kk',
            'name',
            'genderSelected',
            'place_birth',
            'disabilitySelected',
            'disabilitys',
            'date_birth',
            'date_birth2',
            'address',
            'religionSelected',
            'familyStatusSelected',
            'bloodSelected',
            'job',
            'phone',
            'villageSelected',
            'sub_districsSelected',
            'provinceSelected',
            //new add
            'marriages',
            'marriageSelected',
            'family_statuses',
            'family_statusSelected',
            'place_births',
            'place_birthSelected',
            'jobs',
            'jobSelected',
            'religions',
            'last_educations',
            'last_educationSelected',
            'health_assurances',
            'healthAssurancesSelected',
            'vaccine1s',
            'vaccine1Selected',
            'vaccine2s',
            'vaccine2Selected',
            'vaccine3s',
            'vaccine3Selected',
            'dtkses',
            'dtksSelected',
            'rts',
            'rtSelected',
            'rws',
            'rwSelected',
            'villages',
            'sub_districtses',
            'sub_districtSelected',
            'districtses',
            'districtsSelected',
            'provinces',
            'provincesSelected',
            'informations'
        ));
    }
    //End View Death Date

    // Export Death Date
    public function exportDeathCitizen(Request $request)
    {

        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->filter(request(['name','nik','kk','gender','date_birth','address','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date', 'rt','rw','village','sub_districts','districts','province','last_education','health_assurance','disability'])
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

        $data->orderBy('kk', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> data penduduk meninggal',
            'category' => 'ekspor',
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
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/death')->with('success', 'Data meninggal berhasil dihapus!');
    }
    // End Rollback Death Date
    // ---------------------DEATH AREA END ------------------


    // ---------------------DTKS AREA ------------------
    public function citizendtks(Request $request)
    {
        // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $datas = Citizens::latest()->whereNull('death_date')->whereNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'date_birth2', 'address', 'place_birth', 'religion', 'family_status', 'blood', 'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks','disability'
            ]))->whereNot('dtks','=','')->orderBy('id', 'desc')->paginate(10)->withQueryString();


            $informations = Information::get();

            $disabilitys = Citizens::groupBy('disability')->get();
            $disabilitySelected =  $request->get('disability');

            $place_births = Citizens::groupBy('place_birth')->get();
            $place_birthSelected =  $request->get('place_birth');

            $jobs = Citizens::groupBy('job')->get();
            $jobSelected =  $request->get('job');

            $family_statuses = Citizens::groupBy('family_status')->get();
            $family_statusSelected =  $request->get('family_status');

            $marriages = Citizens::groupBy('marriage')->get();
            $marriageSelected =  $request->get('marriage');

            $religions = Citizens::groupBy('religion')->get();
            $religionSelected =  $request->get('religion');

            $last_educations = Citizens::groupBy('last_education')->get();
            $last_educationSelected = $request->get('last_education');

            $health_assurances = Citizens::groupBy('health_assurance')->get();
            $healthAssurancesSelected =  $request->get('health_assurance');

            $dtkses = Citizens::groupBy('dtks')->get();
            $dtksSelected =  $request->get('dtks');

            $vaccine1s = Citizens::groupBy('vaccine_1')->get();
            $vaccine1Selected =  $request->get('vaccine_1');

            $vaccine2s = Citizens::groupBy('vaccine_2')->get();
            $vaccine2Selected =  $request->get('vaccine_2');

            $vaccine3s = Citizens::groupBy('vaccine_3')->get();
            $vaccine3Selected =  $request->get('vaccine_3');

            $rts = Citizens::groupBy('rt')->get();
            $rtSelected =  $request->get('rt');

            $rws = Citizens::groupBy('rw')->get();
            $rwSelected =  $request->get('rw');

            $villages = Citizens::groupBy('village')->get();
            $villagesSelected =  $request->get('village');

            $sub_districtses = Citizens::groupBy('sub_districts')->get();
            $sub_districtSelected =  $request->get('sub_districts');

            $districtses = Citizens::groupBy('districts')->get();
            $districtsSelected =  $request->get('districts');

            $provinces = Citizens::groupBy('province')->get();
            $provincesSelected =  $request->get('province');
            //add for searching end

            $nik =  $request->get('nik');
            $kk =  $request->get('kk');
            $name =  $request->get('name');
            $genderSelected =  $request->get('gender');
            $date_birth =  $request->get('date_birth');
            $date_birth2 =  $request->get('date_birth2');
            $place_birth =  $request->get('place_birth');
            $address =  $request->get('address');
            $familyStatusSelected =  $request->get('family_status');
            $bloodSelected =  $request->get('blood');
            $job =  $request->get('job');
            $phone =  $request->get('phone');
            $rtSelected =  $request->get('rt');
            $rwSelected =  $request->get('rw');
            $villageSelected =  $request->get('village');
            $sub_districsSelected =  $request->get('sub_district');
            $districtSelected =  $request->get('district');
            $provinceSelected =  $request->get('province');

            if ($request->has('gender')) {
                if (!empty($genderSelected))
                    $datas->where('gender', $genderSelected);
            }

            if ($request->has('job')) {
                if (!empty($jobs))
                    $datas->where('job', $jobs);
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
                if (!empty($healthAssurancesSelected))
                    $datas->where('health_assurance', $healthAssurancesSelected);
            }

            if ($request->has('last_education')) {
                if (!empty($lastEducationSelected))
                    $datas->where('last_education', $lastEducationSelected);
            }

            if ($request->has('disability')) {
                if (!empty($disabilitySelected))
                    $datas->where('disability', $disabilitySelected);
            }




            //render view dengan variable yang ada menggunakan 'compact', method bawaan php
            return view('transactions.citizens.dtks', compact(
                'datas',
                'nik',
                'kk',
                'name',
                'genderSelected',
                'date_birth',
                'date_birth2',
                'disabilitySelected',
                'disabilitys',
                'place_birth',
                'address',
                'religionSelected',
                'familyStatusSelected',
                'bloodSelected',
                'job',
                'phone',
                'villageSelected',
                'sub_districsSelected',
                'provinceSelected',
                //new add
                'marriages',
                'marriageSelected',
                'family_statuses',
                'family_statusSelected',
                'place_births',
                'place_birthSelected',
                'jobs',
                'jobSelected',
                'religions',
                'last_educations',
                'last_educationSelected',
                'health_assurances',
                'healthAssurancesSelected',
                'vaccine1s',
                'vaccine1Selected',
                'vaccine2s',
                'vaccine2Selected',
                'vaccine3s',
                'vaccine3Selected',
                'dtkses',
                'dtksSelected',
                'rts',
                'rtSelected',
                'rws',
                'rwSelected',
                'villages',
                'sub_districtses',
                'sub_districtSelected',
                'districtses',
                'districtsSelected',
                'provinces',
                'provincesSelected',
                'informations'
            ));

    }

    public function exportDtksCitizen(Request $request)
    {


        // // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        // $data = Citizens::latest()->filter(
        //     request([
        //         'name', 'nik', 'kk', 'gender', 'date_birth', 'address', 'place_birth', 'religion', 'family_status', 'blood',
        //         'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
        //         'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance'
        //     ])
        // )->whereNot('dtks','=','')
        //     ->orderBy('id', 'desc');

        $data = Citizens::latest()->whereNull('death_date')->whereNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'date_birth2', 'address', 'place_birth', 'religion', 'family_status', 'blood', 'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks','disability'
            ])
            )->whereNot('dtks','=','')
                ->orderBy('id');

                $nik =  $request->get('nik');
                $kk =  $request->get('kk');
                $name =  $request->get('name');
                $genderSelected =  $request->get('gender');
                $date_birth =  $request->get('date_birth');
                $date_birth2 =  $request->get('date_birth2');
                $place_birth =  $request->get('place_birth');
                $address =  $request->get('address');
                $religionSelected =  $request->get('religion');
                $familyStatusSelected =  $request->get('family_status');
                $healthAssurancesSelected =  $request->get('health_assurance');
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


                if ($request->has('gender')) {
                    if (!empty($genderSelected))
                        $data->where('gender', $genderSelected);
                }

                if ($request->has('religion')) {
                    if (!empty($religionSelected))
                        $data->where('religion', $religionSelected);
                }

                if ($request->has('health_assurance')) {
                    if (!empty($healthAssurancesSelected))
                        $data->where('health_assurance', $healthAssurancesSelected);
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



                // $data = Citizens::orderBy('kk', 'desc');
                $data->orderBy('kk', 'desc');

                $datas = $data->get();

                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Export</em> data DTKS', //name = nama tag di view (file index)
                    'category' => 'ekspor',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);


                return Excel::download(new CitizenExport(
                    $datas,
                    $nik,
                    $kk,
                    $name,
                    $genderSelected,
                    $date_birth,
                    $date_birth2,
                    $place_birth,
                    $religionSelected,
                    $address,
                    $familyStatusSelected,
                    $healthAssurancesSelected,
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
                    $dtks,
                    $provinceSelected,

                ), 'Laporan Penduduk DTKS.xls');
            }

    public function rollBackDtks(Request $request, $uuid)
    {

        $data = Citizens::get()->where('uuid', $uuid)->whereNotIn('dtks','=','')->firstOrFail();

        $data->update([
            'updated_by' =>Auth::user()->id,
            'dtks' => null,
        ]);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data dari penduduk DTKS <strong>[' . $data->name . ']</strong>',
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/dtks')->with('success', 'Data berhasil dihapus dari data DTKS!');
    }
    // ---------------------DTKS AREA END ------------------


    //IMPORT GOES HERE
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
        // $import = Excel::import(new CitizenImport(), storage_path('app/public/excel/' . $nama_file));
        $import = Excel::import(new CitizenImport, request()->file('file'));

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

    //EXPORT GOES HERE
    public function exportCitizen(Request $request)
    {

                // ,'nik','kk','gender','date_birth','place_birth','religion','family_status','blood','job','phone','marriage','vaccine_1','vaccine_2','vaccine_3','move_date','death_date','rt','rw','village','sub_districts','districts','province'
        $data = Citizens::latest()->whereNull('death_date')->whereNull('move_date')->filter(
            request([
                'name', 'nik', 'kk', 'gender', 'date_birth', 'date_birth2', 'address','newcomer','place_birth', 'religion', 'family_status', 'blood', 'job', 'phone', 'marriage', 'vaccine_1', 'vaccine_2', 'vaccine_3', 'move_date', 'death_date',
                'rt', 'rw', 'village', 'sub_districts', 'districts', 'province', 'last_education', 'health_assurance','dtks','disability'
            ]));

        $nik =  $request->get('nik');
        $kk =  $request->get('kk');
        $name =  $request->get('name');
        $genderSelected =  $request->get('gender');
        $date_birth =  $request->get('date_birth');
        $date_birth2 =  $request->get('date_birth2');
        $place_birth =  $request->get('place_birth');
        $address =  $request->get('address');
        $newcomer =  $request->get('newcomer');
        $religionSelected =  $request->get('religion');
        $familyStatusSelected =  $request->get('family_status');
        $healthAssurancesSelected =  $request->get('health_assurance');
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


        if ($request->has('gender')) {
            if (!empty($genderSelected))
                $data->where('gender', $genderSelected);
        }

        if ($request->has('religion')) {
            if (!empty($religionSelected))
                $data->where('religion', $religionSelected);
        }

        if ($request->has('health_assurance')) {
            if (!empty($healthAssurancesSelected))
                $data->where('health_assurance', $healthAssurancesSelected);
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



        // $data = Citizens::orderBy('kk', 'desc');
        $data->orderBy('kk', 'desc');

        $datas = $data->get();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> semua data penduduk', //name = nama tag di view (file index)
            'category' => 'ekspor',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);


        return Excel::download(new CitizenExport(
            $datas,
            $nik,
            $kk,
            $name,
            $genderSelected,
            $date_birth,
            $date_birth2,
            $place_birth,
            $religionSelected,
            $address,
            $newcomer,
            $familyStatusSelected,
            $healthAssurancesSelected,
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

        ), 'Laporan Penduduk.xls');
    }

    // Index Data Anak
    public function indexHealthCare() {
        $now = date('Y-m-d');
        $datas = Citizens::latest()->whereRaw('timestampdiff(year, date_birth, now()) < 5')->with(['children'])->paginate(20)->withQueryString();
        return view('transactions.children.healthcare', compact('datas'));
    }

    // Edit Data Anak
    public function editHealthCare($uuid) {
        $datas = Citizens::where('uuid', $uuid)->with('children')->get();
        return view('transactions.children.edit', compact('datas'));
    }

    // Store Health Care
    public function storeHealthCare(Request $request, $uuid) {
        // dd(Citizens::where('nik', $request->nik)->value('id'));
        $request->validate([
            'name' => 'required',
            'parentName' => 'required',
            'weight' => 'numeric|required',
            'height' => 'numeric|required',
            'gender' => 'required',
            'num_of_child' => 'numeric|required',
            'nik' => 'required',
            'date_birth' => 'date|required',
            'bpjs' => 'required',
            'kms' => 'required',
        ]);

        $childrenData = [
            'citizens_id' => Citizens::where('nik', $request->nik)->value('id'),
            'height' => $request->height,
            'weight' => $request->weight,
            'num_of_child' => $request->num_of_child,
            'kms' => $request->kms,
            'created_by' => Auth::user()->id,
            'uuid' => $uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('childrens')->insert($childrenData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data anak <strong>[' . $request->name . ']</strong>',
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/health-care')->with('success', 'Data anak berhasil diubah!');
    }

    // Update Health Care
    public function updateHealthCare(Request $request, $uuid) {

        // dd(DB::table('childrens')->get());
        $request->validate([
            'name' => 'required',
            'parentName' => 'required',
            'weight' => 'numeric|required',
            'height' => 'numeric|required',
            'gender' => 'required',
            'num_of_child' => 'numeric|required',
            'nik' => 'required',
            'date_birth' => 'date|required',
            'bpjs' => 'required',
            'kms' => 'required',
        ]);

        $childrenData = [
            'height' => $request->height,
            'weight' => $request->weight,
            'num_of_child' => $request->num_of_child,
            'kms' => $request->kms,
            'updated_at' => now(),
        ];

        Children::where('uuid', $uuid)->update($childrenData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data anak <strong>[' . $request->name . ']</strong>',
            'category' => 'tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return redirect('/health-care')->with('success', 'Data anak berhasil diubah!');
    }

}

