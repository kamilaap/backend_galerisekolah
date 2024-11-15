@extends('layouts.auth', ['title' => 'Forgot Password - Admin'])

@section('content')
<div class="auth-card w-full max-w-md p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Reset Password</h1>
        <p class="text-gray-600 mt-2">Enter your email to receive reset instructions</p>
    </div>

    @if (session('status'))
    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6">
        {{ session('status') }}
    </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Email Address</label>
                <input type="email"
                       name="email"
                       class="input-field @error('email') border-red-500 @enderror"
                       value="{{ old('email') }}"
                       placeholder="name@company.com">
                @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                Send Reset Link
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                    Back to Login
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
