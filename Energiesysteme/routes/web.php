<?php

use App\Http\Controllers\EnSysController;
use App\Http\Controllers\EtAdAbKmController;
use App\Http\Controllers\EtBhKwController;
use App\Http\Controllers\EtBmHkController;
use App\Http\Controllers\EtBmHwController;
use App\Http\Controllers\EtBsController;
use App\Http\Controllers\EtBsZController;
use App\Http\Controllers\EtElController;
use App\Http\Controllers\EtGKbZController;
use App\Http\Controllers\EtGWbZController;
use App\Http\Controllers\EtHaZController;
use App\Http\Controllers\EtKkMController;
use App\Http\Controllers\EtKsController;
use App\Http\Controllers\EtPvController;
use App\Http\Controllers\EtSnBController;
use App\Http\Controllers\EtSthController;
use App\Http\Controllers\EtWeController;
use App\Http\Controllers\EtWesController;
use App\Http\Controllers\EtWkAController;
use App\Http\Controllers\EtWnBController;
use App\Http\Controllers\EtWpController;
use App\Http\Controllers\EtWsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\FrontEndController:: class, 'index'])->name('hp');
Route::get('/galerie', [\App\Http\Controllers\FrontEndController:: class, 'galerie'])->name('gal');
Route::get('/energiesysteme', [\App\Http\Controllers\FrontEndController:: class, 'energiesysteme'])->name('es');
Route::get('/impressum', [\App\Http\Controllers\FrontEndController:: class, 'impressum'])->name('impressum');
Route::get('/dsgvo', [\App\Http\Controllers\FrontEndController:: class, 'dsgvo'])->name('dsgvo');

Route::get('/test', function () {
    return view('responsivtest');
});
    

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('EnSys', EnSysController::class); // Route zu Energiesystem Controller
Route::resource('EnTech', EnTechController::class); // Route zu Energietechnologie gemeinsamkeiten Controller



// Route für die einzelnen Energiesysteme
Route::resource('EtPv', EtPvController::class);
Route::resource('EtSnB',EtSnBController::class);
Route::resource('EtBs',EtBsController::class);
Route::resource('EtWe',EtWeController::class);
Route::resource('EtBsZ',EtBsZController::class);
Route::resource('EtWs',EtWsController::class);
Route::resource('EtWkA',EtWkAController::class);
Route::resource('EtEl',EtElController::class);
Route::resource('EtHaZ',EtHaZController::class);
Route::resource('EtWnB',EtWnBController::class);
Route::resource('EtBhKw',EtBhKwController::class);
Route::resource('EtBmHw',EtBmHwController::class);
Route::resource('EtBmHk',EtBmHkController::class);
Route::resource('EtWes',EtWesController::class);
Route::resource('EtSth',EtSthController::class);
Route::resource('EtWp',EtWpController::class);
Route::resource('EtGWbZ',EtGWbZController::class);
Route::resource('EtKkM',EtKkMController::class);
Route::resource('EtAdAb',EtAdAbKmController::class);
Route::resource('EtKs',EtKsController::class);
Route::resource('EtGKbZ',EtGKbZController::class);
