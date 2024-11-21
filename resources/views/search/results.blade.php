<!-- resources/views/search/results.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results for "{{ $query }}"</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --accent: #60a5fa;
        }

        .navbar-blur {
            background: linear-gradient(to right, #1e3a8a, #1e40af);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            position: relative;
            color: #e0f2fe;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #38bdf8;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #38bdf8;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .logo-text {
            color: #f0f9ff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo-subtitle {
            color: #bfdbfe;
            font-weight: 500;
        }

        .auth-button {
            background: #3b82f6;
            color: white;
            font-weight: 600;
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.5);
        }

        .auth-button:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px -1px rgba(59, 130, 246, 0.6);
        }

        .profile-button {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .profile-button:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .dropdown-menu {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .dropdown-item {
            color: #1e40af;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #eff6ff;
            color: #2563eb;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="navbar-blur sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo dan Nama -->
                <div class="flex items-center space-x-4">
                     <img src="{{ asset('assets/images/logo/logo.png') }}"
                         alt="Logo SMKN 4 Bogor"
                         class="h-12 w-auto hover:scale-105 transition-transform duration-300">
                    <div>
                        <a href="{{ route('welcome') }}"
                           class="logo-text text-xl font-bold hover:text-blue-200 transition-colors duration-300">
                            Edu Galery
                        </a>
                        <p class="logo-subtitle text-sm">Unggul dalam Digital, Berkarakter dalam Akhlak</p>
                    </div>
                </div>

                <!-- Search Bar -->
                <form id="search-form" action="{{ route('search') }}" method="GET"
                      class="hidden md:flex items-center">
                    <div class="relative">
                        <input type="text" name="query"
                               value="{{ $query }}"
                               placeholder="Cari Berdasarkan Kategori....."
                               class="search-input w-64 focus:w-80 transition-all duration-300 focus:outline-none rounded-full px-6 py-2">
                        <button type="submit"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/80 hover:text-white transition-colors duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('web.informasi.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Informasi</span>
                    </a>
                    <a href="{{ route('web.agenda.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="{{ route('web.galery.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-images"></i>
                        <span>Galeri</span>
                    </a>

                    <!-- Auth Buttons/Menu -->
                    @auth
                        <div class="relative group">
                            <button class="profile-button flex items-center space-x-2">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset(auth()->user()->avatar) }}"
                                         alt="Profile"
                                         class="w-8 h-8 rounded-full border-2 border-white object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                         alt="Profile"
                                         class="w-8 h-8 rounded-full border-2 border-white">
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 py-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard.index') }}"
                                       class="dropdown-item flex items-center px-4 py-2">
                                        <i class="fas fa-tachometer-alt mr-2"></i>
                                        <span>Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('web.profile') }}"
                                       class="dropdown-item flex items-center px-4 py-2">
                                        <i class="fas fa-user-circle mr-2"></i>
                                        <span>Profile</span>
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item flex items-center w-full px-4 py-2">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="auth-button">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white hover:text-blue-200 transition-colors duration-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6 mb-20">
        <!-- Search Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold gradient-text mb-4">Hasil Pencarian</h1>
            <p class="text-gray-600 text-lg">Menampilkan hasil untuk "{{ $query }}"</p>
        </div>

        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Beranda
            </a>
        </div>

        @if($results['informasi']->isEmpty() && $results['agenda']->isEmpty() && $results['galery']->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-xl text-gray-600">Tidak ada hasil yang ditemukan.</p>
            </div>
        @else
            <!-- Informasi Section -->
            @if($results['informasi']->isNotEmpty())
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-newspaper text-blue-600 mr-3"></i>
                        Informasi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($results['informasi'] as $info)
                            <div class="search-card rounded-xl overflow-hidden">
                                <img src="{{ $info->image }}"
                                     alt="{{ $info->judul }}"
                                     class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $info->judul }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($info->deskripsi, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $info->created_at->format('d M Y') }}
                                        </span>
                                        <a href="{{ route('web.informasi.show', $info->id) }}"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-700">
                                            Baca Selengkapnya
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Agenda Section -->
            @if($results['agenda']->isNotEmpty())
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-calendar-alt text-green-600 mr-3"></i>
                        Agenda
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($results['agenda'] as $agenda)
                            <div class="search-card rounded-xl p-6">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-green-100 rounded-lg p-3">
                                        <i class="fas fa-calendar-day text-2xl text-green-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $agenda->judul }}</h3>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                                            </span>
                                            <a href="{{ route('web.agenda.show', $agenda->id) }}"
                                               class="text-green-600 hover:text-green-700 inline-flex items-center">
                                                Detail
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Galery Section -->
            @if($results['galery']->isNotEmpty())
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-images text-purple-600 mr-3"></i>
                        Galeri
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($results['galery'] as $galery)
                            <div class="search-card rounded-xl overflow-hidden group">
                                @if($galery->photos->isNotEmpty())
                                    <div class="relative h-48">
                                        <img src="{{ $galery->photos->first()->image }}"
                                             alt="{{ $galery->judul }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $galery->judul }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($galery->deskripsi, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $galery->created_at->format('d M Y') }}
                                        </span>
                                        <a href="{{ route('web.galery.photo', $galery->id) }}"
                                           class="inline-flex items-center text-purple-600 hover:text-purple-700">
                                            Lihat Galeri
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-8">
        <div class="container mx-auto text-center">
              <img src="{{ asset('assets/images/logo/logo.png') }}"
                 alt="Logo SMKN 4 Bogor"
                 class="h-12 mx-auto mb-4">
            <p class="text-sm mb-2">
                SMKN 4 Bogor, Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara Sari,
                Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137
            </p>
            <p class="text-sm mb-4">© 2024 SMKN 4 Bogor. All rights reserved.</p>
            <div class="flex justify-center space-x-6">
                <a href="https://web.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/"
                   class="text-gray-400 hover:text-blue-500 transition-colors duration-300"
                   target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/smkn4kotabogor/"
                   class="text-gray-400 hover:text-pink-500 transition-colors duration-300"
                   target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com"
                   class="text-gray-400 hover:text-blue-400 transition-colors duration-300"
                   target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/@smknegeri4bogor905"
                   class="text-gray-400 hover:text-red-500 transition-colors duration-300"
                   target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="mailto:smkn4@smkn4bogor.sch.id"
                   class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
