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

            $citizen           = Citizens::findOrFail($request->get('citizen'));
            $father           = Citizens::findOrFail($request->get('father'));
            $mother           = Citizens::findOrFail($request->get('mother'));
            $couple           = Citizens::findOrFail($request->get('couple'));
            $position           = User::findOrFail($request->get('positions'));

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

            $validatedData['yesnoAyah']     = $request->get('yesnoAyah');
            $validatedData['father_id']     = $father->id;


            $validatedData['yesnoIbu']     = $request->get('yesnoIbu');
            $validatedData['mother_id']     = $mother->id;


            $validatedData['yesnoCalon']     = $request->get('yesnoCalon');
            $validatedData['couple_id']     = $couple->id;

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
