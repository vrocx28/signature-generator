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
Route::get('/admin', 'SignatureController@admin')->name('admin');
Route::post('/admin-post', 'SignatureController@adminPost')->name('admin-post');
Route::group(['prefix' => '/', 'middleware' => 'admin'], function () {
    Route::get('/signature', 'SignatureController@signature')->name('signature');
    Route::post('/data-post', 'SignatureController@signaturePost')->name('data-post');
    Route::get('/logout', 'SignatureController@logout')->name('logout');
});
