<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Place before the wildcard route
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job
    ]);
});

Route::post('/jobs', function () {
    $request = request()->all();

    Job::create([
        'title' => $request['title'],
        'salary' => $request['salary'],
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/jobs', function () {
    // $jobs = Job::all(); // lazy loading
    // $jobs = Job::with('employer')->paginate(10); // Eager loading
    // $jobs = Job::with('employer')->simplePaginate(10); // Show only next and previous links
    $jobs = Job::with('employer')->latest()->cursorPaginate(10); // Cursor pagination for large datasets

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

