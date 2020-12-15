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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/VosEvenement', 'InscritController@user_inscrit');

Route::get('/ListeInscrit', 'InscritController@show');

Route::get('/ListeUser', 'InscritController@show_user');


Route::view('/recherche','recherche');
Route::get('/recherche', 'EventController@list');

Route::view('/newEvent','event/newEvent')->middleware(['auth','authAdmin']);
Route::post("/newEvent",'EventController@store');

Route::get("/event/{event}",'EventController@show');//->middleware('auth');
Route::get("/event/{event}/EditEvent",'EventController@edit');
Route::post("/event/{event}/inscription",'InscritController@inscription');
Route::patch("/event/{event}","EventController@update");
Route::delete("/event/{event}","EventController@destroy");//->middleware('auth');
Route::delete("/event/{event}/{inscrit}","InscritController@destroy");






