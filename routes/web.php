<?php

use App\Http\Controllers\DutyController;
use App\Http\Controllers\HoursController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// All Apprentices:
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

Route::get('/tutors', [TutorController::class, 'index'])->name('tutors.index');
Route::get('/tutors/create', [TutorController::class, 'create'])->name('tutors.create');
Route::post('/tutors', [TutorController::class, 'store'])->name('tutors.store');
Route::get('/tutors/{tutor}', [TutorController::class, 'show'])->name('tutors.show'); 
Route::get('/tutors/{tutor}/edit', [TutorController::class, 'edit'])->name('tutors.edit');
Route::put('/tutors/{tutor}', [TutorController::class, 'update'])->name('tutors.update');  
Route::delete('/tutors/{tutor}', [TutorController::class, 'destroy'])->name('tutors.destroy'); 

Route::resource('apprentices', ApprenticeController::class);
Route::get('/', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/progress', [DutyController::class, 'index'])->middleware(['auth', 'verified'])->name('apprentice-progress');

Route::get('/hours', [HoursController::class, 'index'])->middleware(['auth', 'verified'])->name('apprentice-hours');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';
