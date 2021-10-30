<?php

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


