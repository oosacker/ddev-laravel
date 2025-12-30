<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    @auth
        <p>Welcome, <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>!</p>
    @endauth
</x-layout>