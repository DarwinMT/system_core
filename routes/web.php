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
Route::get('User/get_me', 'Usuario\Usuario@get_me');
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

	/*-----------------Datos grafico --------------*/	
	Route::get('Agenda/get_numbercitas', 'LSysMedico\Agenda\AgendaController@data_numbercitas');
	Route::get('Agenda/get_numbercitas_filtro/{texto}', 'LSysMedico\Agenda\AgendaController@data_numbercitas_filtro');
	/*-----------------Datos grafico --------------*/	

Route::get('Agenda/get_info_agenda_fechas_empleado/{texto}', 'LSysMedico\Agenda\AgendaController@get_info_agenda_fechas_empleado');
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
	/*-----------------Datos grafico --------------*/	
	Route::get('Anamnesis/get_diagnosticos_filtro/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@data_diagnosticos_filtro');
	Route::get('Anamnesis/get_enfermedadesfamiliares_filtro/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@data_enfermedadesfamiliares_filtro');
	Route::get('Anamnesis/get_enfermedadesfamiliares', 'LSysMedico\HistoriaClinica\Anamnesis@data_enfermedadesfamiliares');
	Route::get('Anamnesis/get_diagnosticos', 'LSysMedico\HistoriaClinica\Anamnesis@data_diagnosticos');
	/*-----------------Datos grafico --------------*/	

Route::get('Anamnesis/print_anamnesis/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@print_anamnesis');
Route::get('Anamnesis/estado/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@modify_estado');
Route::get('Anamnesis/get_anamnesis_id/{texto}', 'LSysMedico\HistoriaClinica\Anamnesis@get_anamnesistoid');
Route::resource('Anamnesis', 'LSysMedico\HistoriaClinica\Anamnesis');

/*-----------------Logica Anamnesis --------------*/

/*-----------------Logica Prescripcion Medica --------------*/
	/*-----------------Datos grafico --------------*/	
	Route::get('Prescripcion/get_datavademecum_filtro/{texto}', 'LSysMedico\HistoriaClinica\PrescripcionMedica@data_vademecum_filtro');
	Route::get('Prescripcion/get_datavademecum', 'LSysMedico\HistoriaClinica\PrescripcionMedica@data_vademecum');
	/*-----------------Datos grafico --------------*/	
Route::get('Prescripcion/print_receta/{texto}', 'LSysMedico\HistoriaClinica\PrescripcionMedica@print_receta');
Route::get('Prescripcion/get_receta_id/{texto}', 'LSysMedico\HistoriaClinica\PrescripcionMedica@get_recetaid');
Route::get('Prescripcion/get_list_vademecum', 'LSysMedico\HistoriaClinica\PrescripcionMedica@get_list_vademecum');
Route::resource('Prescripcion', 'LSysMedico\HistoriaClinica\PrescripcionMedica');
/*-----------------Logica Prescripcion Medica --------------*/

/*-----------------Logica Empresa --------------*/
Route::post('Company/update_empresa/{id}', 'Configuracion\EmpresaController@update_empresa');
Route::get('Company/get_infoempresa', 'Configuracion\EmpresaController@get_dataempresa');
Route::resource('Company', 'Configuracion\EmpresaController');
/*-----------------Logica Empresa --------------*/

/*-----------------Logica Ciudad --------------*/
Route::get('Ciudad/get_ciudades_all/{texto}', 'Configuracion\CiudadController@get_ciudades_all');
Route::get('Ciudad/estado/{texto}', 'Configuracion\CiudadController@modify_estado');
Route::get('Ciudad/get_list_ciudades', 'Configuracion\CiudadController@get_list_ciudades');
Route::get('Ciudad/get_ciudades/{texto}', 'Configuracion\CiudadController@get_ciudades');
Route::resource('Ciudad', 'Configuracion\CiudadController');
/*-----------------Logica Ciudad --------------*/

