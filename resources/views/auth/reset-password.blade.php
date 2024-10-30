@extends('layouts.auth', ['title' => 'Update Password - Admin'])
@section('content')
<div class="flex justify-center items-center h-screen" style="background-color: #9DBDFF;">
    <div class="p-6 max-w-sm w-full" style="background-color: #FFD7C4; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <div class="flex justify-center items-center">
            <span style="color: #7695FF; font-weight: bold; font-size: 24px;">UPDATE PASSWORD</span>
        </div>
        @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form class="mt-4" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <label class="block mt-3">
                <span style="color: #7695FF;">Email</span>
                <input type="email" name="email" value="{{ $request->email ?? old('email') }}" class="form-input mt-1 block w-full rounded-md border-[#7695FF]" placeholder="Alamat Email">
                @error('email')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>
            <label class="block mt-3">
                <span style="color: #7695FF;">Password</span>
                <input type="password" name="password" class="form-input mt-1 block w-full rounded-md border-[#7695FF]" placeholder="Password">
                @error('password')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>
            <label class="block mt-3">
                <span style="color: #7695FF;">Konfirmasi Password</span>
                <input type="password" name="password_confirmation" class="form-input mt-1 block w-full rounded-md border-[#7695FF]" placeholder="Konfirmasi Password">
                @error('password_confirmation')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>
            <div class="mt-6">
                <button type="submit" class="py-2 px-4 text-center" style="background-color: #7695FF; color: white; border-radius: 8px; width: 100%;">UPDATE PASSWORD</button>
            </div>
        </form>
    </div>
</div>
@endsection
