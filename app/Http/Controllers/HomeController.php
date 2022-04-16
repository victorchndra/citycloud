<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// panggil model citizens 
use App\Models\Transactions\Citizens;
use App\Models\Masters\Information;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informations = Information::get();
        // count total citizens
        $countCitizens = Citizens::count('id');

        $countKK = Citizens::where('family_status','=','kepala keluarga')->count();

        $countMove = Citizens::whereNotNull('move_date')->count();
        $countDtks = Citizens::whereNot('dtks','=','')->count();
        $countDeath = Citizens::whereNotNull('death_date')->count();

        // count total citizens men
        $countCitizensMen = Citizens::where('gender','=','l')->count();

         // count total citizens women
        $countCitizensWomen = Citizens::where('gender','=','p')->count();

        //itung usia
        $countAge05 = Citizens::whereRaw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 0 and 5')->count();
        $countAge610 = Citizens::whereRaw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 6 and 10')->count();
        $countAge1119 = Citizens::whereRaw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 11 and 19')->count();
        $countAge2057 = Citizens::whereRaw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 20 and 57')->count();
        $countAge58 = Citizens::whereRaw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 58 and 120')->count();

        $religions = Citizens::groupBy('religion')->get();
        // $religionCounts = Citizens::groupBy('religion')->count();
        
        //group all religion then counts:
        $religionCounts = DB::table('citizens')
        ->select('religion', DB::raw('count(*) as total'))
        ->groupBy('religion')
        ->pluck('total','religion');

        // dd($religionCounts);

        //count marriage
        $marriage = Citizens::groupBy('marriage')->get();
        $countMarriage = DB::table('citizens')
        ->select('marriage', DB::raw('count(*) as total'))
        ->groupBy('marriage')
        ->pluck('total','marriage');

        //count jobs
        $jobs = Citizens::groupBy('job')->get();
        $countJobs = DB::table('citizens')
        ->select('job', DB::raw('count(*) as total'))
        ->groupBy('job')
        ->pluck('total','job');
     

        //count education
        $educations = Citizens::groupBy('last_education')->get();
        $countEducations = DB::table('citizens')
        ->select('last_education', DB::raw('count(*) as total'))
        ->groupBy('last_education')
        ->pluck('total','last_education');

        //count disability
        $disability = Citizens::groupBy('disability')->get();
        $countDisability = DB::table('citizens')
        ->select('disability', DB::raw('count(*) as total'))
        ->groupBy('disability')
        ->pluck('total','disability');
        
        
  

        $countVaccine1Y = Citizens::where('vaccine_1','=','sudah vaksin')->count();
        $countVaccine1N = Citizens::where('vaccine_1','=','belum vaksin')->count();

        $countVaccine2Y = Citizens::where('vaccine_2','=','sudah vaksin')->count();
        $countVaccine2N = Citizens::where('vaccine_2','=','belum vaksin')->count();

        $countVaccine3Y = Citizens::where('vaccine_3','=','sudah vaksin')->count();
        $countVaccine3N = Citizens::where('vaccine_3','=','belum vaksin')->count();

        $disability = Citizens::groupBy('disability')->get();
        $disabilityCounts = Citizens::groupBy('disability')->count();
        
        

        return view('dashboard', compact(
            'informations',
            'countCitizens',
            'countKK',
            'countMove',
            'countDtks',
            'countDeath',
            'countCitizensMen',
            'countCitizensWomen',
            'countAge05',
            'countAge610',
            'countAge1119',
            'countAge2057',
            'countAge58',
            'religions',
            'religionCounts',
            'jobs',
            'countJobs',
            'educations',
            'countEducations',
            'disability',
            'countDisability',
            'marriage',
            'countMarriage',
            'countVaccine1Y',
            'countVaccine1N',
            'countVaccine2Y',
            'countVaccine2N',
            'countVaccine3Y',
            'countVaccine3N',
            'disability',
            'disabilityCounts',
            )
        );

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
