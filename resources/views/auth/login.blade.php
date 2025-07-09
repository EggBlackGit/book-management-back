@extends('layout')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>
@endsection
