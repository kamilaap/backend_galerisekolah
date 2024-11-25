@extends('layouts.app', ['title' => 'Profile - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-8 text-white">
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                    <div class="relative group">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}"
                                 alt="Profile"
                                 class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover"
                                 id="avatarImage">
                        @else
                            <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center text-blue-600 text-3xl font-bold border-4 border-white shadow-lg"
                                 id="avatarPlaceholder">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif

                        <!-- Overlay for hover effect -->
                        <div class="absolute inset-0 rounded-full bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <label for="avatarInput" class="cursor-pointer">
                                <i class="fas fa-camera text-white text-2xl"></i>
                            </label>
                        </div>

                        <!-- Hidden file input -->
                        <input type="file" 
                               id="avatarInput" 
                               class="hidden" 
                               accept="image/*"
                               onchange="updateAvatar(this)">
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">{{ auth()->user()->name }}</h1>
                        <p class="text-blue-100">Administrator</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Messages -->
        @if (session('status'))
        <div class="mb-8">
            <div class="bg-green-500 bg-opacity-90 backdrop-blur-sm text-white p-4 rounded-lg shadow-md">
                @if (session('status')=='profile-information-updated')
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>Profil berhasil diperbarui</span>
                    </div>
                @endif
                @if (session('status')=='password-updated')
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>Password berhasil diperbarui</span>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-8">
                <!-- Edit Profile Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-semibold text-white">Edit Profil</h2>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('user-profile-information.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap
                                </label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') ?? auth()->user()->name }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') ?? auth()->user()->email }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Masukkan email">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                <i class="fas fa-save mr-2"></i>
                                Update Profil
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Two Factor Authentication Card -->
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-semibold text-white">Autentikasi Dua Faktor</h2>
                    </div>
                    <div class="p-6">
                        @if(!auth()->user()->two_factor_secret)
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    Aktifkan 2FA
                                </button>
                            </form>
                        @else
                            <div class="space-y-6">
                                @if(session('status') == 'two-factor-authentication-enabled')
                                    <div class="text-sm text-gray-600 mb-4">
                                        Scan QR code berikut dengan aplikasi autentikator Anda:
                                    </div>
                                    <div class="flex justify-center mb-6">
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                @endif

                                <div class="bg-gray-900 rounded-lg p-4">
                                    <div class="text-sm text-white mb-2">Recovery Codes:</div>
                                    @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                        <div class="text-sm font-mono text-gray-300">{{ $code }}</div>
                                    @endforeach
                                </div>

                                <div class="flex space-x-4">
                                    <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                            <i class="fas fa-sync-alt mr-2"></i>
                                            Regenerate Codes
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ url('user/two-factor-authentication') }}" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                            <i class="fas fa-shield-alt mr-2"></i>
                                            Nonaktifkan 2FA
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column -->
            <div>
                <!-- Update Password Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-semibold text-white">Update Password</h2>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('user-password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Current Password -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Saat Ini
                                </label>
                                <input type="password"
                                       name="current_password"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Masukkan password saat ini">
                            </div>

                            <!-- New Password -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Baru
                                </label>
                                <input type="password"
                                       name="password"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Masukkan password baru">
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Konfirmasi password baru">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                <i class="fas fa-key mr-2"></i>
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
