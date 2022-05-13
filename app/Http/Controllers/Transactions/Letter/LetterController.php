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
use App\Models\Transactions\Letter\LetterPension;
use App\Models\Transactions\Letter\LetterRecomendation;

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
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recommendationletter = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($pensionletters)->concat($recommendationletter);
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
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            $recommendationletters = LetterRecomendation::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($recommendationletters)->concat($pensionletters);
            return view('transactions.letters.indexcitizen',  compact('datas'));
        }elseif(Auth::user()->roles == 'headrt'){
            $businessletters = Citizens::join('letter_businesses', 'citizens.id', '=', 'letter_businesses.citizen_id')
            ->where('letter_businesses.rt', '=', Auth::user()->rt)->orderBy('letter_businesses.created_at', 'desc')->get();
            return view('transactions.letters.indexcitizen',  compact('businessletters'));
        }elseif(Auth::user()->roles == 'citizens' ){
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            $recommendationletters = LetterRecomendation::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($recommendationletters)->concat($pensionletters);
            return view('transactions.letters.indexcitizen',  compact('datas'));
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
        $uuidValidated = $request->input('uuidValidate');
        // Rejected : Surat keterangan usaha
        if (LetterBusiness::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterBusiness::get()->where('uuid', $uuidValidated)->firstOrFail();
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
        // Rejected : Surat belum menerima bpjs
        elseif (LetterNotBPJS::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterNotBPJS::get()->where('uuid', $uuidValidated)->firstOrFail();
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
        // Rejected : Surat keterangan pensiun
        elseif (LetterPension::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterPension::get()->where('uuid', $uuidValidated)->firstOrFail();
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
        // Rejected : Surat keterangan rekomendasi
        elseif (LetterRecomendation::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterRecomendation::get()->where('uuid', $uuidValidated)->firstOrFail();
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

    public function approve($uuid) {
        // Auth god and admin

        if( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){

            if(LetterBusiness::where('uuid', $uuid)->exists()) {
                // Approve : Surat keterangan usaha
                $data = LetterBusiness::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterRecomendation::where('uuid', $uuid)->exists()) {
                // Approve : Surat rekomendasi
                $data = LetterRecomendation::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterPension::where('uuid', $uuid)->exists()) {
                // Approve : Surat keterangan pensiun
                $data = LetterPension::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterNotBPJS::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterNotBPJS::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' =>Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }

        }
        // Auth else
        else {

            $data = LetterBusiness::get()->where('uuid', $uuid)->firstOrFail();
            $data->update([
                'updated_by' =>Auth::user()->id,
                'approval_rt' => "approved",
            ]);

            // $data->update([
            //     'updated_by' =>Auth::user()->id,
            //     'approval_rt    ' => "approved",
            //     'rejected_notes_admin' => null,
            // ]);

            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menyetujui </em> '.$data->letter_name .' <strong>[' . $data->name . ']</strong>',
                'category' => 'setuju',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
        }
    }
}
