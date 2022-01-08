<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->name('home');

Route::get('/',function(){
    return json_encode("REST Back-end Challenge 20201209 Running");
})->name('home');
Route::get('/users','PatientController@index')->name('users');
Route::get('/users/{id}','PatientController@show')->name('users.byId');
Route::put('/users/{id}','PatientController@update')->name('users.update');
Route::delete('/users/delete/{id}','PatientController@destroy')->name('user.destroy');