<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Masters\AgeRangeController;
use App\Http\Controllers\Transactions\CitizenController;
use App\Http\Controllers\HomeController;
use App\Models\Masters\ageRange;
use App\Http\Controllers\Transactions\Letter\LetterController;

use App\Http\Controllers\Transactions\Letter\LetterBusinessController;
use App\Http\Controllers\Transactions\Letter\LetterNotMarriedYetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->middleware('auth');


//jika penggunaan resource, path harus lengkap
Route::resource("profiles", "App\Http\Controllers\ProfileController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("citizens", "App\Http\Controllers\Transactions\CitizenController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("users", "App\Http\Controllers\UserController")->middleware('auth');
Route::get("/users/{users:uuid}/edit/password", [UserController::class, 'changePassword'])->name('users.changePassword')->middleware('auth');

Route::get("/citizens/{citizens:uuid}/show", [CitizenController::class, 'showKK'])->name('citizens.view')->middleware('auth');

Route::resource("rw", "App\Http\Controllers\Masters\RWController")->middleware('auth');

//jika penggunaan resource, path harus lengkap
Route::resource("rt", "App\Http\Controllers\Masters\RTController")->middleware('auth');

Route::resource("ims", "App\Http\Controllers\Masters\ImmunizationController")->middleware('auth');

Route::resource("kb", "App\Http\Controllers\Masters\KBController")->middleware('auth');

Route::resource('information', "App\Http\Controllers\Masters\InformationController")->middleware('auth');

Route::resource("assistance", "App\Http\Controllers\Masters\AssistanceController")->middleware('auth');

Route::resource('log', LogController::class)->middleware('auth');

Route::resource('agerange', "App\Http\Controllers\Masters\AgeRangeController")->middleware('auth');
// Route::resource('ageRange', AgeRangeController::class)->middleware('auth');


Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('citizens-export', [CitizenController::class, 'export'])->name('citizens.export');

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index')->name('users.index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

//export route
Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportCitizen", "App\Http\Controllers\Transactions\CitizenController@exportCitizen")->name('exportCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportFamilyCitizen", "App\Http\Controllers\Transactions\CitizenController@exportFamilyCitizen")->name('exportFamilyCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportMoveCitizen", "App\Http\Controllers\Transactions\CitizenController@exportMoveCitizen")->name('exportMoveCitizen');
});

Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportDeathCitizen", "App\Http\Controllers\Transactions\CitizenController@exportDeathCitizen")->name('exportDeathCitizen');
});


Route::prefix('export')->name('export.')->group(function () {
    Route::get("exportDTKSCitizen", "App\Http\Controllers\Transactions\CitizenController@exportDtksCitizen")->name('exportDtksCitizen');
});

//import route
Route::post('/citizens/import', 'App\Http\Controllers\Transactions\CitizenController@importCitizen')->name('citizens.import');
// Route::get('/citizens/{citizens:uuid}', [CitizenController::class, 'deathCheck'])->middleware('auth');

Route::get('/family',[CitizenController::class, 'familyCitizens'])->middleware('auth');


Route::get('/dtks',[CitizenController::class, 'citizendtks'])->middleware('auth');
Route::get('/dtks/{citizens:uuid}', [CitizenController::class, 'rollBackDtks'])->middleware('auth');

Route::get('/move',[CitizenController::class, 'moveCitizens'])->middleware('auth');
Route::get('/move/{citizens:uuid}', [CitizenController::class, 'rollBackMoveDate'])->middleware('auth');
// Route::get('/citizens/{citizens:uuid}', [CitizenController::class, 'moveUpdateCitizen'])->name('citizens.moveUpdateCitizen')->middleware('auth');
// Route::post('/citizens/{citizens:uuid}', 'App\Http\Controllers\Transactions\CitizenController@moveUpdateCitizen')->name('citizens.moveUpdateCitizen');

Route::get('/death',[CitizenController::class, 'deathCitizens'])->middleware('auth');
Route::get('/death/{citizens:uuid}', [CitizenController::class, 'rollBackDeathDate'])->middleware('auth');


// Route::get('/ageRange',[AgeRangeController::class, 'index'])->middleware('auth');

//letters
Route::resource("letters", "App\Http\Controllers\Transactions\Letter\LetterController")->middleware('auth');

//letterspension

Route::get("/letters-citizens", [LetterController::class, 'indexcitizen'])->middleware('auth');
Route::get("list", [LetterController::class, 'list'])->middleware('auth');
Route::get("approve/{uid}", [LetterController::class, 'approve'])->name('approve.letters');


//approveletters
Route::get("/approve/letters/{uid}", [LetterController::class, 'approve'])->name('approve.datas');
//businessletters
Route::resource("letters-business", "App\Http\Controllers\Transactions\Letter\LetterBusinessController")->middleware('auth');
Route::get("approve/business-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterBusinessController@approve")->name('approve.businessletters');

