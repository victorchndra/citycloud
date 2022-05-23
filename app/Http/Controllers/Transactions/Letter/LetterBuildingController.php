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
use App\Models\Transactions\Letter\LetterBuilding;
use App\Models\Masters\Information;
use App\Models\User;

class LetterBuildingController extends Controller
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
        $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
        
        return view('transactions.letters.building.form', compact('citizen','informations','position'));
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
        if( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            $validatedData = $request->validate([
                'letter_index' => 'required',
                'place_build' => 'required',
                'use_build' => 'required',
                'building_owner' => 'required',
                'proof_mastery' => 'required'
            ]);
    
            $citizen           = Citizens::findOrFail($request->get('citizens'));
            $position           = User::findOrFail($request->get('positions'));
    
            $validatedData['letter_name']     = "surat keterangan izin membangun bangunan";
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
                'description' => '<em>Menambah</em> data surat izin membangun bangunan <strong>[' . $citizen->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'tambah',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            // selesai
    
            LetterBuilding::create($validatedData);
    
            return redirect('/letters')->with('success','Surat berhasil ditambahkan');

        }else{

               $validatedData = $request->validate([
                'letter_index' => 'required',
                'place_build' => 'required',
                'use_build' => 'required',
                'building_owner' => 'required',
                'proof_mastery' => 'required'
            ]);
    
            $citizen           = Citizens::findOrFail($request->get('citizens'));
            $position           = User::findOrFail($request->get('positions'));
    
            $validatedData['letter_name']     = "surat keterangan usaha";
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
           
            $validatedData['signed_by']     = $position->id;
            $validatedData['signature']     = "wet";
    
            $validatedData['letter_date']   = date('Y-m-d');
            $validatedData['valid_until']   = date('Y-m-d');
            $validatedData['approval_rt']     = "waiting";
            $validatedData['approval_admin']     = "waiting";
    
            $validatedData['created_by'] = Auth::user()->id;
            $validatedData['uuid'] = Uuid::uuid4()->getHex();
    
    
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menambah</em> data surat pengajuan building <strong>[' . $citizen->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'tambah',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            // selesai
    
            LetterBuilding::create($validatedData);
    
            return redirect('/letters-citizens')->with('success','Surat berhasil ditambahkan');


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
    public function update(Request $request, $uuid)
    {
        //
        if( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            if ($request->get('rejected_notes_admin')) {
                $data = LetterBuilding::get()->where('uuid', $uuid)->firstOrFail();
                $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_admin' => "rejected",
                ]);
    
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            // selesai
    
            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
            }
            $validatedData = $request->validate([
                'letter_index' => 'required',
                'place_build' => 'required',
                'use_build' => 'required',
                'building_owner' => 'required',
                'proof_mastery' => 'required'
            ]);
            $position           = User::findOrFail($request->get('positions'));
            $validatedData['letter_date']   = $request->get('letter_date');
            $validatedData['valid_until']   = $request->get('letter_date');
            $validatedData['signed_by']     = $position->id;
            $validatedData['signature']     = $request->get('signature');
    
    
            if ($validatedData) {
    
                $validatedData['updated_by'] = Auth::user()->id;
                $letters = LetterBuilding::where('uuid', $uuid)->first()->update($validatedData);
            }
    
            $data = LetterBuilding::get()->where('uuid', $uuid)->firstOrFail();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> Surat Keterangan Izin Membangun Bangunan <strong>[' . $data->name . ']</strong>',
                'category' => 'edit',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
    
            return redirect('/letters')->with('success', 'Data berhasil diperbarui!');
        }else{
            if ($request->get('rejected_notes_rt')) {
                $data = LetterBuilding::get()->where('uuid', $uuid)->firstOrFail();
                $data['rejected_notes_rt']   = $request->get('rejected_notes_rt');
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_rt' => "rejected",
                ]);
    
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            // selesai
    
            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
        }
        }
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
        $data = LetterBuilding::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> Surat Keterangan Izin Membangun Bangunan<strong>[' . $data->name . ']</strong>',
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();


        return redirect('/letters')->with('success','Surat berhasil dihapus');
    }
}
