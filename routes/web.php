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
Route::get('User/get_list_usuario_excell/{texto}', 'Usuario\Usuario@get_list_usuario_excell');
Route::get('User/valida_dni/{texto}', 'Usuario\Usuario@valida_dni');
Route::get('User/save_chage_user/{texto}', 'Usuario\Usuario@save_chage_user');
Route::get('User/valida_user/{texto}', 'Usuario\Usuario@valida_user');
Route::get('User/estado/{texto}', 'Usuario\Usuario@modify_estado');
Route::post('User/update_user/{id}', 'Usuario\Usuario@update_user');
Route::get('User/get_list_usuario', 'Usuario\Usuario@get_list_usuario');
Route::resource('User', 'Usuario\Usuario');
	/*-----------------Permisos de Usuario--------------*/
	Route::get('Access/get_list_rol', 'Usuario\PermisosController@get_list_rol');
	Route::get('Access/get_list_menu', 'Usuario\PermisosController@get_list_menu');
	Route::resource('Access', 'Usuario\PermisosController');
	/*-----------------Permisos de Usuario--------------*/

/*-----------------Usuario--------------*/

/*-----------------Roles Usuario--------------*/
Route::get('Roles/estado/{texto}', 'Usuario\RolController@modify_estado');
Route::get('Roles/get_list_roles_excell/{texto}', 'Usuario\RolController@get_list_roles_excell');
Route::get('Roles/get_list_roles', 'Usuario\RolController@get_list_roles');
Route::resource('Roles', 'Usuario\RolController');
/*-----------------Roles Usuario--------------*/