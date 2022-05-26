<?php
namespace App\Http\Controllers\Transactions\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//panggil auth
use Illuminate\Support\Facades\Auth;

//panggilramseyuuid
use Ramsey\Uuid\Uuid;
//calldb
use Illuminate\Support\Facades\DB;

//callmodel
use App\Models\Transactions\Citizens;
use App\Models\Transactions\Letter\LetterMarriage;

use App\Models\Masters\Information;
use App\Models\User;
use Carbon\Carbon;
use QrCode;


class LetterMarriageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             //        
             $informations = Information::get();       
             $citizen = Citizens::orderBy('name', 'asc')->get();
             $father = Citizens::orderBy('name', 'asc')->get();
             $mother = Citizens::orderBy('name', 'asc')->get();
             $couple = Citizens::orderBy('name', 'asc')->get();
             $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->orderBy('position','desc')->get();
     
             return view('transactions.letters.marriage.form', compact('citizen','father','mother','couple','informations','position'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            $validatedData = $request->validate([
                'letter_index' => 'required',
                'marriage_status' => 'required',
            ]);

            $citizen           = Citizens::findOrFail($request->get('citizen')); //data wajib ada pake firstorfail
            $father           = Citizens::find($request->get('father'));//data tidak wajib ada pake find
            $mother           = Citizens::find($request->get('mother'));//data tidak wajib ada pake find
            $couple           = Citizens::find($request->get('couple'));//data tidak wajib ada pake find
            $position           = User::findOrFail($request->get('positions'));//data wajib ada pake firstorfail

            $validatedData['letter_name']     = "surat keterangan menikah";
            $validatedData['citizen_id']     = $citizen->id;
            $validatedData['nik'] = $citizen->nik;
            $validatedData['name'] = $citizen->name;
            $validatedData['gender'] = $citizen->gender;
            $validatedData['place_birth'] = $citizen->place_birth;
            $validatedData['date_birth'] = $citizen->date_birth;
            $validatedData['religion'] = $citizen->religion;
            $validatedData['job'] = $citizen->job;
            $validatedData['address'] =  "Dusun ".$citizen->village_sub.", RT ".$citizen->rt." RW ".$citizen->rw." Desa ".$citizen->village;
            $validatedData['village_sub'] = $citizen->village_sub;
            $validatedData['rt'] = $citizen->rt;
            $validatedData['rw'] = $citizen->rw;
            $validatedData['village'] = $citizen->village;
            $validatedData['sub_districts'] = $citizen->sub_districts;
            $validatedData['districts'] = $citizen->districts;
            $validatedData['province'] = $citizen->province;

            if($request->get('yesnoAyah') == 'warga'){
                $validatedData['yesnoAyah']     = $request->get('yesnoAyah');
                $validatedData['father_id']     = $father->id;
            }else{
                $validatedData['father_id']     = null;
                $validatedData['yesnoAyah']     = $request->get('yesnoAyah');
                $validatedData['father_name']     = $request->get('father_name');
                $validatedData['father_bin']     = $request->get('father_bin');
                $validatedData['father_nik']     = $request->get('father_nik');
                $validatedData['father_place_birth']     = $request->get('father_place_birth');
                $validatedData['father_date_birth']     = $request->get('father_date_birth');
                $validatedData['father_citizenship']     = $request->get('father_citizenship');
                $validatedData['father_religion']     = $request->get('father_religion');
                $validatedData['father_job']     = $request->get('father_job');
                $validatedData['father_address']     = $request->get('father_address');
            }

            if($request->get('yesnoIbu') == 'warga'){
                $validatedData['yesnoIbu']     = $request->get('yesnoIbu');
                $validatedData['mother_id']     = $mother->id;
            }else{
                $validatedData['mother_id']     = null;
                $validatedData['yesnoIbu']     = $request->get('yesnoIbu');
                $validatedData['mother_name']     = $request->get('mother_name');
                $validatedData['mother_bin']     = $request->get('mother_bin');
                $validatedData['mother_nik']     = $request->get('mother_nik');
                $validatedData['mother_place_birth']     = $request->get('mother_place_birth');
                $validatedData['mother_date_birth']     = $request->get('mother_date_birth');
                $validatedData['mother_citizenship']     = $request->get('mother_citizenship');
                $validatedData['mother_religion']     = $request->get('mother_religion');
                $validatedData['mother_job']     = $request->get('mother_job');
                $validatedData['mother_address']     = $request->get('mother_address');
            }

            if($request->get('yesnoCalon') == 'warga'){
                $validatedData['yesnoCalon']     = $request->get('yesnoCalon');
                $validatedData['couple_id']     = $couple->id;
            }else{
                $validatedData['couple_id']     = null;
                $validatedData['yesnoCalon']     = $request->get('yesnoCalon');
                $validatedData['couple_name']     = $request->get('couple_name');
                $validatedData['couple_bin']     = $request->get('couple_bin');
                $validatedData['couple_nik']     = $request->get('couple_nik');
                $validatedData['couple_place_birth']     = $request->get('couple_place_birth');
                $validatedData['couple_date_birth']     = $request->get('couple_date_birth');
                $validatedData['couple_citizenship']     = $request->get('couple_citizenship');
                $validatedData['couple_religion']     = $request->get('couple_religion');
                $validatedData['couple_job']     = $request->get('couple_job');
                $validatedData['couple_address']     = $request->get('couple_address');
            }
          
            $validatedData['marriage_date']     = $request->get('marriage_date');
            $validatedData['yesnoMove']     = $request->get('yesnoMove');
            $validatedData['yesnoDeath']     = $request->get('yesnoDeath');


            $validatedData['signed_by']     = $position->id;
            $validatedData['signature']     = $request->get('signature');

            $validatedData['letter_date']   = $request->get('letter_date');
            $validatedData['valid_until']   = $request->get('letter_date');


            $validatedData['approval_rt']     = "waiting";
            $validatedData['approval_admin']     = "approved";
            $validatedData['created_by'] = Auth::user()->id;
            $validatedData['uuid'] = Uuid::uuid4()->getHex();


            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menambah</em> data surat keterangan usaha <strong>[' . $citizen->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'tambah',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            LetterMarriage::create($validatedData);

            return redirect('/letters')->with('success','Surat berhasil ditambahkan');

        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
