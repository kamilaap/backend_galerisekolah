@extends('layouts.app', ['title' => 'Dashboard - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl text-white p-8 mb-8 shadow-lg">
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-blue-100">Kelola konten website SMKN 4 Bogor dari dashboard admin</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Informasi Stats -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-newspaper text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Informasi::count() }}</h4>
                        <p class="text-gray-500">Total Informasi</p>
                    </div>
                </div>
            </div>

            <!-- Agenda Stats -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-calendar text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Agenda::count() }}</h4>
                        <p class="text-gray-500">Total Agenda</p>
                    </div>
                </div>
            </div>

            <!-- Galeri Stats -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-images text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Galery::count() }}</h4>
                        <p class="text-gray-500">Total Galeri</p>
                    </div>
                </div>
            </div>

            <!-- Users Stats -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\User::count() }}</h4>
                        <p class="text-gray-500">Total Users</p>
                    </div>
                </div>
                <!-- User Details -->
                <div class="mt-4 grid grid-cols-2 gap-4 pt-4 border-t">
                    <div>
                        <p class="text-sm text-gray-500">Admin</p>
                        <p class="font-semibold text-gray-800">
                            {{ \App\Models\User::where('role', 'admin')->count() }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Users</p>
                        <p class="font-semibold text-gray-800">
                            {{ \App\Models\User::where('role', 'user')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-white">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Tambah Informasi -->
                    <a href="{{ route('admin.informasi.create') }}"
                       class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Tambah Informasi</h3>
                            <p class="text-sm text-gray-600">Posting informasi baru</p>
                        </div>
                    </a>

                    <!-- Tambah Agenda -->
                    <a href="{{ route('admin.agenda.create') }}"
                       class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-calendar text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Tambah Agenda</h3>
                            <p class="text-sm text-gray-600">Buat agenda baru</p>
                        </div>
                    </a>

                    <!-- Tambah Galeri -->
                    <a href="{{ route('admin.galery.create') }}"
                       class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-images text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Tambah Galeri</h3>
                            <p class="text-sm text-gray-600">Upload galeri baru</p>
                        </div>
                    </a>

                    <!-- Tambah User -->
                    <a href="{{ route('admin.users.create') }}"
                       class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Tambah User</h3>
                            <p class="text-sm text-gray-600">Tambah user baru</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-white">Aktivitas Terbaru</h2>
            </div>
            <div class="p-6">
                @foreach(\App\Models\Informasi::latest()->take(5)->get() as $info)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b' : '' }}">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100">
                            <i class="fas fa-newspaper text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-gray-700 font-semibold">{{ $info->judul }}</h4>
                            <p class="text-sm text-gray-500">{{ $info->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.informasi.edit', $info->id) }}"
                       class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
