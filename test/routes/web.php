<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocVerifyController;
use App\Http\Controllers\PprofileController;
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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/register/docverify', function () {
    return view('docverify');
});

Route::get('pprofilecreate', function () {
    return view('home');
});

Route::get('/doctor-home', function() {
    return view('docHome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register/docverify/{id}',[DocVerifyController::class], 'index');
Route::post('/register/docverifycreate',[DocVerifyController::class,'store']);
Route::get('home',[PprofileController::class,'index']);
Route::post('pprofilecreate',[PprofileController::class,'store']);
Route::post('pprofileupdate',[PprofileController::class,'update']);