//holidayletters
Route::resource("letters-holiday", "App\Http\Controllers\Transactions\Letter\LetterHolidayController")->middleware('auth');
Route::get("approve/holiday-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterHolidayController@approve")->name('approve.holidayletters');

//no act letters
Route::resource("letters-noact", "App\Http\Controllers\Transactions\Letter\LetterNoActController")->middleware('auth');
Route::get("approve/noact-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterNoActController@approve")->name('approve.noactletters');

//process act letters
Route::resource("letters-processact", "App\Http\Controllers\Transactions\Letter\LetterProcessActController")->middleware('auth');
Route::get("approve/processact-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterProcessActController@approve")->name('approve.processactletters');

//widowletters
Route::resource("letters-widow", "App\Http\Controllers\Transactions\Letter\LetterwidowController")->middleware('auth');
Route::get("approve/widow-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterWidowController@approve")->name('approve.widowletters');

//recomendationletters
Route::resource("letters-recomendation", "App\Http\Controllers\Transactions\Letter\LetterRecomendationController")->middleware('auth');
Route::get("approve/recomendation-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterRecomendationController@approve")->name('approve.businessletters');

//pensionletter
Route::resource("letters-pension", "App\Http\Controllers\Transactions\Letter\LetterPensionController")->middleware('auth');
Route::get("approve/pension-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterPensionController@approve")->name('approve.businessletters');


//divorceletter
Route::resource("letters-divorce", "App\Http\Controllers\Transactions\Letter\LetterDivorceController")->middleware('auth');
Route::get("approve/divorce-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterDivorceController@approve")->name('approve.businessletters');

//rekomendasi kerja
Route::resource("letters-job", "App\Http\Controllers\Transactions\Letter\LetterRecomendationWorkController")->middleware('auth');
Route::get("approve/job-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterRecomendationWorkController@approve")->name('approve.businessletters');

//surat ramai
Route::resource("letters-crowd", "App\Http\Controllers\Transactions\Letter\LetterRecomendationCrowdController")->middleware('auth');
Route::get("approve/crowd-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterRecomendationCrowdController@approve")->name('approve.businessletters');

//buildingletter
Route::resource("letters-building", "App\Http\Controllers\Transactions\Letter\LetterBuildingController")->middleware('auth');
Route::get("approve/building-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterBuildingController@approve")->name('approve.businessletters');

// bukan bpjs
Route::resource("letters-not-bpjs", "App\Http\Controllers\Transactions\Letter\LetterNotBPJSController")->middleware('auth');

//birthLetter
Route::resource("letters-birth", "App\Http\Controllers\Transactions\Letter\LetterBirthController")->middleware('auth');

// belum menikah
Route::resource("letters-not-married-yet", "App\Http\Controllers\Transactions\Letter\LetterNotMarriedYetController")->middleware('auth');

// keterangan kematian
Route::resource('letters-death', "App\Http\Controllers\Transactions\Letter\LetterDeathController")->middleware('auth');
Route::get("approve/birth-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterBirthController@approve")->name('auth');

//noHouseLetter
Route::resource("letters-nohouse", "App\Http\Controllers\Transactions\Letter\LetterNoHouseController")->middleware('auth');
Route::get("approve/nohouse-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterNoHouseController@approve")->name('auth');

//poorLetter ( miskin )
Route::resource("letters-poor", "App\Http\Controllers\Transactions\Letter\LetterPoorController")->middleware('auth');
Route::get("approve/poor-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterPoorController@approve")->name('auth');

//NeedyLetter ( kurang mampu )
Route::resource("letters-needy", "App\Http\Controllers\Transactions\Letter\LetterNeedyController")->middleware('auth');
Route::get("approve/needy-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterNeedyController@approve")->name('auth');

//domicileLetter
Route::resource("letters-domicile", "App\Http\Controllers\Transactions\Letter\LetterDomicileController")->middleware('auth');
Route::get("approve/domicile-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterDomicileController@approve")->name('auth');

//familyCardLetter
Route::resource("letters-familycard", "App\Http\Controllers\Transactions\Letter\LetterFamilyCardController")->middleware('auth');
Route::get("approve/familycard-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterFamilyCardController@approve")->name('auth');

// Surat Penghapusan Biodata Penduduk
Route::resource("letters-removecitizen", "App\Http\Controllers\Transactions\Letter\LetterRemoveCitizenController")->middleware('auth');
Route::get("approve/removecitizen-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterRemoveCitizenController@approve")->name('auth');

// Surat Keterangan Karantina Mandiri
Route::resource("letters-selfquarantine", "App\Http\Controllers\Transactions\Letter\LetterSelfQuarantineController")->middleware('auth');
Route::get("approve/selfquarantine-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterSelfQuarantineController@approve")->name('auth');

