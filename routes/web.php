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

Route::post('login','LoginController@login')->name('登录');
Route::post('logout','LoginController@logout')->name('登出');



Route::middleware(['jwt.auth'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('首页');
});

