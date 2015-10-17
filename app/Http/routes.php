<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth controllers
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//Calendario
Route::get('/', 'SuimaqController@calendario');
Route::get('/inicio', 'SuimaqController@calendario');
Route::get('/calendarFeed', 'SuimaqController@calendarFeed');
Route::get('/externalEventsFeed', 'SuimaqController@calendarExternalFeed');
Route::get('/requestIncidenceDetails', 'SuimaqController@fetchIncidenceDetails');
Route::post('/programarIncidence', 'SuimaqController@programarIncidence');
Route::post('/toggleIncidence', 'SuimaqController@toggleIncidence');
Route::post('/desprogramarIncidence', 'SuimaqController@desprogramarIncidence');

//Clientes
Route::get('/clientes', 'SuimaqController@clientes');
Route::get('/clientes/nuevo', 'SuimaqController@clientesNuevo');
Route::get('/clientes/ver', 'SuimaqController@fichaCliente');
Route::get('/clientes/editar', 'SuimaqController@fichaCliente');
Route::get('/clientes/historial', 'SuimaqController@clientesHistorial');
Route::get('/clientes/buscar', 'SuimaqController@searchCustomerByName');
Route::post('/clientes/buscar', 'SuimaqController@searchCustomerByName');
Route::post('/clientes/nuevo', 'SuimaqController@newCustomer');
Route::post('/clientes/editar', 'SuimaqController@editCustomer');
Route::post('/clientes/eliminar', 'SuimaqController@deleteCustomer');

//Máquinas
Route::get('/clientes/maquinas', 'SuimaqController@maquinas');
Route::get('/clientes/maquinas/nueva', 'SuimaqController@maquinasNueva');
Route::get('/clientes/maquinas/ver', 'SuimaqController@fichaMaquina');
Route::get('/clientes/maquinas/editar', 'SuimaqController@fichaMaquina');
Route::get('/clientes/maquinas/historial', 'SuimaqController@maquinasHistorial');
Route::get('/clientes/maquinas/buscar', 'SuimaqController@searchMaquinas');
Route::post('/clientes/maquinas/buscar', 'SuimaqController@searchMaquinas');
Route::post('/clientes/maquinas/nueva', 'SuimaqController@newMachine');
Route::post('/clientes/maquinas/editar', 'SuimaqController@editMachine');
Route::post('/clientes/maquinas/eliminar', 'SuimaqController@deleteMachine');
Route::post('/clientes/maquinas/fillStepsDropdown', 'SuimaqController@fillSteps');

//Piezas
Route::get('/clientes/maquinas/piezas', 'SuimaqController@piezas');
Route::get('/clientes/maquinas/piezas/nueva', 'SuimaqController@piezaNueva');
Route::get('/clientes/maquinas/piezas/editar', 'SuimaqController@fichaPieza');
Route::post('/clientes/maquinas/piezas/nueva', 'SuimaqController@newPieza');
Route::post('/clientes/maquinas/piezas/editar', 'SuimaqController@editPieza');
Route::post('/clientes/maquinas/piezas/eliminar', 'SuimaqController@deletePieza');

// Intervenciones:
Route::get('/intervenciones', 'SuimaqController@intervenciones');
//// Patrones de intervención
Route::get('/intervenciones/patrones/nuevo', 'SuimaqController@patronesNuevo');
Route::get('/intervenciones/patrones/editar', 'SuimaqController@patronesEditar');
Route::post('/intervenciones/patrones/nuevo', 'SuimaqController@newPattern');
Route::post('/intervenciones/patrones/editar', 'SuimaqController@editPattern');
Route::post('/intervenciones/patrones/eliminar', 'SuimaqController@deletePattern');
//// Tipos de intervención
Route::get('/intervenciones/tipos/nuevo', 'SuimaqController@tiposNuevo');
Route::get('/intervenciones/tipos/editar', 'SuimaqController@tiposEditar');
Route::post('/intervenciones/tipos/nuevo', 'SuimaqController@newType');
Route::post('/intervenciones/tipos/editar', 'SuimaqController@editType');
Route::post('/intervenciones/tipos/eliminar', 'SuimaqController@deleteType');

//Incidencias
Route::get('/incidencias', 'SuimaqController@incidencias');
Route::get('/incidencias/nueva', 'SuimaqController@incidenciasNueva');
Route::get('/incidencias/editar', 'SuimaqController@fichaIncidencia');
Route::get('/incidencias/ver', 'SuimaqController@fichaIncidencia');
Route::post('/incidencias/nueva', 'SuimaqController@newIncidence');
Route::post('/incidencias/editar', 'SuimaqController@editIncidence');
Route::post('/incidencias/eliminar', 'SuimaqController@deleteIncidence');
Route::post('/incidencias/fillMaquinasDropdown', 'SuimaqController@fillMaquinas');
Route::post('/incidencias/updateOF', 'SuimaqController@updateOF');
Route::post('/incidencias/updateMaterial', 'SuimaqController@updateMaterial');
