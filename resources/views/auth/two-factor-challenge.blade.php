@extends('layouts.auth', ['title' => 'Two Factor Challenge - Admin'])

@section('content')
<div class="auth-card w-full max-w-md p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Two-Factor Authentication</h1>
        <p class="text-gray-600 mt-2">Please enter your authentication code</p>
    </div>

    <form action="{{ url('/two-factor-challenge') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Authentication Code</label>
                <input type="text"
                       name="code"
                       class="input-field @error('code') border-red-500 @enderror"
                       placeholder="Enter your 6-digit code">
                @error('code')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or</span>
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Recovery Code</label>
                <input type="text"
                       name="recovery_code"
                       class="input-field @error('recovery_code') border-red-500 @enderror"
                       placeholder="Enter recovery code">
                @error('recovery_code')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                Verify
            </button>
        </div>
    </form>
</div>
@endsection
