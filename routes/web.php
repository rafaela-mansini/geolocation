<?php

Route::namespace('Application')->group(function(){
    Route::get('/', function() {
        return view('application.index');
    });
    Route::get('/clientes', 'ClientsController@index');
    Route::get('/clientes/create', 'ClientsController@create');
    Route::post('/clientes', 'ClientsController@store');
    Route::post('/clientes/csv', 'ClientsController@storeCsv');
});
