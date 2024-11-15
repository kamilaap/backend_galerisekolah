@extends('layouts.auth', ['title' => 'Confirm Password - Admin'])

@section('content')
<div class="auth-card w-full max-w-md p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Confirm Password</h1>
        <p class="text-gray-600 mt-2">Please confirm your password to continue</p>
    </div>

    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700 block mb-2">Password</label>
                <input type="password"
                       name="password"
                       class="input-field @error('password') border-red-500 @enderror"
                       placeholder="••••••••">
                @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                Confirm Password
            </button>
        </div>
    </form>
</div>
@endsection
