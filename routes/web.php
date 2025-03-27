<?php

use App\Http\Controllers\ApprenticeDashboardController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApprenticeshipController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Dashboard Routes
Route::middleware('auth')->get('/dashboard', [ApprenticeDashboardController::class, 'index'])->name('dashboard');

// All Apprentices
Route::get('/learners', [ApprenticeController::class, 'index'])->name('learners.index');

// Selected Apprentice
Route::get('/learner/{apprentice_id}', [ApprenticeController::class, 'show'])->name('learner.show');

// Apprentice CRUD Operations Pages
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

// Fetch Apprenticeships on Apprentice Registration
Route::get('/learners/create', [ApprenticeController::class, 'fetchApprenticeships'])->name('learners.create');

// Apprenticeship Routes
Route::get('/apprenticeships', [ApprenticeshipController::class, 'index'])->name('apprenticeships.index');
Route::get('/apprenticeships/{id}', [ApprenticeshipController::class, 'show'])->name('apprenticeships.show');
Route::post('/apprenticeships/assign', [ApprenticeshipController::class, 'assign'])->name('apprenticeships.assign');

// Resource Routes for Apprentices
Route::resource('apprentices', ApprenticeController::class);

// Dashboard (Default)
Route::get('/', [ApprenticeDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Additional Routes for Apprentice Progress & Hours
Route::get('/progress', function (Request $request) {
    return view('apprentice-progress');
})->middleware(['auth', 'verified'])->name('apprentice-progress');

Route::get('/hours', function (Request $request) {
    return view('apprentice-hours');
})->middleware(['auth', 'verified'])->name('apprentice-hours');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Image Display Route
Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';
