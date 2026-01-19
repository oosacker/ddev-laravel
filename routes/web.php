<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Route::get('/job-posted', function () {
//     try {
//         Mail::to('oosacker@gmail.com')->send(new JobPosted());
//         //Log::info('Email sent to oosacker@gmail.com');
//         return 'Email sent';
//     } catch (\Exception $e) {
//         Log::error('Failed to send email: ' . $e->getMessage());
//         return 'Failed to send email';
//     }
// });

Route::get('closure', function () {
    // Run a job in the background
    // Delay the job by 5 seconds
    // artisan queue:work
    dispatch(function () {
        Log::info('Hello from the queue');
    })->delay(5);

    return 'Job dispatched';
});


Route::get('translate', function () {
    $job = Job::first();

    // Pass the Job object to the queued job
    TranslateJob::dispatch($job);

    return 'Job dispatched';
});

Route::view('/', 'home');
// Route::view('/contact', 'contact');
// use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'submit']);

// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::post('/jobs', 'store');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'create', 'show', 'edit', 'store', 'update', 'destroy']
// ]);

// Route::resource('jobs', JobController::class)->only(['index', 'show'])->middleware('auth');

// Show all jobs
Route::get('/jobs', [JobController::class, 'index']);

// Place before the wildcard route
Route::get('/jobs/create', [JobController::class, 'create']);

// Show a single job
Route::get('/jobs/{job:id}', [JobController::class, 'show']);

// Edit job form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit-job', 'job');
// Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
//     ->middleware('auth')
//     ->can('edit','job'); // Using the JobPolicy

// Create a new job
Route::post('/jobs', [JobController::class, 'store'])
    ->middleware('auth');

// Update a job
Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('edit-job', 'job');

// Delete a job
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit-job', 'job');


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

// laravel.com/docs/master/routing#named-routes
// Else gets blocked by the middleware
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);
