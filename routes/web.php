<?php

use App\Http\Controllers\BatchesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\RegimentController;
use App\Http\Controllers\SoldiersController;
use App\Http\Controllers\SoldiersDataController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('regiment', RegimentController::class);
 Route::resource('batches', BatchesController::class);
 Route::post('/soldiers/delete-on-leave', [SoldiersController::class, 'deleteOnLeave'])
    ->name('soldiers.deleteOnLeave');
Route::resource('soldiers', SoldiersController::class);
Route::post('regiments/bulkLeave', [RegimentController::class, 'bulkLeave'])->name('regiments.bulkLeave');
Route::get('/regiments/{id}', [RegimentController::class, 'show'])->name('regiments.show');
Route::resource('soldiers-data', SoldiersDataController::class);
Route::resource('leaves', LeavesController::class);
  Route::patch('/soldiers/update-status/{soldier}', [SoldiersController::class, 'updateStatus'])->name('soldiers.updateStatus');
 ;
 













