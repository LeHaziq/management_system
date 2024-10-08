<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\InternController;
use App\Http\Controllers\Admin\LeaveApplicationController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\Admin\PICAgencyController;
use App\Http\Controllers\Admin\ProjectAssignmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/projek', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/projek/tambah', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/projek/kemaskini/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/projek/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/penugasan-projek/{project_id}', [ProjectAssignmentController::class, 'index'])->name('assignment.index');

    Route::get('/perbatuan/{project_id}', [MilestoneController::class, 'create'])->name('milestone.create');
    Route::get('/perbatuan/kemaskini/{project_id}/{milestone_id}', [MilestoneController::class, 'edit'])->name('milestone.edit');
    Route::get('/perbatuan/{project_id}/{milestone_id}', [MilestoneController::class, 'show'])->name('milestone.show');

    Route::get('/agensi', [AgencyController::class, 'index'])->name('agency.index');
    Route::get('/agensi/tambah', [AgencyController::class, 'create'])->name('agency.create');
    Route::get('/agensi/kemaskini/{id}', [AgencyController::class, 'edit'])->name('agency.edit');
    Route::get('/agensi/{id}', [AgencyController::class, 'show'])->name('agency.show');

    Route::get('/pic-agensi', [PICAgencyController::class, 'index'])->name('agency.pic.index');
    Route::get('/pic-agensi/tambah/{agency_id}', [PicAgencyController::class, 'create'])->name('agency.pic.create');
    Route::get('/pic-agensi/kemaskini/{id}', [PICAgencyController::class, 'edit'])->name('agency.pic.edit');
    Route::get('/pic-agensi/{id}', [PICAgencyController::class, 'show'])->name('agency.pic.show');

    Route::get('/industri/intern', [InternController::class, 'index'])->name('intern.index');
    Route::get('/industri/intern/tambah', [InternController::class, 'create'])->name('intern.create');
    Route::get('/industri/intern/kemaskini/{id}', [InternController::class, 'edit'])->name('intern.edit');
    Route::get('/industri/intern/{id}', [InternController::class, 'show'])->name('intern.show');

    Route::get('/industri/cuti', [LeaveApplicationController::class, 'index'])->name('leave.index');
    Route::get('/industri/cuti/tambah', [LeaveApplicationController::class, 'create'])->name('leave.create');
    Route::get('/industri/cuti/kemaskini/{id}', [LeaveApplicationController::class, 'edit'])->name('leave.edit');
    Route::get('/industri/cuti/{id}', [LeaveApplicationController::class, 'show'])->name('leave.show');
});

