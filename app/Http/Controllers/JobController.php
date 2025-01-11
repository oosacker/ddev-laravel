<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index()
    {
        // $jobs = Job::all(); // lazy loading
        // $jobs = Job::with('employer')->paginate(10); // Eager loading
        // $jobs = Job::with('employer')->simplePaginate(10); // Show only next and previous links

        $jobs = Job::with('employer')
            ->latest()
            ->cursorPaginate(10); // Cursor pagination for large datasets

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    public function edit(Job $job)
    {
        // if (Auth::user()->can('edit-job', $job)) {
        //     // ...
        // }

        // See def: AppServiceProvider
        // Gate::authorize('edit-job', $job);

        return view('jobs.edit', [
            'job' => $job
        ]);
    }

    public function store()
    {
        // https://laravel.com/docs/11.x/validation#available-validation-rules
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $request = request()->all();

        $job = Job::create([
            'title' => $request['title'],
            'salary' => $request['salary'],
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(
            new JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function update(Job $job)
    {
        //Gate::authorize('edit-job', $job);

        // https://laravel.com/docs/11.x/validation#available-validation-rules
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        //Gate::authorize('edit-job', $job);

        $job->delete();

        return redirect('/jobs/');
    }
}