// Letter crowd
Route::resource("letters-crowd", "App\Http\Controllers\Transactions\Letter\LetterCrowdController")->middleware('auth');
Route::get("approve/crowd-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterCrowdController@approve")->name('auth');

// Letter tax
Route::resource("letters-tax", "App\Http\Controllers\Transactions\Letter\LetterTaxController")->middleware('auth');
Route::get("approve/tax-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterTaxController@approve")->name('auth');

// Surat Keterangan Beda Tanggal Lahir
Route::resource("letters-differencebirth", "App\Http\Controllers\Transactions\Letter\LetterDifferenceBirthController")->middleware('auth');
Route::get("approve/selfquarantine-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterDifferenceBirthController@approve")->name('auth');

// Surat Keterangan Ghoib
Route::resource("letters-magic", "App\Http\Controllers\Transactions\Letter\LetterMagicController")->middleware('auth');
Route::get("approve/magic-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterMagicController@approve")->name('auth');

// Surat keterangan Hilang
Route::resource("letters-missing", "App\Http\Controllers\Transactions\Letter\LetterMissingController")->middleware('auth');
Route::get("approve/missing-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterMissingController@approve")->name('auth');

// Surat Keterangan Pernyataan
Route::resource("letters-move", "App\Http\Controllers\Transactions\Letter\LetterMoveController")->middleware('auth');
Route::get("approve/move-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterMoveController@approve")->name('auth');

// Surat Keterangan Pindah
Route::resource("letters-movecitizen", "App\Http\Controllers\Transactions\Letter\LetterMoveCitizenController")->middleware('auth');
Route::get("approve/movecitizen-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterMoveCitizenController@approve")->name('auth');

// Surat Keterangan KTP Dalam Proses
Route::resource("letters-processktp", "App\Http\Controllers\Transactions\Letter\LetterProcessKtpController")->middleware('auth');
Route::get("approve/processktp-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterProcessKtpController@approve")->name('auth');

// Surat Keterangan Dispensasi SPP kuliah
Route::resource("letters-collegedispensation", "App\Http\Controllers\Transactions\Letter\LetterCollegeDispensationController")->middleware('auth');
Route::get("approve/collegedispensation-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterCollegeDispensationController@approve")->name('auth');

//landOwneshipLetter
Route::resource("letters-landownership", "App\Http\Controllers\Transactions\Letter\LetterLandOwnershipController")->middleware('auth');
Route::get("approve/landownership-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterLandOwnershipController@approve")->name('auth');

//inheritanceLetter
Route::resource("letters-inheritance", "App\Http\Controllers\Transactions\Letter\LetterInheritanceController")->middleware('auth');
Route::get("approve/inheritance-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterInheritanceController@approve")->name('auth');

// Surat Keterangan Beda Nama
Route::resource("letters-difference-name", "App\Http\Controllers\Transactions\Letter\LetterDifferenceNameController")->middleware('auth');
Route::get("approve/collegedispensation-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterDifferenceNameController@approve")->name('auth');

// Surat Keterangan Jalan
Route::resource("letters-street", "App\Http\Controllers\Transactions\Letter\LetterStreetController")->middleware('auth');
Route::get("approve/street-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterStreetController@approve")->name('auth');

// Surat Keterangan Jalan Barang
Route::resource("letters-streetgoods", "App\Http\Controllers\Transactions\Letter\LetterStreetGoodsController")->middleware('auth');
Route::get("approve/streetgoods-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterStreetGoodsController@approve")->name('auth');

// Surat Keterangan Rujuk/Cerai
Route::resource("letters-unite", "App\Http\Controllers\Transactions\Letter\LetterUniteController")->middleware('auth');
Route::get("approve/unite-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterUniteController@approve")->name('auth');

// Surat Keterangan Penghasilan
Route::resource("letters-income", "App\Http\Controllers\Transactions\Letter\LetterIncomeController")->middleware('auth');
Route::get("approve/income-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterIncomeController@approve")->name('auth');

// Surat Keterangan jalan Citizen
Route::resource("letters-citizen", "App\Http\Controllers\Transactions\Letter\LetterStreetCitizenController")->middleware('auth');
Route::get("approve/citizen-letters/{uid}", "App\Http\Controllers\Transactions\Letter\LetterStreetCitizenController@approve")->name('auth');
// Surat Keterangan Jual Beli Tanah
Route::resource("letters-land-transaction", "App\Http\Controllers\Transactions\Letter\LetterLandTransactionController")->middleware('auth');

//surat menikah
Route::resource("letters-marriage", "App\Http\Controllers\Transactions\Letter\LetterMarriageController")->middleware('auth');
Route::get("approve/letters-marriage/{uid}", "App\Http\Controllers\Transactions\Letter\LetterMarriageController@approve")->name('approve.businessletters');
