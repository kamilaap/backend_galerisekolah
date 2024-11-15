<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .stat-card {
            @apply bg-white rounded-xl p-6 shadow-lg transform hover:-translate-y-1 transition-all duration-300;
        }
        .stat-icon {
            @apply p-4 rounded-full text-2xl;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo" class="h-8 w-auto">
                    <span class="ml-2 font-semibold text-xl">Admin Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl text-white p-8 mb-8">
            <h1 class="text-3xl font-bold mb-2">Selamat Datang di Dashboard Admin</h1>
            <p class="opacity-90">Kelola konten website SMKN 4 Bogor dari sini</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Informasi Stats -->
            <div class="stat-card">
                <div class="flex items-center">
                    <div class="stat-icon bg-blue-100 text-blue-600">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Total Informasi</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Informasi::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Agenda Stats -->
            <div class="stat-card">
                <div class="flex items-center">
                    <div class="stat-icon bg-green-100 text-green-600">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Total Agenda</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Agenda::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Galeri Stats -->
            <div class="stat-card">
                <div class="flex items-center">
                    <div class="stat-icon bg-purple-100 text-purple-600">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Total Galeri</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Galery::count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Users Stats -->
            <div class="stat-card">
                <div class="flex items-center">
                    <div class="stat-icon bg-yellow-100 text-yellow-600">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Total Users</p>
                        <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-6 shadow-lg mb-8">
            <h2 class="text-xl font-semibold mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.informasi.create') }}"
                   class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-plus-circle text-blue-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-blue-600">Tambah Informasi</p>
                        <p class="text-sm text-blue-500">Posting informasi baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.agenda.create') }}"
                   class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <i class="fas fa-plus-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-green-600">Tambah Agenda</p>
                        <p class="text-sm text-green-500">Buat agenda baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.galery.create') }}"
                   class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <i class="fas fa-plus-circle text-purple-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-purple-600">Tambah Galeri</p>
                        <p class="text-sm text-purple-500">Upload foto baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                    <i class="fas fa-users-cog text-yellow-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-yellow-600">Kelola Users</p>
                        <p class="text-sm text-yellow-500">Atur pengguna</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl p-6 shadow-lg">
            <h2 class="text-xl font-semibold mb-6">Aktivitas Terbaru</h2>
            <div class="space-y-4">
                @foreach(\App\Models\Informasi::latest()->take(5)->get() as $info)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-newspaper text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold">{{ $info->judul }}</p>
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
</body>
</html>
