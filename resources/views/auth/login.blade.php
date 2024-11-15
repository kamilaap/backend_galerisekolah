@extends('layouts.auth', ['title' => 'Login - Admin'])
@section('content')
<div class="auth-card w-full max-w-md p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Login</h1>
        <p class="text-gray-600 mt-2">Please sign in to your account</p>
    </div>

    @if (session('status'))
    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6">
        {{ session('status') }}
    </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Email Address</label>
                <input type="email"
                       name="email"
                       class="input-field @error('email') border-red-500 @enderror"
                       value="{{ old('email') }}"
                       placeholder="user1@gmail.com">
                @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Password</label>
                <input type="password"
                       name="password"
                       class="input-field @error('password') border-red-500 @enderror"
                       placeholder="usersatu">
                @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="btn-primary">
                Sign in
            </button>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
