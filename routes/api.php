<?php

use App\Http\Controllers\ApprenticeshipController;
use Illuminate\Support\Facades\Route;

Route::get('/apprenticeships', [ApprenticeshipController::class, 'getApprenticeships']);
Route::get('/apprentices', [ApprenticeshipController::class, 'getApprentices']);
Route::post('/assign', [ApprenticeshipController::class, 'assignApprenticeship']);

