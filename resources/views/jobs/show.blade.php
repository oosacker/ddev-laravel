<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>

    <h2 class="text-xl font-bold mb-1">{{ $job->title }}</h2>

    <p>This job pays {{ $job->salary }}</p>

    @can('edit-job', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">
                Edit Job
            </x-button>
        </p>
    @endcan
</x-layout>
