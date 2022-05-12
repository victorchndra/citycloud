<?php

namespace App\Http\Controllers\Transactions\Letter;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

//panggil auth
use Illuminate\Support\Facades\DB;

//call all letters
use App\Models\Masters\Information;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//calldb
use App\Models\Transactions\Citizens;
use App\Models\Transactions\Letter\LetterNotBPJS;
use App\Models\Transactions\Letter\LetterBusiness;
use App\Models\Transactions\Letter\LetterHoliday;

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
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($holidayletters);
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

        if(LetterHoliday::where('uuid', $uuid)->exists()) {
            $data = LetterHoliday::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat pengajuan cuti tahunan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.holiday.print',compact('data','informations'));
        }

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
