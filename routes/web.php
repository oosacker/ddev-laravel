<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;

Route::view('/', 'home');
Route::view('/contact', 'contact');

// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::post('/jobs', 'store');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

Route::resource('jobs', JobController::class, [
    'only' => ['index', 'create', 'show', 'edit', 'store', 'update', 'destroy']
]);

// // Show all jobs
// Route::get('/jobs', [JobController::class, 'index']);

// // Place before the wildcard route
// Route::get('/jobs/create', [JobController::class, 'create']);

// // Show a single job
// Route::get('/jobs/{job:id}', [JobController::class, 'show']);

// // Edit job form
// Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);

// // Create a new job
// Route::post('/jobs', [JobController::class, 'store']);

// // Update a job
// Route::patch('/jobs/{job}', [JobController::class, 'update']);

// // Delete a job
// Route::delete('/jobs/{job}', [JobController::class, 'destroy']);


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);


