<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// All Apprentices:
Route::get('/learners', [ApprenticeController::class, 'index'])->name('learners.index');

// Selected Apprentice
Route::get('/learner/{apprentice_id}', [ApprenticeController::class, 'show'])->name('learner.show');

// Webpages
Route::get('/', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/progress', function (Request $request){
return view('apprentice-progress');
})->middleware(['auth', 'verified'])->name('apprentice-progress');

Route::get('/hours', function (Request $request){
    return view('apprentice-hours');
})->middleware(['auth', 'verified'])->name('apprentice-hours');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';
