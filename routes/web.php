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
    // $jobs = Job::all(); // lazy loading
    // $jobs = Job::with('employer')->paginate(10); // Eager loading
    // $jobs = Job::with('employer')->simplePaginate(10); // Show only next and previous links
    $jobs = Job::with('employer')->cursorPaginate(10); // Cursor pagination for large datasets

    return view('jobs', [
        'jobs' => $jobs
    ]);
});