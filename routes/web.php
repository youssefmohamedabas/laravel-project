<?php

use App\Http\Controllers\Auth\Custauth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CrudCntroller;
use App\Http\Controllers\offercontroller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', function () {
    return view(view:'welcome');
});

Route::get('/',function(){
    return view(view:'welcome');
});
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('/home', function () {
    return 'Welcome to the home page!';
});
//Route::get('fillable', [CrudCntroller::class, 'getOffers']);
/////// ajax route
Route::prefix('ajax')->group(function() {
   Route::get('create',[offercontroller::class,'create']); 
   Route::post('store',[offercontroller::class,'store'])->name('offer.storee');
   Route::get('edit/{offerid}', [offercontroller::class, 'edit'])->name('ajax.edit');
   Route::post('update', [offercontroller::class, 'update'])->name('ajax.update');
   Route::get('all', [offercontroller::class, 'getOffers'])->name('ajax.all');
   Route::post('all', [offercontroller::class, 'delete'])->name('ajax.delete');
});
/////without ajax 
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('youtube',[CrudCntroller::class,'getvideo'])->middleware('auth');
    Route::prefix('offer')->group(function () {
        // Routes within the group
        Route::post('store', [CrudCntroller::class, 'store'])->name('offer.store');
        Route::get('create', [CrudCntroller::class, 'create']);
        Route::get('all', [CrudCntroller::class, 'getOffers'])->name('all')->middleware('auth');
        Route::get('edit/{offerid}',[CrudCntroller::class,'edit'])->name('offeredit');
        Route::get('delete/{offerid}',[CrudCntroller::class,'delete'])->name('offerdelete');
        Route::post('update/{offerid}',[CrudCntroller::class,'updateoffer'])->name('updateoffer');
    });

Route::get('adalts',[Custauth::class,'adalts'])->name('adalt')->middleware('checkage');

Route::get('homeuser',[Custauth::class,'usersite'])->name('homeuser')->middleware('auth:web');
Route::get('homeadmin',[Custauth::class,'admin'])->name('homeadmin')->middleware('auth:admin');
Route::post('homeadminlog',[Custauth::class,'adminlogcheck'])->name('homeadminlog');
Route::get('homeadminlog',[Custauth::class,'adminlog'])->name('homeadminlogg');
Route::get('homeadminreg',[Custauth::class,'adminreg'])->name('homeadminreg');
Route::get('hospital-has-many',[Custauth::class,'getHospitalDoctors']);
Route::get('hospitals',[Custauth::class,'hospitals']);
Route::get('doctors/{hospital_id}',[Custauth::class,'doctors'])->name('passid');
Route::get('doctorss/{hospitall_id}',[Custauth::class,'deletehospital'])->name('deleteid');

Route::get('hospitals_has_doctors',[Custauth::class,'hospitals_has_doctor']);
Route::get('hospitals_has_doctors_male',[Custauth::class,'hospitals_has_male']);
Route::get('hospitals_doesnthave',[Custauth::class,'hospitals_doesnthave']);
});