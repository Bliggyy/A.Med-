<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocVerifyController;
use App\Http\Controllers\PprofileController;
use App\Http\Controllers\DocprofileController;
use App\Http\Controllers\PrecordController;
use App\Http\Controllers\AdminController;
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

Route::get('/docHome', function() {
    return view('docHome');
});

Route::get('/admin', function() {
    return view('admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register/docverify/{id}',[DocVerifyController::class], 'index');
Route::post('/register/docverifycreate',[DocVerifyController::class,'store']);
Route::get('home',[PprofileController::class,'index']);
Route::post('pprofilecreate',[PprofileController::class,'store']);
Route::post('pprofileupdate',[PprofileController::class,'update']);
Route::get('docHome',[DocprofileController::class,'index']);
Route::post('docprofilecreate',[DocprofileController::class,'store']);
Route::post('docprofileupdate',[DocprofileController::class,'update']);
Route::post('prcreate',[PrecordController::class,'store']);
Route::post('prupdate',[PrecordController::class,'update']);
Route::get('admin',[AdminController::class,'index']);