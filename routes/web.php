<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', [
        'job' => $job
    ]);
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->get(); // Eager loading
    // $jobs = Job::all(); // lazy loading

    return view('jobs', [
        'jobs' => $jobs
    ]);
});