/*-----------------Logica Provincia --------------*/
Route::get('Provincia/get_provincias_all/{texto}', 'Configuracion\ProvinciaController@get_provincias_all');
Route::get('Provincia/estado/{texto}', 'Configuracion\ProvinciaController@modify_estado');
Route::get('Provincia/get_list_provincia', 'Configuracion\ProvinciaController@get_list_provincia');
Route::get('Provincia/get_provincias/{texto}', 'Configuracion\ProvinciaController@get_provincias');
Route::resource('Provincia', 'Configuracion\ProvinciaController');
/*-----------------Logica Provincia --------------*/

/*-----------------Logica pais --------------*/
Route::get('Pais/estado/{texto}', 'Configuracion\PaisController@modify_estado');
Route::get('Pais/get_list_pais', 'Configuracion\PaisController@get_list_pais');
Route::get('Pais/get_paises/{texto}', 'Configuracion\PaisController@get_paises');
Route::resource('Pais', 'Configuracion\PaisController');
/*-----------------Logica pais --------------*/

/*-----------------Logica vademecum --------------*/
Route::get('Vademecum/get_medicamentos/{texto}', 'Configuracion\MedicamentoController@get_medicamentos');
Route::get('Vademecum/estado/{texto}', 'Configuracion\MedicamentoController@modify_estado');
Route::get('Vademecum/get_list_vademecum', 'Configuracion\MedicamentoController@get_list_vademecum');
Route::resource('Vademecum', 'Configuracion\MedicamentoController');
/*-----------------Logica vademecum --------------*/

/*-----------------Logica historia clinica --------------*/
Route::get('Historia/get_listanamnesis_cliente_webservice/{texto}',"LSysMedico\HistoriaClinica\HistoriaClinicaController@get_list_anamnesis_id_webservice")->middleware("cors");
Route::get('Historia/get_paciente_historia_webservice/{texto}',"LSysMedico\HistoriaClinica\HistoriaClinicaController@get_pacientehistorias_id")->middleware("cors");
Route::get('Historia/get_listanamnesis_cliente', 'LSysMedico\HistoriaClinica\HistoriaClinicaController@get_list_anamnesis_id');
Route::get('Historia/get_paciente_historia', 'LSysMedico\HistoriaClinica\HistoriaClinicaController@get_pacientehistorias');
Route::resource('Historia', 'LSysMedico\HistoriaClinica\HistoriaClinicaController');
/*-----------------Logica historia clinica --------------*/

/*-----------------Logica historia odontologica --------------*/

Route::get('TratamientoOdont/get_all_tratamientos', 'LSysMedico\Odontologia\Tratamiento@get_list_tratamiento_odontologico');
Route::resource('TratamientoOdont', 'LSysMedico\Odontologia\Tratamiento');

Route::get('Odontograma/print_anamnesisodontograma/{texto}', 'LSysMedico\Odontologia\OdontogramaController@print_anamnesisodontograma');
Route::get('Odontograma/ultimo_odontograma/{texto}', 'LSysMedico\Odontologia\OdontogramaController@get_odontograma');
Route::resource('Odontograma', 'LSysMedico\Odontologia\OdontogramaController');

/*-----------------Logica historia odontologica --------------*/


/*-----------------Logica registro historia odontologica --------------*/
Route::get('RegOdontologia/get_listanamnesis_cliente_odontologia', 'LSysMedico\Registros\ReportOdontologicoController@get_list_anamnesisodontograma_id');
Route::get('RegOdontologia/get_paciente_historia_odontologica', 'LSysMedico\Registros\ReportOdontologicoController@get_pacientehistorias');
Route::resource('RegOdontologia', 'LSysMedico\Registros\ReportOdontologicoController');
/*-----------------Logica registro historia odontologica --------------*/

/*-----------------Logica prefactura proforma odontologica --------------*/
Route::get('Prefactura/registro_pagosxid/{texto}', 'LSysMedico\Odontologia\PrefacturaController@registro_pagosxid');
Route::resource('Prefactura', 'LSysMedico\Odontologia\PrefacturaController');
/*-----------------Logica prefactura proforma odontologica --------------*/