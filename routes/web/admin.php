<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('index');
    Route::get('/admin/project', [ProjectController::class, 'index'])->name('project.index');
});
