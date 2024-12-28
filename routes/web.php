<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'title' => 'Backend Developer',
            'salary' => '$3000',
            'id' => 1
        ],
        [
            'title' => 'Frontend Developer',
            'salary' => '$2500',
            'id' => 2
        ],
        [
            'title' => 'Fullstack Developer',
            'salary' => '$4000',
            'id' => 3
        ],
        [
            'title' => 'Developer',
            'salary' => '$5000',
            'id' => 4
        ],
    ];

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    // dd($job);

    return view('job', [
        'job' => $job
    ]);
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'title' => 'Backend Developer',
                'salary' => '$3000',
                'id' => 1
            ],
            [
                'title' => 'Frontend Developer',
                'salary' => '$2500',
                'id' => 2
            ],
            [
                'title' => 'Fullstack Developer',
                'salary' => '$4000',
                'id' => 3
            ],
            [
                'title' => 'Developer',
                'salary' => '$5000',
                'id' => 4
            ],
        ],
    ]);
});