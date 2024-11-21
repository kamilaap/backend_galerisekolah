<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agenda - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Navbar styling */
        .navbar-blur {
            background: linear-gradient(to right, #0c4a6e, #075985);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Hero section styling */
        .hero-section {
            background: linear-gradient(to right, rgba(12, 74, 110, 0.9), rgba(7, 89, 133, 0.9));
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        /* Agenda card styling */
        .agenda-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .agenda-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Date badge styling */
        .date-badge {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
            min-width: 100px;
        }

        /* Empty state styling */
        .empty-state {
            background: linear-gradient(135deg, #fff5f5, #fee2e2);
            border-left: 4px solid #ef4444;
            padding: 2rem;
            border-radius: 0.5rem;
            text-align: center;
            margin: 2rem 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar - Copy dari welcome.blade.php -->
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

    <!-- Hero Section -->
    <div class="hero-section text-white" data-aos="fade-down">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">
                Agenda Tanggal {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y') }}
            </h1>
            <p class="text-xl text-blue-100">Daftar kegiatan dan acara pada tanggal ini</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-8" data-aos="fade-right">
            <a href="{{ route('web.agenda.index') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Daftar Agenda</span>
            </a>
        </div>

        @if($agendas->isEmpty())
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-calendar-times text-4xl text-red-500 mb-4"></i>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Agenda</h2>
                <p class="text-gray-600">
                    Tidak ada agenda yang terdaftar pada tanggal ini.
                </p>
            </div>
        @else
            <div class="grid gap-6" data-aos="fade-up">
                @foreach($agendas as $agenda)
                    <div class="agenda-card">
                        <div class="p-6">
                            <div class="flex items-start space-x-6">
                                <!-- Date Badge -->
                                <div class="date-badge">
                                    <span class="block text-3xl font-bold">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}
                                    </span>
                                    <span class="block text-sm uppercase">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal)->format('M Y') }}
                                    </span>
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $agenda->judul }}</h2>
                                    <p class="text-gray-600 mb-4">{{ $agenda->deskripsi }}</p>

                                    <!-- Time and Location -->
                                    <div class="flex flex-wrap gap-4 mb-4">
                                        <span class="flex items-center text-gray-500">
                                            <i class="far fa-clock mr-2 text-blue-500"></i>
                                            {{ $agenda->waktu ?? '08:00' }} WIB
                                        </span>
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                            {{ $agenda->lokasi ?? 'SMKN 4 Bogor' }}
                                        </span>
                                        @if($agenda->kategori)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-tag mr-2"></i>
                                                {{ $agenda->kategori }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- View Detail Button -->
                                    <a href="{{ route('web.agenda.show', $agenda->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300">
                                        <span>Lihat Detail</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-8">
        <div class="container mx-auto text-center">
            <div class="mb-4">
                  <img src="{{ asset('assets/images/logo/logo.png') }}"
                     alt="Logo SMKN 4 Bogor"
                     class="h-12 mx-auto">
            </div>
            <p class="text-sm mb-2">
                SMKN 4 Bogor, Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara Sari,
                Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137
            </p>
            <p class="text-sm">© 2024 SMKN 4 Bogor. All rights reserved.</p>

            <!-- Media Sosial dan Email -->
            <div class="flex justify-center space-x-6 mt-6">
                <a href="https://web.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/"
                   class="text-gray-400 hover:text-blue-600"
                   aria-label="Facebook"
                   target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/smkn4kotabogor/"
                   class="text-gray-400 hover:text-pink-500"
                   aria-label="Instagram"
                   target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com"
                   class="text-gray-400 hover:text-blue-400"
                   aria-label="Twitter"
                   target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/@smknegeri4bogor905"
                   class="text-gray-400 hover:text-red-500"
                   aria-label="YouTube"
                   target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="mailto:smkn4@smkn4bogor.sch.id"
                   class="text-gray-400 hover:text-yellow-400"
                   aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
