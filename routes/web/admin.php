<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AgencyController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/projek', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projek/tambah', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/projek/kemaskini/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/projek/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/agensi', [AgencyController::class, 'index'])->name('agency.index');
    Route::get('/agensi/tambah', [AgencyController::class, 'create'])->name('agency.create');
});
