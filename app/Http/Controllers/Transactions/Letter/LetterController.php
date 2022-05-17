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

class LetterController extends Controller
{
    public function index()
    {


        if ( Auth::user()->roles == 'god' || Auth::user()->roles == 'admin'){
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();          $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recommendationletter = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($pensionletters)->concat($recommendationletter);
            $recomendationletters = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $datas = $businessletters->concat($notbpjsletters)->concat($pensionletters)->concat($holidayletters)->concat($recomendationletters);

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
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($recommendationletters)->concat($pensionletters)->concat($holidayletters);
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
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->whereNot('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($notbpjsletters)->concat($recommendationletters)->concat($pensionletters)->concat($holidayletters);
            return view('transactions.letters.indexcitizen',  compact('datas'));
        }
    }


    public function list()
    {
        return view('transactions.letters.list');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

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
                'description' => '<em>Mencetak</em> data surat keterangan cuti tahunan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.holiday.print',compact('data','informations'));
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
        elseif(LetterHoliday::where('uuid', $uuid)->exists())
        {
            $informations = Information::get();
            $letterholiday = LetterHoliday::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterHoliday::where('uuid', $uuid)->get();

            return view('transactions.letters.holiday.edit', compact('citizen','informations','position','letterholiday'));
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

    public function approve($uuid)
    {
        if (Auth::user()->roles == 'god' || Auth::user()->roles == 'admin') {
            if(LetterBusiness::where('uuid', $uuid)->exists()) {
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
        } else {

                // Auth else
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
