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

// Show a single job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job
    ]);
});

// Edit job form
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', [
        'job' => $job
    ]);
});

// Create a new job
Route::post('/jobs', function () {
     // https://laravel.com/docs/11.x/validation#available-validation-rules
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $request = request()->all();

    Job::create([
        'title' => $request['title'],
        'salary' => $request['salary'],
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Show all jobs
Route::get('/jobs', function () {
    // $jobs = Job::all(); // lazy loading
    // $jobs = Job::with('employer')->paginate(10); // Eager loading
    // $jobs = Job::with('employer')->simplePaginate(10); // Show only next and previous links
    $jobs = Job::with('employer')->latest()->cursorPaginate(10); // Cursor pagination for large datasets

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Update a job
Route::patch('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete a job
Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id)->delete();

    return redirect('/jobs/');
});