<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/view-accounts', [DashboardController::class, 'viewAccounts'])->name('admin.view-accounts');
    Route::get('/admin/edit-account-details', [DashboardController::class, 'editAccountDetails'])->name('admin.edit-account-details');
    Route::get('/admin/edit-apprentice-info', [DashboardController::class, 'editApprenticeInfo'])->name('admin.edit-apprentice-info');
    Route::get('/admin/archive-learners', [DashboardController::class, 'archiveLearners'])->name('admin.archive-learners');
});

// Tutor Routes
Route::middleware(['auth', 'role:tutor'])->group(function () {
    Route::get('/tutor/dashboard', [DashboardController::class, 'tutorDashboard'])->name('tutor.dashboard');
    Route::get('/tutor/view-duties-rag', [DashboardController::class, 'viewDutiesRag'])->name('tutor.view-duties-rag');
    Route::get('/tutor/view-hours', [DashboardController::class, 'viewHours'])->name('tutor.view-hours');
    Route::get('/tutor/view-apprenticeship', [DashboardController::class, 'viewApprenticeship'])->name('tutor.view-apprenticeship');
});

// Apprentice Routes
Route::middleware(['auth', 'role:apprentice'])->group(function () {
    Route::get('/apprentice/dashboard', [DashboardController::class, 'apprenticeDashboard'])->name('apprentice.dashboard');
    Route::get('/apprentice/view-duties-rag', [DashboardController::class, 'viewDutiesRag'])->name('apprentice.view-duties-rag');
    Route::get('/apprentice/view-hours', [DashboardController::class, 'viewHours'])->name('apprentice.view-hours');
    Route::get('/apprentice/view-apprenticeship', [DashboardController::class, 'viewApprenticeship'])->name('apprentice.view-apprenticeship');
});

// All Apprentices:
Route::get('/learners', [ApprenticeController::class, 'index'])->name('learners.index');

// Selected Apprentice
Route::get('/learner/{apprentice_id}', [ApprenticeController::class, 'show'])->name('learner.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';
