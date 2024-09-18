<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\MilestoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/projek', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projek/tambah', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/projek/kemaskini/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/projek/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/perbatuan/{project_id}', [MilestoneController::class, 'create'])->name('milestone.create');
    Route::get('/perbatuan/kemaskini/{project_id}/{milestone_id}', [MilestoneController::class, 'edit'])->name('milestone.edit');

    Route::get('/agensi', [AgencyController::class, 'index'])->name('agency.index');
    Route::get('/agensi/tambah', [AgencyController::class, 'create'])->name('agency.create');
    Route::get('/agensi/kemaskini/{id}', [AgencyController::class, 'edit'])->name('agency.edit');
    Route::get('/agensi/{id}', [AgencyController::class, 'show'])->name('agency.show');
});

