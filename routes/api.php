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
});

/**
 * O prefixo 'v1' indica a versão da API, caso seja feita uma atualização substancial, através desse versionamento é possível que aplicações antigas que utilizem a API consigam continuar utilizando
*/
Route::prefix('v1')->middleware('jwt.auth')->group( function() {
    Route::post('me', 'App\Http\Controllers\AuthController@me'); // A rota 'me' precisa executar o meedleware jwt.auth
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('relatorio', 'App\Http\Controllers\RelatorioController');
});

 // Autenticação
 Route::post('login', 'App\Http\Controllers\AuthController@login');

 Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

