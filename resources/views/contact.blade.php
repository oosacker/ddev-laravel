<x-layout>
    <x-slot:heading>
        Contact Page
    </x-slot:heading>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/contact">
        @csrf
        <p>
            <label>Name:<br>
            <input type="text" name="name" value="{{ old('name') }}">
            </label>
        </p>
        <p>
            <label>Email:<br>
            <input type="email" name="email" value="{{ old('email') }}">
            </label>
        </p>
        <p>
            <label>Message:<br>
            <textarea name="body">{{ old('body') }}</textarea>
            </label>
        </p>
        <button type="submit">Send</button>
    </form>
</x-layout>