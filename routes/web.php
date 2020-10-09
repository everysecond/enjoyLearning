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

Route::get('login', function () {
    return view('login');
})->name('登录页');

Route::middleware(['jwt.check.auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('首页');
});

