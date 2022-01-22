<?php

use App\Http\Controllers\CreateUser;
use Illuminate\Http\Request;
use App\Http\Controllers\EnSysController;
use App\Http\Controllers\EnTechController;
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
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
Route::get('/galeriees', [\App\Http\Controllers\FrontEndController:: class, 'galeriees'])->name('gales');
Route::get('/energiesysteme', [\App\Http\Controllers\FrontEndController:: class, 'energiesysteme'])->name('es');
Route::get('/impressum', [\App\Http\Controllers\FrontEndController:: class, 'impressum'])->name('impressum');
Route::get('/dsgvo', [\App\Http\Controllers\FrontEndController:: class, 'dsgvo'])->name('dsgvo');
Route::get('/addes', [\App\Http\Controllers\FrontEndController:: class, 'addes'])->name('addes');

//Route::get('/galerieES/{id}',[\App\Http\Controllers\FrontEndController:: class, 'show']);

//Route::get('/registerpage', [App\Http\Controllers\HomeController::class, 'index'])->name('registerpage');

/* Test Seite */


/*Route::get('/test', [\App\Http\Controllers\FrontEndController:: class, 'test'])->name('es'); */

    

Auth::routes();



Route::resource('EnSys', FrontEndController::class); // Route zu Frontend Controller
Route::resource('EnSys', EnSysController::class); // Route zu Energiesystem Controller
Route::resource('EnTech', EnTechController::class); // Route zu Energietechnologie gemeinsamkeiten Controller

Route::middleware(['auth', 'role:admin'])->group(function () {
    // User is authentication and has admin role

});

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


Route::get('/delete/{id}',[EnSysController::class, 'destroy']);
Route::get('/edit/{id}',[EnSysController::class, 'edit']);


Route::get('/editET/{id}',[EnTechController::class, 'edit']);
Route::get('/deleteET/{id}',[EnTechController::class, 'destroy']);

//Umwandeln der Adresse in Koordinaten
Route::get('/mapsLocation',function(Request $request)
{
	$address			=	$request['address'];
	$address			=	str_replace(array('ä','ü','ö','ß'), array('ae', 'ue', 'oe', 'ss'), $address );
	$address			=	preg_replace("/[^a-zA-Z0-9\_\s]/", "", $address);
	$address			=	strtolower($address);
	$address			=	str_replace( array(' ', '--'), array('-', '-'), $address );						
	$address			=	'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=AIzaSyDboUvk9ElphosPEFC-Am9XzHFsmnOZR7I';
				
	$json				=	file_get_contents($address);
	$obj				=	json_decode($json);	
											
	$datas['lat']		=	$obj->results[0]->geometry->location->lat;
	$datas['lng']		=	$obj->results[0]->geometry->location->lng;
		
	echo json_encode( $datas );
});


Route::post('createnewuser',[CreateUser::class, 'createUser'])->name('createnewuser');
Route::get('/deleteuser/{id}',[CreateUser::class, 'destroy'])->name('destroyuser');



Route::get('/Registerpage', function () {

			if(empty(Auth::user()->role)){
				return view('HomePage');
			}
				else{
					if (Auth::user()->role == "Admin") {
						$users = DB::table('users')->get();
						return view('Registerpage', compact('users'));
					}
				}
		})->name('Registerpage');

	





Route::get('/home', function () {
	if(empty(Auth::user()->role)){
		return redirect('/');
	}
		else{
			if (Auth::user()->role == "Admin") {
				return view('home');
			} else {
				return view('HomePage');
			}
		}
});


//Route::redirect('/login', '/');
Route::redirect('/register', '/');






