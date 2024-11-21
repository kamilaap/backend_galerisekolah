<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $informasi->judul }} - Detail Informasi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Update navbar styling */
        .navbar-blur {
            background: linear-gradient(to right, #0c4a6e, #075985);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Update body dan main styling untuk footer */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Update footer styling */
        footer {
            width: 100%;
            margin-top: auto;
            background: linear-gradient(to right, #0c4a6e, #075985);
        }

        /* Hapus backdrop-filter dari navbar */
        .navbar-blur {
            backdrop-filter: none;
        }

        /* Tambahan style lainnya tetap sama */
        .hero-section {
            position: relative;
            height: 70vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ $informasi->image }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
        }

        .nav-button {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .nav-button:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="navbar-blur sticky top-0 z-50">
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
    <div class="hero-section flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">{{ $informasi->judul }}</h1>
            <div class="flex items-center justify-center space-x-4 text-lg" data-aos="fade-up" data-aos-delay="100">
                <span class="flex items-center">
                    <i class="far fa-calendar-alt mr-2"></i>
                    {{ date('d M Y', strtotime($informasi->created_at)) }}
                </span>
                <span class="flex items-center">
                    <i class="far fa-clock mr-2"></i>
                    {{ date('H:i', strtotime($informasi->created_at)) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <a href="{{ route('web.informasi.index') }}"
           class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300"
           data-aos="fade-right">
            <i class="fas fa-arrow-left mr-2 text-blue-600"></i>
            <span>Kembali ke Informasi</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="content-card rounded-xl p-8 mb-8" data-aos="fade-up">
            <!-- Share Buttons -->
            <div class="flex items-center justify-between mb-8 pb-4 border-b">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                       target="_blank"
                       class="share-button text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $informasi->judul }}"
                       target="_blank"
                       class="share-button text-blue-400 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="https://wa.me/?text={{ $informasi->judul }}%20{{ url()->current() }}"
                       target="_blank"
                       class="share-button text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-50">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                </div>

                <!-- Download Button -->
                <a href="{{ route('download.informasi.photo', $informasi->id) }}"
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-download mr-2"></i>
                    <span>Download Gambar</span>
                </a>
            </div>

            <!-- Content -->
            <div class="prose max-w-none" data-aos="fade-up" data-aos-delay="100">
                <p class="text-gray-700 leading-relaxed text-lg">{{ $informasi->deskripsi }}</p>
            </div>

        <!-- Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            @if($prevInfo = \App\Models\Informasi::where('id', '<', $informasi->id)->orderBy('id', 'desc')->first())
            <a href="{{ route('web.informasi.show', $prevInfo->id) }}"
               class="nav-button p-6 rounded-xl group hover:shadow-lg"
               data-aos="fade-right">
                <div class="flex items-start space-x-4">
                    <div class="text-blue-600 group-hover:transform group-hover:-translate-x-2 transition-transform">
                        <i class="fas fa-arrow-left text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Informasi Sebelumnya</p>
                        <h3 class="font-semibold text-gray-800">{{ $prevInfo->judul }}</h3>
                    </div>
                </div>
            </a>
            @endif

            @if($nextInfo = \App\Models\Informasi::where('id', '>', $informasi->id)->orderBy('id')->first())
            <a href="{{ route('web.informasi.show', $nextInfo->id) }}"
               class="nav-button p-6 rounded-xl group hover:shadow-lg text-right"
               data-aos="fade-left">
                <div class="flex items-start justify-end space-x-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Informasi Selanjutnya</p>
                        <h3 class="font-semibold text-gray-800">{{ $nextInfo->judul }}</h3>
                    </div>
                    <div class="text-blue-600 group-hover:transform group-hover:translate-x-2 transition-transform">
                        <i class="fas fa-arrow-right text-2xl"></i>
                    </div>
                </div>
            </a>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-8 w-full">
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
