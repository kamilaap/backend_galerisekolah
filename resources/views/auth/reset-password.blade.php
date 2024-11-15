@extends('layouts.auth', ['title' => 'Reset Password - Admin'])

@section('content')
<div class="auth-card w-full max-w-md p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Create New Password</h1>
        <p class="text-gray-600 mt-2">Please set your new password</p>
    </div>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Email Address</label>
                <input type="email"
                       name="email"
                       class="input-field @error('email') border-red-500 @enderror"
                       value="{{ $request->email ?? old('email') }}"
                       readonly>
                @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">New Password</label>
                <input type="password"
                       name="password"
                       class="input-field @error('password') border-red-500 @enderror"
                       placeholder="••••••••">
                @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="input-field"
                       placeholder="••••••••">
            </div>

            <button type="submit" class="btn-primary">
                Reset Password
            </button>
        </div>
    </form>
</div>
@endsection
