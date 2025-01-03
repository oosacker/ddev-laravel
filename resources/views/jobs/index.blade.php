<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a
                class="block px-4 py-6 border border-gray-200"
                href="/jobs/{{ $job['id'] }}"
            >
                <div class="font-bold text-blue-500">
                    {{ $job->employer->name }}
                </div>

                <strong>{{ $job['title'] }}</strong>: {{ $job['salary'] }}
            </a>
        @endforeach
    </div>

    <div>
        {{ $jobs->links() }}
    </div>
</x-layout>


