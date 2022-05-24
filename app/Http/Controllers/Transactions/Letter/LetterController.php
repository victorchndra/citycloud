<?php

namespace App\Http\Controllers\Transactions\Letter;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;

//panggil auth
use App\Models\Masters\RT;

//call all letters
use App\Models\Masters\RW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Masters\Information;
use App\Http\Controllers\Controller;
//calldb
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions\Citizens;
use App\Models\Transactions\Letter\LetterTax;
use App\Models\Transactions\Letter\LetterPoor;
use App\Models\Transactions\Letter\LetterBirth;
use App\Models\Transactions\Letter\LetterCrowd;
use App\Models\Transactions\Letter\LetterDeath;
use App\Models\Transactions\Letter\LetterNeedy;
use App\Models\Transactions\Letter\LetterNoAct;
use App\Models\Transactions\Letter\LetterWidow;
use App\Models\Transactions\Letter\LetterDivorce;
use App\Models\Transactions\Letter\LetterHoliday;
use App\Models\Transactions\Letter\LetterNoHouse;
use App\Models\Transactions\Letter\LetterNotBPJS;
use App\Models\Transactions\Letter\LetterPension;
use App\Models\Transactions\Letter\LetterBuilding;
use App\Models\Transactions\Letter\LetterBusiness;
use App\Models\Transactions\Letter\LetterCollegeDispensation;
use App\Models\Transactions\Letter\LetterDifferenceBirth;
use App\Models\Transactions\Letter\LetterDomicile;
use App\Models\Transactions\Letter\LetterFamilyCard;
use App\Models\Transactions\Letter\LetterProcessAct;
use App\Models\Transactions\Letter\LetterNotMarriedYet;
use App\Models\Transactions\Letter\LetterRecomendation;
use App\Models\Transactions\Letter\LetterRemoveCitizen;
use App\Models\Transactions\Letter\LetterSelfQuarantine;
use App\Models\Transactions\Letter\LetterLandOwnershipCard;
use App\Models\Transactions\Letter\LetterRecomendationWork;

class LetterController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == 'god' || Auth::user()->roles == 'admin') {
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $noactletters = LetterNoAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $processactletters = LetterProcessAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $widowletters = LetterWidow::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $divorceletter = LetterDivorce::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $buildingletter = LetterBuilding::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationletters = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationwork = LetterRecomendationWork::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $birthletters = LetterBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notmarriedyetletters = LetterNotMarriedYet::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $deathletters = LetterDeath::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $nohouseletters = LetterNoHouse::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $poorletters = LetterPoor::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $needyletters = LetterNeedy::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $domicileletters = LetterDomicile::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $familycardletters = LetterFamilyCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $removecitizenletters = LetterRemoveCitizen::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $selfquarantineletters = LetterSelfQuarantine::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $lettertax = LetterTax::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $crowd= LetterCrowd::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $differencebirthletters = LetterDifferenceBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $collegedispensationletters = LetterCollegeDispensation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $landownerletters = LetterLandOwnershipCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($lettertax)->concat($notbpjsletters)->concat($pensionletters)->concat($recomendationletters)->concat($birthletters)->concat($holidayletters)->concat($nohouseletters)->concat($buildingletter)->concat($divorceletter)->concat($notmarriedyetletters)->concat($deathletters)->concat($poorletters)->concat($needyletters)->concat($domicileletters)->concat($familycardletters)->concat($removecitizenletters)->concat($selfquarantineletters)->concat($differencebirthletters)->concat($recomendationwork)->concat($noactletters)->concat($processactletters)->concat($widowletters)->concat($landownerletters)->concat($landownerletters);

