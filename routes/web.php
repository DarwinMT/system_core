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
Route::get('User/addusuariofromempleado/{texto}', 'Usuario\Usuario@addusuariofromempleado');
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

/*-----------------Proveedor--------------*/
Route::get('Proveedor/get_list_proveedor_excell/{texto}', 'Personas\ProveedorController@get_list_proveedor_excell');
Route::get('Proveedor/estado/{texto}', 'Personas\ProveedorController@modify_estado');
Route::post('Proveedor/update_proveedor/{id}', 'Personas\ProveedorController@update_proveedor');
Route::get('Proveedor/get_list_proveedor', 'Personas\ProveedorController@get_list_proveedor');
Route::resource('Proveedor', 'Personas\ProveedorController');
/*-----------------Proveedor--------------*/

/*-----------------Empleado--------------*/
Route::get('Empleado/addempleadofromuser/{texto}', 'Personas\EmpleadoController@addempleado');
Route::get('Empleado/get_list_empleado_excell/{texto}', 'Personas\EmpleadoController@get_list_empleado_excell');
Route::get('Empleado/estado/{texto}', 'Personas\EmpleadoController@modify_estado');
Route::post('Empleado/update_empleado/{id}', 'Personas\EmpleadoController@update_empleado');
Route::get('Empleado/get_list_empleado', 'Personas\EmpleadoController@get_list_empleado');
Route::resource('Empleado', 'Personas\EmpleadoController');
/*-----------------Empleado--------------*/

/*-----------------Cliente--------------*/
Route::get('Cliente/get_list_client_excell/{texto}', 'Personas\ClienteController@get_list_client_excell');
Route::get('Cliente/estado/{texto}', 'Personas\ClienteController@modify_estado');
Route::post('Cliente/update_cliente/{id}', 'Personas\ClienteController@update_cliente');
Route::get('Cliente/get_list_cliente', 'Personas\ClienteController@get_list_cliente');
Route::resource('Cliente', 'Personas\ClienteController');
/*-----------------Cliente--------------*/

/*-----------------Cargo empleado--------------*/
Route::get('CargoE/estado/{texto}', 'Personas\CargoController@modify_estado');
Route::get('CargoE/get_list_cargos_excell/{texto}', 'Personas\CargoController@get_list_cargos_excell');
Route::get('CargoE/get_list_cargos', 'Personas\CargoController@get_list_cargos');
Route::resource('CargoE', 'Personas\CargoController');
/*-----------------Cargo empleado--------------*/


/*-----------------Logica agenda --------------*/
Route::get('Agenda/get_user_agenda', 'LSysMedico\Agenda\AgendaController@data_user_agenda');
Route::get('Agenda/estado/{texto}', 'LSysMedico\Agenda\AgendaController@modify_estado');
Route::get('Agenda/get_agenda_semana/{texto}', 'LSysMedico\Agenda\AgendaController@get_agenda_semana');
Route::get('Agenda/get_info_agenda_mensual/{texto}', 'LSysMedico\Agenda\AgendaController@get_info_agenda_mensual');
Route::get('Agenda/get_agenda_mensual/{texto}', 'LSysMedico\Agenda\AgendaController@get_agenda_mes');
Route::get('Agenda/get_horas_ocupadas_persona/{texto}', 'LSysMedico\Agenda\AgendaController@get_horas_ocupadas_persona');
Route::get('Agenda/Configuracion', 'LSysMedico\Agenda\AgendaController@get_config');
Route::resource('Agenda', 'LSysMedico\Agenda\AgendaController');
/*-----------------Logica agenda --------------*/


/*-----------------Logica CIE10 --------------*/
Route::get('Cie/get_list_cie', 'LSysMedico\HistoriaClinica\Cie10@get_list_cie');
Route::resource('Cie', 'LSysMedico\HistoriaClinica\Cie10');
/*-----------------Logica CIE10 --------------*/


/*-----------------Logica Anamnesis --------------*/
Route::get('Anamnesis/estado/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@modify_estado');
Route::get('Anamnesis/get_anamnesis_id/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@get_anamnesistoid');
Route::resource('Anamnesis', 'LSysMedico\HistoriaClinica\Anamnesis');

/*-----------------Logica Anamnesis --------------*/

/*-----------------Logica Prescripcion Medica --------------*/
Route::get('Prescripcion/get_receta_id/{texto}', 'LSysMedico\HistoriaClinica\PrescripcionMedica@get_recetaid');
Route::get('Prescripcion/get_list_vademecum', 'LSysMedico\HistoriaClinica\PrescripcionMedica@get_list_vademecum');
Route::resource('Prescripcion', 'LSysMedico\HistoriaClinica\PrescripcionMedica');
/*-----------------Logica Prescripcion Medica --------------*/