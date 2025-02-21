<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // For retrieving apprentice's details
    Route::get('/apprentice/{id}', [ApprenticeController::class, 'show'])->name('apprentice.show');
});

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

require __DIR__.'/auth.php';