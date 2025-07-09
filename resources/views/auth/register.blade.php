@extends('layout')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Register
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>
@endsection
