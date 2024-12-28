<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <ul class="list-disc">
        @foreach ($jobs as $job)
            <li>
                <a class="hover:underline" href="/jobs/{{ $job['id'] }}">
                    <strong>{{ $job['title'] }}</strong>: {{ $job['salary'] }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>


