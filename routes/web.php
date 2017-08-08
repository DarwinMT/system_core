<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});*/
/*-----------------Inicio--------------*/
Route::resource('/', 'Start\Start');

Route::resource('Login', 'Start\Start');
Route::get('logout_system', 'Start\Start@logout_system_core');
/*-----------------Inicio--------------*/
/*-----------------Main--------------*/
Route::resource('Main', 'Start\Main');
/*-----------------Main--------------*/

/*-----------------Usuario--------------*/
Route::resource('User', 'Usuario\Usuario');

