<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/projek', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projek/tambah', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/projek/kemaskini/{id}', [ProjectController::class, 'edit'])->name('project.edit');
});