            return view('transactions.letters.index',  compact('datas'));
        } elseif (Auth::user()->roles == 'citizens') {
            return view('transactions.letters.list');
        } else {
            return view('transactions.letters.list');
        }
    }


    public function indexcitizen()
    {

        if (Auth::user()->roles == 'god' || Auth::user()->roles == 'admin') {
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $noactletters = LetterNoAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $processactletters = LetterProcessAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $widowletters = LetterWidow::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $divorceletter = LetterDivorce::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $buildingletter = LetterBuilding::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationletters = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationwork = LetterRecomendationWork::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $birthletters = LetterBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notmarriedyetletters = LetterNotMarriedYet::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $deathletters = LetterDeath::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $nohouseletters = LetterNoHouse::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $poorletters = LetterPoor::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $needyletters = LetterNeedy::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $domicileletters = LetterDomicile::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $familycardletters = LetterFamilyCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $removecitizenletters = LetterRemoveCitizen::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $selfquarantineletters = LetterSelfQuarantine::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $lettertax = LetterTax::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $crowd= LetterCrowd::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $differencebirthletters = LetterDifferenceBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $collegedispensationletters = LetterCollegeDispensation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $landownerletters = LetterLandOwnershipCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($lettertax)->concat($notbpjsletters)->concat($pensionletters)->concat($recomendationletters)->concat($birthletters)->concat($holidayletters)->concat($nohouseletters)->concat($buildingletter)->concat($divorceletter)->concat($notmarriedyetletters)->concat($deathletters)->concat($poorletters)->concat($needyletters)->concat($domicileletters)->concat($familycardletters)->concat($removecitizenletters)->concat($selfquarantineletters)->concat($differencebirthletters)->concat($recomendationwork)->concat($noactletters)->concat($processactletters)->concat($widowletters)->concat($landownerletters)->concat($collegedispensationletters)->concat($crowd);
            return view('transactions.letters.indexcitizen',  compact('datas'));
        } elseif (Auth::user()->roles == 'headrt') {
            $businessletters = Citizens::join('letter_businesses', 'citizens.id', '=', 'letter_businesses.citizen_id')
                ->where('letter_businesses.rt', '=', Auth::user()->rt)->orderBy('letter_businesses.created_at', 'desc')->get();
            return view('transactions.letters.indexcitizen',  compact('businessletters'));
        } elseif (Auth::user()->roles == 'citizens') {
            $businessletters = LetterBusiness::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notbpjsletters = LetterNotBPJS::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $pensionletters = LetterPension::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $noactletters = LetterNoAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $processactletters = LetterProcessAct::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $widowletters = LetterWidow::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $divorceletter = LetterDivorce::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $buildingletter = LetterBuilding::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationletters = LetterRecomendation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationwork = LetterRecomendationWork::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $holidayletters = LetterHoliday::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $birthletters = LetterBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $notmarriedyetletters = LetterNotMarriedYet::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $deathletters = LetterDeath::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $nohouseletters = LetterNoHouse::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $poorletters = LetterPoor::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $needyletters = LetterNeedy::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $domicileletters = LetterDomicile::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $familycardletters = LetterFamilyCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $removecitizenletters = LetterRemoveCitizen::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $selfquarantineletters = LetterSelfQuarantine::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $lettertax = LetterTax::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $crowd= LetterCrowd::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $differencebirthletters = LetterDifferenceBirth::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $recomendationwork = LetterRecomendationWork::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $collegedispensationletters = LetterCollegeDispensation::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();
            $landownerletters = LetterLandOwnershipCard::orderBy('created_at', 'desc')->where('created_by', '=', Auth::user()->id)->get();

            $datas = $businessletters->concat($lettertax)->concat($notbpjsletters)->concat($pensionletters)->concat($recomendationletters)->concat($birthletters)->concat($holidayletters)->concat($nohouseletters)->concat($buildingletter)->concat($divorceletter)->concat($notmarriedyetletters)->concat($deathletters)->concat($poorletters)->concat($needyletters)->concat($domicileletters)->concat($familycardletters)->concat($removecitizenletters)->concat($selfquarantineletters)->concat($differencebirthletters)->concat($recomendationwork)->concat($noactletters)->concat($processactletters)->concat($widowletters)->concat($landownerletters)->concat($collegedispensationletters)->concat($crowd);
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
        if (LetterBusiness::where('uuid', $uuid)->exists()) {
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

            return view('transactions.letters.business.print', compact('data', 'informations'));
        }

        // Surat belum menerima bpjs
        if (LetterNotBPJS::where('uuid', $uuid)->exists()) {
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

            return view('transactions.letters.notbpjs.print', compact('data', 'informations'));
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

            return view('transactions.letters.holiday.print', compact('data', 'informations'));
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
        if (LetterPension::where('uuid', $uuid)->exists()) {
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

            return view('transactions.letters.pension.print', compact('data', 'informations'));
        }

        //surat cerai
        if (LetterDivorce::where('uuid', $uuid)->exists()) {
            $data = LetterDivorce::where('uuid', $uuid)->firstOrFail();
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

            return view('transactions.letters.cerai.print', compact('data', 'informations'));
        }

        //surat keterangan rekomendasi skck
        if (LetterRecomendation::where('uuid', $uuid)->exists()) {
            $data = LetterRecomendation::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat skck <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.recomendation.print', compact('data', 'informations'));
        }

        if (LetterBuilding::where('uuid', $uuid)->exists()) {
            $data = LetterBuilding::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat Izin Membangun Bangunan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.building.print', compact('data', 'informations'));
        }

        //surat keterangan kelahiran
        if (LetterBirth::where('uuid', $uuid)->exists()) {
            $data = LetterBirth::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan kelahiran <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.birth.print', compact('data', 'informations'));
        }

        //surat keterangan blm pnya rumah
        if (LetterNoHouse::where('uuid', $uuid)->exists()) {
            $data = LetterNoHouse::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan belum punya rumah <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.nohouse.print', compact('data', 'informations'));
        }

        //surat keterangan miskin
        if (LetterPoor::where('uuid', $uuid)->exists()) {
            $data = LetterPoor::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan miskin <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.poor.print', compact('data', 'informations'));
        }

        //surat keterangan tidak mampu
        if (LetterNeedy::where('uuid', $uuid)->exists()) {
            $data = LetterNeedy::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan tidak mampu <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.needy.print', compact('data', 'informations'));
        }
        //surat keterangan domisili
        if (LetterDomicile::where('uuid', $uuid)->exists()) {
            $data = LetterDomicile::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan domisili <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.domicile.print', compact('data', 'informations'));
        }
        //surat permohonan kartu kerluarga
        if (LetterFamilyCard::where('uuid', $uuid)->exists()) {
            $data = LetterFamilyCard::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat permohonan kartu keluarga <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.familycard.print', compact('data', 'informations'));
        }
        //surat pernyataan keterangan kepemilikan tanah
        if (LetterLandOwnershipCard::where('uuid', $uuid)->exists()) {
            $data = LetterLandOwnershipCard::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat pernyataan kepemilikan lahan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.landownership.print', compact('data', 'informations'));
        }


        // Surat keterangan kematian
        if (LetterDeath::where('uuid', $uuid)->exists()) {
            $data = LetterDeath::where('uuid', $uuid)->firstOrFail();

            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan kematian <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.death.print', compact('data', 'informations'));
        }

        // Surat keterangan penghapusan biodata penduduk
        if (LetterRemoveCitizen::where('uuid', $uuid)->exists()) {
            $data = LetterRemoveCitizen::where('uuid', $uuid)->firstOrFail();

            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan penghapusan biodata penduduk <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.removecitizen.print', compact('data', 'informations'));
        }

        // Surat keterangan karantina mandiri
        if (LetterSelfQuarantine::where('uuid', $uuid)->exists()) {
            $data = LetterSelfQuarantine::where('uuid', $uuid)->firstOrFail();

            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan karantina mandiri <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.selfquarantine.print', compact('data', 'informations'));
        }

        // Surat keterangan beda tanggal lahir
        if (LetterDifferenceBirth::where('uuid', $uuid)->exists()) {
            $data = LetterDifferenceBirth::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan beda tanggal lahir <strong>[' . $data->name . ']</strong>',
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.differencebirth.print', compact('data', 'informations'));
        }

        // Surat rekomendasi kerja
        if(LetterRecomendationWork::where('uuid', $uuid)->exists()) {
            $data = LetterRecomendationWork::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat rekomendasi kerja <strong>[' . $data->name . ']</strong>',
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.workrecomend.print',compact('data','informations'));
        }

        // Surat Dispensasi SPP Kuliah
        if(LetterCollegeDispensation::where('uuid', $uuid)->exists()) {
            $data = LetterCollegeDispensation::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan dispensasi SPP kuliah <strong>[' . $data->name . ']</strong>',
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.collegedispensation.print',compact('data','informations'));
        }

        // Surat Belum Menikah
        if(LetterNotMarriedYet::where('uuid', $uuid)->exists()) {
            $data = LetterNotMarriedYet::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat keterangan belum menikah <strong>[' . $data->name . ']</strong>',
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.notmarriedyet.print',compact('data','informations'));
        }

        //surat keramaian
        if(LetterCrowd::where('uuid', $uuid)->exists()) {
            $data = LetterCrowd::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat izin keramaian <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.crowd.print',compact('data','informations'));
        }

        //surat npwp
        if(LetterTax::where('uuid', $uuid)->exists()) {
            $data = LetterTax::where('uuid', $uuid)->firstOrFail();
            $informations = Information::first();
            // tambahkan baris kode ini di setiap controller
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mencetak</em> data surat NPWP <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
                'category' => 'cetak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return view('transactions.letters.tax.print',compact('data','informations'));
        }
    }

    public function edit($uuid, Request $request)
    {
        //surat Pensiun
        if (LetterPension::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterpension = LetterPension::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterPension::where('uuid', $uuid)->get();

            return view('transactions.letters.pension.edit', compact('citizen', 'informations', 'position', 'letterpension'));
        }

        //surat cerai
        if (LetterDivorce::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterdivorce = LetterDivorce::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterDivorce::where('uuid', $uuid)->get();
            return view('transactions.letters.cerai.edit', compact('citizen', 'informations', 'position', 'letterdivorce'));
        }

        if (LetterBuilding::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterbuilding = LetterBuilding::where('uuid', $uuid)->get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterBuilding::where('uuid', $uuid)->get();
            return view('transactions.letters.building.edit', compact('citizen', 'informations', 'position', 'letterbuilding'));
        }
        //Surat Keterangan Cuti Tahunan
        if(LetterHoliday::where('uuid', $uuid)->exists())
        {
            $informations = Information::get();
            $letterholiday = LetterHoliday::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterHoliday::where('uuid', $uuid)->get();

            return view('transactions.letters.holiday.edit', compact('citizen', 'informations', 'position', 'letterholiday'));
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
        if (LetterRecomendation::where('uuid', $uuid)->exists()) {
            $rts = RT::get();
            $rtSelected =  $request->get('rt');
            $informations = Information::get();
            $recomendationletters = LetterRecomendation::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterRecomendation::where('uuid', $uuid)->get();

            return view('transactions.letters.recomendation.edit', compact('citizen', 'informations', 'position', 'recomendationletters', 'rts', 'rtSelected'));
        }

        // Surat Keterangan Kematian
        if (LetterDeath::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $deathletters = LetterDeath::get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterDeath::where('uuid', $uuid)->get();

            return view('transactions.letters.death.edit', compact('citizen', 'informations', 'position', 'deathletters'));
        }

        // Surat Keterangan Belum Menerima BPJS
        if (LetterNotBPJS::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $notbpjsletters = LetterNotBPJS::get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterNotBPJS::where('uuid', $uuid)->get();

            return view('transactions.letters.notbpjs.edit', compact('citizen', 'informations', 'position', 'notbpjsletters'));
        }

        // Surat Keterangan Belum Menikah
        if (LetterNotMarriedYet::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $notmarriedyetletters = LetterNotMarriedYet::get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterNotMarriedYet::where('uuid', $uuid)->get();

            return view('transactions.letters.notmarriedyet.edit', compact('citizen', 'informations', 'position', 'notmarriedyetletters'));
        }
        //surat Keterangan Kelahiran
        if (LetterBirth::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterbirth = LetterBirth::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterBirth::where('uuid', $uuid)->get();

            return view('transactions.letters.birth.edit', compact('citizen', 'informations', 'position', 'letterbirth'));
        }

        //surat blm punya rumah
        if (LetterNoHouse::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letternohouse = LetterNoHouse::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterNoHouse::where('uuid', $uuid)->get();

            return view('transactions.letters.nohouse.edit', compact('citizen', 'informations', 'position', 'letternohouse'));
        }

        //surat ket. miskin
        if (LetterPoor::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterpoor = LetterPoor::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterPoor::where('uuid', $uuid)->get();

            return view('transactions.letters.poor.edit', compact('citizen', 'informations', 'position', 'letterpoor'));
        }

        //surat ket. tidak mampu
        if (LetterNeedy::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterneedy = LetterNeedy::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterNeedy::where('uuid', $uuid)->get();

            return view('transactions.letters.needy.edit', compact('citizen', 'informations', 'position', 'letterneedy'));
        }
        //surat ket. domisili
        if (LetterDomicile::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterdomicile = LetterDomicile::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterDomicile::where('uuid', $uuid)->get();

            return view('transactions.letters.domicile.edit', compact('citizen', 'informations', 'position', 'letterdomicile'));
        }
        //surat permohonan kk
        if (LetterFamilyCard::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterfamilycard = LetterFamilyCard::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterFamilyCard::where('uuid', $uuid)->get();

            return view('transactions.letters.familycard.edit', compact('citizen', 'informations', 'position', 'letterfamilycard'));
        }
        //surat permohonan kk
        if (LetterFamilyCard::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterfamilycard = LetterFamilyCard::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterFamilyCard::where('uuid', $uuid)->get();

            return view('transactions.letters.familycard.edit', compact('citizen', 'informations', 'position', 'letterfamilycard'));
        }
        //surat pernyataan kepemilikan tanah
        if (LetterLandOwnershipCard::where('uuid', $uuid)->exists()) {
            $rts = RT::get();
            $rtSelected =  $request->get('rt');
            $rws = RW::get();
            $rwSelected =  $request->get('rw');
            $informations = Information::get();
            $letterlandownership = LetterLandOwnershipCard::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position', 'kepala desa')->orWhere('position', 'sekretaris desa')->get();
            $citizen = LetterLandOwnershipCard::where('uuid', $uuid)->get();

            return view('transactions.letters.landownership.edit', compact('citizen', 'informations', 'position', 'letterlandownership','rts','rtSelected',
            'rws','rwSelected'));
        }

        //surat rekomendasi kerja
        if(LetterRecomendationWork::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterwork = LetterRecomendationWork::get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterRecomendationWork::where('uuid', $uuid)->get();

            return view('transactions.letters.workrecomend.edit', compact('citizen','informations','position','letterwork'));
        }

        //surat karantina mandiri
        if(LetterSelfQuarantine::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterwork = LetterSelfQuarantine::get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterSelfQuarantine::where('uuid', $uuid)->get();

            return view('transactions.letters.selfquarantine.edit', compact('citizen','informations','position','letterwork'));
        }

        //surat beda tanggal lahir
        if(LetterDifferenceBirth::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $letterwork = LetterDifferenceBirth::get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterDifferenceBirth::where('uuid', $uuid)->get();

            return view('transactions.letters.differencebirth.edit', compact('citizen','informations','position','letterwork'));
        }

        //surat izin keramaian
        if(LetterCrowd::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $lettercrowd = LetterCrowd::where('uuid', $uuid)->get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterCrowd::where('uuid', $uuid)->get();

            return view('transactions.letters.crowd.edit', compact('citizen','informations','position','lettercrowd'));
        }

        //surat npwp
        if(LetterTax::where('uuid', $uuid)->exists()) {
            $informations = Information::get();
            $lettertax = LetterTax::where('uuid', $uuid)->get();
            // $citizen = Citizen::orderBy('name', 'asc')->get();
            $position = User::where('position','kepala desa')->orWhere('position','sekretaris desa')->get();
            $citizen = LetterTax::where('uuid', $uuid)->get();

            return view('transactions.letters.tax.edit', compact('citizen','informations','position','lettertax'));
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
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
        }
        // Rejected : Surat keterangan kelahiran
        elseif (LetterBirth::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterBirth::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
        } elseif (LetterBuilding::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterBuilding::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
        }
        elseif (LetterRecomendationWork::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterRecomendationWork::get()->where('uuid', $uuidValidated)->firstOrFail();
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

        //letter blm pnya rmh
        elseif (LetterNoHouse::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterNoHouse::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
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

        //letter crowd
        elseif (LetterCrowd::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterCrowd::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
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

        //surat npwp
        elseif (LetterTax::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterTax::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
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
        // Rejected : Surat permohonan kk
        elseif (LetterFamilyCard::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterFamilyCard::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                'category' => 'tolak',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil ditolak');
        }
        // Rejected : Surat keterangan kepemilikan tanah
        elseif (LetterLandOwnershipCard::where('uuid', $uuidValidated)->exists() && $request->get('rejected_notes_admin')) {
            $data = LetterLandOwnershipCard::get()->where('uuid', $uuidValidated)->firstOrFail();
            $data['rejected_notes_admin']   = $request->get('rejected_notes_admin');
            $data->update([
                'updated_by' => Auth::user()->id,
                'approval_admin' => "rejected",
            ]);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menolak </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
        if (LetterPension::where('uuid', $uuid)->exists()) {
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


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
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


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
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

        if (LetterRecomendation::where('uuid', $uuid)->exists()) {
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


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }
        if (LetterBirth::where('uuid', $uuid)->exists()) {
            $data = LetterBirth::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Kelahiran <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        // Surat belum menikah
        if (LetterNotMarriedYet::where('uuid', $uuid)->exists()) {
            $data = LetterNotMarriedYet::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->deleted_at = now();
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Belum Menikah <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        if (LetterBuilding::where('uuid', $uuid)->exists()) {
            $data = LetterBuilding::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Izin Pembangunan <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        // Surat keterangan kematian
        if (LetterDeath::where('uuid', $uuid)->exists()) {
            $data = LetterDeath::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Kematian <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }
        if (LetterNoHouse::where('uuid', $uuid)->exists()) {
            $data = LetterNoHouse::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Belum Punya Rumah <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        if (LetterPoor::where('uuid', $uuid)->exists()) {
            $data = LetterPoor::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Miskin <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        if (LetterNeedy::where('uuid', $uuid)->exists()) {
            $data = LetterNeedy::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Tidak Mampu <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }
        if (LetterDomicile::where('uuid', $uuid)->exists()) {
            $data = LetterDomicile::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Domisili <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }
        if (LetterFamilyCard::where('uuid', $uuid)->exists()) {
            $data = LetterFamilyCard::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat permohonan Kartu Keluarga <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }

        if(LetterRecomendationWork::where('uuid', $uuid)->exists()) {
            $data = LetterRecomendationWork::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Rekomendasi Kerja<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();


            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        // Surat Belum Memiliki BPJS
        if(LetterNotBPJS::where('uuid', $uuid)->exists()) {
            $data = LetterNotBPJS::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Belum Memiliki BPJS<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        if(LetterCrowd::where('uuid', $uuid)->exists()) {
            $data = LetterCrowd::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Izin Keramaian<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        // Surat Keterangan Karantina Mandiri
        if(LetterSelfQuarantine::where('uuid', $uuid)->exists()) {
            $data = LetterSelfQuarantine::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Karantina Mandiri<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        if(LetterTax::where('uuid', $uuid)->exists()) {
            $data = LetterTax::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Pajak<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        // Surat Keterangan Beda Tanggal Lahir
        if(LetterDifferenceBirth::where('uuid', $uuid)->exists()) {
            $data = LetterDifferenceBirth::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Beda Tanggal Lahir<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }
        if (LetterLandOwnershipCard::where('uuid', $uuid)->exists()) {
            $data = LetterLandOwnershipCard::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Pernyataan Kepemilikan Lahan <strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success','Surat berhasil dihapus');
        }

        // Surat Keterangan Dispensasi SPP Kuliah
        if(LetterCollegeDispensation::where('uuid', $uuid)->exists()) {
            $data = LetterCollegeDispensation::get()->where('uuid', $uuid)->firstOrFail();
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Menghapus</em> Surat Keterangan Dispensasi SPP Kuliah<strong>[' . $data->name . ']</strong>',
                'category' => 'hapus',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            $data->delete();

            return redirect('/letters')->with('success', 'Surat berhasil dihapus');
        }
    }

    public function approve($uuid)
    {
        if (Auth::user()->roles == 'god' || Auth::user()->roles == 'admin') {
            if (LetterBusiness::where('uuid', $uuid)->exists()) {
                $data = LetterBusiness::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterNoHouse::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterNoHouse::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterPoor::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterPoor::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            } elseif (LetterNeedy::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterNeedy::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }
            elseif (LetterDomicile::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterDomicile::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }
            elseif (LetterFamilyCard::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterFamilyCard::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }
            elseif (LetterCrowd::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterCrowd::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }
            elseif (LetterTax::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterTax::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                    'category' => 'setuju',
                    'created_at' => now(),
                ];

                DB::table('logs')->insert($log);
                // selesai

                return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
            }
            elseif (LetterLandOwnershipCard::where('uuid', $uuid)->exists()) {
                // Approve : Surat belum menerima bpjs
                $data = LetterLandOwnershipCard::get()->where('uuid', $uuid)->firstOrFail();
                $data->update([
                    'updated_by' => Auth::user()->id,
                    'approval_admin' => "approved",
                    'rejected_notes_admin' => null,
                ]);

                // tambahkan baris kode ini di setiap controller
                $log = [
                    'uuid' => Uuid::uuid4()->getHex(),
                    'user_id' => Auth::user()->id,
                    'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
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
                'updated_by' => Auth::user()->id,
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
                'description' => '<em>Menyetujui </em> ' . $data->letter_name . ' <strong>[' . $data->name . ']</strong>',
                'category' => 'setuju',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/letters-citizens')->with('success', 'Surat berhasil disetujui');
        }

    }
}
