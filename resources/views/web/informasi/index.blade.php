<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Informasi - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            position: relative;
            overflow-x: hidden;
        }

        .card-shadow {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .navbar-blur {
            background: linear-gradient(to right, #0c4a6e, #075985);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-text {
            background: linear-gradient(45deg, #4F46E5, #2563EB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Animated background shapes */
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .bg-shape {
            position: absolute;
            background: linear-gradient(45deg, #4F46E5, #2563EB);
            border-radius: 50%;
            opacity: 0.05;
            animation: float 20s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(20px) rotate(-5deg); }
        }

        /* Navbar styling */
        .navbar-blur {
            background: linear-gradient(to right, #0c4a6e, #075985); /* Darker sky blue gradient */
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navigation link styling */
        .nav-link {
            position: relative;
            color: #e0f2fe; /* Light sky blue */
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
            background: #38bdf8; /* Sky blue 400 */
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: #38bdf8; /* Sky blue 400 */
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Search bar styling */
        .search-input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #e0f2fe; /* Light sky blue */
        }

        .search-input::placeholder {
            color: rgba(224, 242, 254, 0.6); /* Light sky blue with opacity */
        }

        /* Logo section styling */
        .logo-text {
            color: #f0f9ff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo-subtitle {
            color: #bfdbfe;
            font-weight: 500;
        }

        /* Auth button styling */
        .auth-button {
            background: #38bdf8; /* Sky blue 400 */
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-button:hover {
            background: #0ea5e9; /* Sky blue 500 */
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Profile dropdown styling */
        .profile-dropdown {
            background: #0c4a6e; /* Sky blue 900 */
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-dropdown a,
        .profile-dropdown button {
            color: #e0f2fe; /* Light sky blue */
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: #075985; /* Sky blue 800 */
            color: #38bdf8; /* Sky blue 400 */
        }
    </style>
</head>
<body>
    <!-- Background Shapes -->
    <div class="bg-shapes">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

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

    <!-- Tambahkan setelah bagian header -->
    <div class="relative bg-blue-900 text-white py-20 mb-12">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-700 opacity-90"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">Informasi SMKN 4 Bogor</h1>
            <p class="text-xl text-blue-100 mb-8" data-aos="fade-up" data-aos-delay="100">
                Tetap update dengan informasi terkini seputar sekolah kami
            </p>

            <!-- Back Button -->
            <div class="mb-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center px-6 py-3 bg-white/10 text-white rounded-full hover:bg-white/20 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="max-w-md mx-auto" data-aos="fade-up" data-aos-delay="300">
                <div class="relative">
                    <input type="text" id="info-search"
                           class="w-full px-6 py-3 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Cari Berdasarkan Kategori.....">
                    <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-white/60"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid Informasi -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($informasi as $info)
            <div class="card-shadow rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative group">
                    <img src="{{ $info->image }}"
                         alt="{{ $info->judul }}"
                         class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white text-xl font-bold mb-2">{{ $info->judul }}</h3>
                            <p class="text-white/80 text-sm">{{ Str::limit($info->deskripsi, 100) }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ date('d M Y', strtotime($info->created_at)) }}</span>
                        <span class="mx-2">•</span>
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ date('H:i', strtotime($info->created_at)) }}</span>
                    </div>

                    <h2 class="text-xl font-bold mb-3 hover:text-blue-600 transition-colors">{{ $info->judul }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($info->deskripsi, 150) }}</p>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('web.informasi.show', $info->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>

                        <!-- Share Buttons -->
                        <div class="flex space-x-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('web.informasi.show', $info->id)) }}"
                               target="_blank"
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('web.informasi.show', $info->id)) }}&text={{ urlencode($info->judul) }}"
                               target="_blank"
                               class="p-2 text-blue-400 hover:bg-blue-50 rounded-full transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($info->judul . ' ' . route('web.informasi.show', $info->id)) }}"
                               target="_blank"
                               class="p-2 text-green-600 hover:bg-green-50 rounded-full transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>
