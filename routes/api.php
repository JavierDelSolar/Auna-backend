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

//Route::get('proveedores', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@getProveedores'], 'as' => 'proveedores'); # revisar el "as" para que sirve?
Route::group([
    'middleware'=>'api',
    'namespace' => 'App\Http\Controllers',
], function($router){
    Route::group(['prefix'=>'auth'], function(){
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('user-profile', 'AuthController@userProfile');
    });
    Route::group(['prefix'=>'proveedor'], function(){
        Route::post('getProveedor', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@getProveedor']);
        Route::post('createProveedor', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@createProveedor']);
        Route::post('updateProveedor', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@updateProveedor']);

        Route::get('getDistribuidores', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@getDistribuidores']);
        Route::post('updateProveedorIsDistribuidor', ['middleware' => 'auth.role:administrador,gerente,asistente', 'uses' => 'ProveedorController@updateProveedorIsDistribuidor']);
    });
});