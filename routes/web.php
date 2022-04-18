<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/laravel', function() {
    return view('laravel');
})->name('laravel');

Route::get('/relatorios', function() {
    return view('app.relatorios.relatorios');
})->name('relatorios')->middleware('auth');

Route::get('/relatorios/exportacao/{id}/{extensao}', 'App\Http\Controllers\RelatorioController@exportacao')->middleware('auth');

Route::get('/relatorios/pdf/{id}', 'App\Http\Controllers\RelatorioController@exportacaoPdf')->middleware('auth');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    // $user->token
});

//Login com Google
Route::get('google/login', [App\Http\Controllers\GoogleController::class, 'loginWithGoogle']);
Route::any('google/callback', [App\Http\Controllers\GoogleController::class, 'callbackFromGoogle']);







