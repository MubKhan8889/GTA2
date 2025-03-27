<?php

use App\Http\Controllers\DutyController;
use App\Http\Controllers\HoursController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ApprenticeDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\ApprenticeshipController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Admin Dashboard route (protected by admin role)
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Apprentice Dashboard
Route::middleware('auth')->get('/dashboard', [ApprenticeDashboardController::class, 'index'])->name('dashboard');

// Tutor Dashboard
Route::middleware(['auth', 'role:tutor'])->get('/tutor/dashboard', [TutorDashboardController::class, 'index'])->name('tutor.dashboard');

// All Apprentices
Route::get('/learners', [ApprenticeController::class, 'index'])->name('learners.index');

// Selected Apprentice
Route::get('/learner/{apprentice_id}', [ApprenticeController::class, 'show'])->name('learner.show');

// Apprentice's CRUD operations pages
Route::get('/learners/{apprentice_id}/edit', [ApprenticeController::class, 'edit'])->name('learners.edit');
Route::put('/learners/{apprentice_id}', [ApprenticeController::class, 'update'])->name('learners.update');
Route::delete('/learners/{id}', [ApprenticeController::class, 'destroy'])->name('learners.destroy');

// Archived Apprentices
Route::put('/learners/{id}/archive', [ApprenticeController::class, 'archive'])->name('learners.archive');
Route::get('/archived-learners', [ApprenticeController::class, 'archivedLearners'])->name('learners.archived');
Route::put('/learners/{id}/unarchive', [ApprenticeController::class, 'unarchive'])->name('learners.unarchive');

// Register Apprentice
Route::get('/learners/create', [ApprenticeController::class, 'create'])->name('learners.create');
Route::post('/learners', [ApprenticeController::class, 'store'])->name('learners.store');
Route::get('/learners/create', [ApprenticeController::class, 'fetchApprenticeships'])->name('learners.create');

// Tutor Routes
Route::get('/tutors', [TutorController::class, 'index'])->name('tutors.index');
Route::get('/tutors/create', [TutorController::class, 'create'])->name('tutors.create');
Route::post('/tutors', [TutorController::class, 'store'])->name('tutors.store');
Route::get('/tutors/{tutor}', [TutorController::class, 'show'])->name('tutors.show');
Route::get('/tutors/{tutor}/edit', [TutorController::class, 'edit'])->name('tutors.edit');
Route::put('/tutors/{tutor}', [TutorController::class, 'update'])->name('tutors.update');
Route::delete('/tutors/{tutor}', [TutorController::class, 'destroy'])->name('tutors.destroy');

// Apprenticeship Routes
Route::get('/apprenticeships', [ApprenticeshipController::class, 'index'])->name('apprenticeships.index');
Route::get('/apprenticeships/{id}', [ApprenticeshipController::class, 'show'])->name('apprenticeships.show');
Route::post('/apprenticeships/assign', [ApprenticeshipController::class, 'assign'])->name('apprenticeships.assign');

// Resources for apprentices
Route::resource('apprentices', ApprenticeController::class);

// Dashboard (default)
Route::get('/', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

// Additional Routes for Apprentice Progress & Hours
Route::get('/progress', [DutyController::class, 'index'])->middleware(['auth', 'verified'])->name('apprentice-progress');
Route::get('/hours', [HoursController::class, 'index'])->middleware(['auth', 'verified'])->name('apprentice-hours');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Employer Routes
Route::prefix('employers')->name('employers.')->group(function () {
    Route::get('/', [EmployerController::class, 'index'])->name('index');
    Route::get('/create', [EmployerController::class, 'create'])->name('create');
    Route::post('/', [EmployerController::class, 'store'])->name('store');
    Route::get('/{employer}/edit', [EmployerController::class, 'edit'])->name('edit');
    Route::put('/{employer}', [EmployerController::class, 'update'])->name('update');
    Route::delete('/{employer}', [EmployerController::class, 'destroy'])->name('destroy');
});

// Image Display Route
Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';

