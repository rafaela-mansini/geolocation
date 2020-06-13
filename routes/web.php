<?php

Route::namespace('Application')->group(function(){
    Route::get('/', function() {
        return view('application.index');
    });
});
