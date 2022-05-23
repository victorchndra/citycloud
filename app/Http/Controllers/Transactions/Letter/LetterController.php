<?php

namespace App\Http\Controllers\Transactions\Letter;

use App\Models\User;
use Ramsey\Uuid\Uuid;

//panggil auth
use Illuminate\Http\Request;

//call all letters
use Illuminate\Support\Facades\DB;
use App\Models\Masters\Information;
use App\Http\Controllers\Controller;
use App\Models\Masters\RT;
//calldb
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions\Citizens;
use App\Models\Transactions\Letter\LetterNotBPJS;
use App\Models\Transactions\Letter\LetterPension;
use App\Models\Transactions\Letter\LetterBusiness;
use App\Models\Transactions\Letter\LetterHoliday;
use App\Models\Transactions\Letter\LetterRecomendation;
use App\Models\Transactions\Letter\LetterNoAct;
use App\Models\Transactions\Letter\LetterProcessAct;
use App\Models\Transactions\Letter\LetterWidow;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationletters = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $noactletters = LetterNoAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $processactletters = LetterProcessAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $widowletters = LetterWidow::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $datas = $businessletters->concat($notbpjsletters)->concat($pensionletters)->concat($holidayletters)->concat($recomendationletters)->concat($noactletters)->concat($processactletters)->concat($widowletters);
            return view('transactions.letters.index',  compact('datas'));
        }elseif( Auth::user()->roles == 'citizens'){
            return view('transactions.letters.list');
        }else{
            return view('transactions.letters.list');
        }

    }


    public function indexcitizen()
    {

        if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            $businessletters = LetterNotBPJS::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            return view('transactions.letters.indexcitizen',  compact('businessletters'));
        }elseif(Auth::user()->roles == 'headrt'){
            $businessletters = Citizens::join('letter_businesses', 'citizens.id', '=', 'letter_businesses.citizen_id')
            ->where('letter_businesses.rt', '=', Auth::user()->rt)->orderBy('letter_businesses.created_at', 'desc')->get();
            return view('transactions.letters.indexcitizen',  compact('businessletters'));
        }elseif(Auth::user()->roles == 'citizens' ){
            $businessletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            return view('transactions.letters.indexcitizen',  compact('businessletters'));
        }
    }


    public function list()
    {
        return view('transactions.letters.list');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        // Surat keterangan usaha
        if(LetterBusiness::where('uuid', $uuid)->exists()) {
            $data = LetterBusiness::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan usaha <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.business.print',compact('data','informations'));
        }
        
        // Surat belum menerima bpjs
        if(LetterNotBPJS::where('uuid', $uuid)->exists()) {
            $data = LetterNotBPJS::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
                    // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Mencetak</em> data surat belum menerima BPJS <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                    'category' => 'cetak',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

            return view('transactions.letters.notbpjs.print',compact('data','informations'));
        }

        //Surat cuti tahunan
        if(LetterHoliday::where('uuid', $uuid)->exists()) {
            $data = LetterHoliday::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan cuti tahunan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.holiday.print',compact('data','informations'));
        }
        
        //surat belum memiliki akte
        if(LetterNoAct::where('uuid', $uuid)->exists()) {
            $data = LetterNoAct::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat pernyataan belum memiliki akta kelahiran <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.noact.print',compact('data','informations'));
        }
        
        //SURAT KETERANGAN AKTE KELAHIRAN DALAM PENGURUSAN
        if(LetterProcessAct::where('uuid', $uuid)->exists()) {
            $data = LetterProcessAct::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan akte kelahiran dalam pengurusan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.processact.print',compact('data','informations'));
        }
        
        //SURAT KETERANGAN JANDA
        if(LetterWidow::where('uuid', $uuid)->exists()) {
            $data = LetterWidow::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan janda <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.widow.print',compact('data','informations'));
        }

        //surat Pensiun
        if(LetterPension::where('uuid', $uuid)->exists()) {
            $data = LetterPension::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
                    // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Mencetak</em> data surat Pensiun <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                    'category' => 'cetak',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

            return view('transactions.letters.pension.print',compact('data','informations'));
        }
        if(LetterRecomendation::where('uuid', $uuid)->exists()) {
            $data = LetterRecomendation::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
                    // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Mencetak</em> data surat Pensiun <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                    'category' => 'cetak',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

            return view('transactions.letters.recomendation.print',compact('data','informations'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid, Request $request)
    {
        //surat Pensiun
        if(LetterPension::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterpension = LetterPension::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterPension::where('uuid', $uuid)->get();
            
            return view('transactions.letters.pension.edit', compact('citizen','informations','position','letterpension'));
        }

        //Surat Keterangan Cuti Tahunan
        if(LetterHoliday::where('uuid', $uuid)->exists()) 
        {
            $informations = Information::get();
            $letterholiday = LetterHoliday::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterHoliday::where('uuid', $uuid)->get();
            
            return view('transactions.letters.holiday.edit', compact('citizen','informations','position','letterholiday'));
        }
        
        //Surat pernyataan tidak memiliki akta kelahiran
        if(LetterNoAct::where('uuid', $uuid)->exists()) 
        {
            $informations = Information::get();
            $letternoact = LetterNoAct::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterNoAct::where('uuid', $uuid)->get();
            
            return view('transactions.letters.noact.edit', compact('citizen','informations','position'));
        }
        
        //Surat Keterangan Akte Kelahiran Dalam Pengurusan
        if(LetterProcessAct::where('uuid', $uuid)->exists()) 
        {
            $informations = Information::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterProcessAct::where('uuid', $uuid)->get();
            
            return view('transactions.letters.processact.edit', compact('citizen','informations','position'));
        }
        
        //Surat surat keterangan janda
        if(LetterWidow::where('uuid', $uuid)->exists()) 
        {
            $informations = Information::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterWidow::where('uuid', $uuid)->get();
            
            return view('transactions.letters.widow.edit', compact('citizen','informations','position'));
        }
        
        //surat Rekomendasi
        if(LetterRecomendation::where('uuid', $uuid)->exists()) {
            $rts = RT::get();
            $rtSelected =  $request->get('rt');
            $informations = Information::get();
            $recomendationletters = LetterRecomendation::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterRecomendation::where('uuid', $uuid)->get();
            
            return view('transactions.letters.recomendation.edit', compact('citizen','informations','position','recomendationletters','rts','rtSelected'));
        }
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
    public function destroy($uuid)
    {
        //
        if(LetterPension::where('uuid', $uuid)->exists()) {
            $data = LetterPension::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Pensiun <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }
        
        //Surat Keterangan Cuti Tahunan
        if(LetterHoliday::where('uuid', $uuid)->exists()) {
            $data = LetterHoliday::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Cuti Tahunan <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }
        
        //Surat pernyataan tidak memiliki akta kelahiran
        if(LetterNoAct::where('uuid', $uuid)->exists()) {
            $data = LetterNoAct::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat pernyataan tidak memiliki akta kelahiran <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }
        
        //Surat keterangan akte kelahiran dalam pengurusan
        if(LetterProcessAct::where('uuid', $uuid)->exists()) {
            $data = LetterProcessAct::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Akte Kelahiran Dalam Pengurusan <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }
        
        //Surat keterangan janda
        if(LetterWidow::where('uuid', $uuid)->exists()) {
            $data = LetterWidow::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Janda <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        if(LetterRecomendation::where('uuid', $uuid)->exists()) {
            $data = LetterRecomendation::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Rekomendasi <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];
    
            DB::table('logs')->insert($log);
            $data->delete();
    
            
            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        
    }
}
