<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri - SMKN 4 Bogor</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Isotope -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <style>
        /* Menggunakan style yang sama dengan welcome.blade.php */
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --accent: #60a5fa;
        }

        .navbar-blur {
            background: linear-gradient(to right, #1e3a8a, #1e40af);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Copy semua style dari welcome.blade.php */
        /* ... */

        /* Tambahan style khusus untuk galeri */
        .gallery-card {
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .filter-button {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filter-button.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .filter-button:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .search-bar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .search-bar:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar - Copy langsung dari welcome.blade.php -->
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
    <div class="relative bg-gradient-to-r from-blue-900 to-blue-800 text-white py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-blue-900/50"></div>
            <!-- Pattern Background -->
            <div class="absolute inset-0 opacity-10"
                 style="background-image: url('data:image/svg+xml,...');"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6" data-aos="fade-up">
                Galeri SMKN 4 Bogor
            </h1>
            <p class="text-xl text-blue-100 mb-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Momen-momen berharga dalam perjalanan pendidikan kami
            </p>

            <!-- Search Bar -->
            <div class="max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="relative">
                    <input type="text" id="gallery-search"
                           class="w-full px-6 py-4 rounded-full search-bar text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Cari galeri...">
                    <i class="fas fa-search absolute right-6 top-1/2 transform -translate-y-1/2 text-white/60"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up">
            <button class="filter-button active" data-filter="*">
                Semua
            </button>
            <button class="filter-button" data-filter=".kegiatan">
                Kegiatan
            </button>
            <button class="filter-button" data-filter=".prestasi">
                Prestasi
            </button>
            <button class="filter-button" data-filter=".fasilitas">
                Fasilitas
            </button>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
            @foreach($galeries as $galery)
            <div class="gallery-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image -->
                <img src="{{ $galery->photos->first()?->image ?? 'default.jpg' }}"
                     alt="{{ $galery->judul }}"
                     class="gallery-image">

                <!-- Overlay -->
                <div class="gallery-overlay">
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $galery->judul }}</h3>
                    <p class="text-white/80 mb-4">{{ Str::limit($galery->deskripsi, 100) }}</p>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-4">
                            <span class="text-white/80 text-sm">
                                <i class="fas fa-image mr-1"></i>
                                {{ $galery->photos->count() }} Foto
                            </span>
                            <span class="text-white/80 text-sm">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $galery->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <a href="{{ route('web.galery.photo', $galery->id) }}"
                           class="inline-flex items-center bg-white/20 hover:bg-white/30 px-4 py-2 rounded-full text-white transition-all duration-300">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer - Copy langsung dari welcome.blade.php -->
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
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Initialize Isotope
        document.addEventListener('DOMContentLoaded', function() {
            const grid = document.querySelector('#gallery-grid');
            const iso = new Isotope(grid, {
                itemSelector: '.gallery-card',
                layoutMode: 'fitRows'
            });

            // Filter functionality
            document.querySelectorAll('.filter-button').forEach(button => {
                button.addEventListener('click', function() {
                    const filterValue = this.getAttribute('data-filter');

                    // Update active state
                    document.querySelectorAll('.filter-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Filter items
                    iso.arrange({ filter: filterValue === '*' ? null : filterValue });
                });
            });

            // Search functionality
            const searchInput = document.querySelector('#gallery-search');
            searchInput.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                iso.arrange({
                    filter: function(itemElem) {
                        const title = itemElem.querySelector('h3').textContent.toLowerCase();
                        return title.includes(searchText);
                    }
                });
            });
        });
    </script>
</body>
</html>
