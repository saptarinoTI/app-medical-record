<?php

use App\Http\Controllers\LogPermitServicePrintController;
use Illuminate\Support\Facades\Route;

// Route::livewire('/', fn() => view(''))->name('landing-page.index');
Route::livewire('/', 'pages::landing-page')->name('landing-page.index');

/* Izin Pelayanan */
Route::livewire('permit-service', 'pages::permit.index')->name('permit-service.index');

/* Kouta Pelayanan */
Route::livewire('slot-services', 'pages::slot.index')->name('slot-services.index');

/* Print Log */
Route::get('/log-permit-services/print', 
    [LogPermitServicePrintController::class, 'print']
)->name('log-permit-services.print');
