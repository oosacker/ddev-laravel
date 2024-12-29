<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
  public static function all(): array
  {
    return [
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
  }

  public static function find(int $id): array
  {
    $job = Arr::first(self::all(), fn($job) => $job['id'] == $id);

    if (!$job) {
        abort(404);
    }

    return $job;
  }
}