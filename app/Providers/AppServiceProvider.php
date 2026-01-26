<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::preventLazyLoading();
        Paginator::useTailwind(); // Use Tailwind pagination

        // Gates are a way to authorize actions based on user permissions.
        Gate::define('edit-job', function (?User $user, Job $job) {
            return $job->employer->user->is($user);
        });
    }
}
