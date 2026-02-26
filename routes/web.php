<?php

use App\Http\Controllers\LogPermitServicePrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/log-permit-services/print', 
    [LogPermitServicePrintController::class, 'print']
)->name('log-permit-services.print');
