<?php

use App\Http\Controllers\LogPermitServicePrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('landing-page.index');

/* Izin Pelayanan */
Route::get('permit-service', function () {

    return view('landing-page.permit-service');
})->name('permit-service.index');

/* Kouta Pelayanan */
Route::get('/slot-services', fn() => view('landing-page.slot-services'))->name('slot-services.index');

Route::get('/log-permit-services/print', 
    [LogPermitServicePrintController::class, 'print']
)->name('log-permit-services.print');
