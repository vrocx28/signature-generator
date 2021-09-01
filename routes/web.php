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
Route::get('/login', 'SignatureController@adminLoginForm')->name('login');
Route::post('/login-post', 'SignatureController@adminPost')->name('login-post');
Route::group(['prefix' => '/', 'middleware' => 'admin'], function () {
    Route::get('/signature', 'SignatureController@signatureForm')->name('signature');
    Route::post('/data-post', 'SignatureController@signaturePost')->name('data-post');
    Route::get('/logout', 'SignatureController@logout')->name('logout');
});

Route::get('forget-password', function () {return view('forgotpassword'); });
Route::post('forget-password-post',  'SignatureController@ForgetPasswordPost')->name('forget-password-post'); 
Route::get('reset-password/{token}', 'SignatureController@ResetPasswordForm')->name('reset-password');
Route::post('reset-password-post', 'SignatureController@ResetPasswordPost')->name('reset-password-post');