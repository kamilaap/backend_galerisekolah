<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Tambahkan Isotope untuk filter -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <style>
        /* Style yang sudah ada */

        /* Tambahkan style untuk filter buttons */
        .filter-button {
            transition: all 0.3s ease;
            position: relative;
        }

        .filter-button::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: #3B82F6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .filter-button.active::after {
            width: 100%;
        }

        /* Style untuk gallery items */
        .gallery-item {
            transition: all 0.5s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* Loading animation */
        .loading-overlay {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar sama seperti sebelumnya -->

    <!-- Hero Section -->
    <div class="relative bg-blue-900 text-white py-20">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-700 opacity-90"></div>
            <!-- Pattern Background -->
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,...'); opacity: 0.1;"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">Galeri SMKN 4 Bogor</h1>
            <p class="text-xl text-blue-100 mb-8" data-aos="fade-up" data-aos-delay="100">
                Momen-momen berharga dalam perjalanan pendidikan kami
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
                    <input type="text" id="gallery-search"
                           class="w-full px-6 py-3 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Cari galeri...">
                    <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-white/60"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="gallery-grid">
            @foreach($galeries as $galery)
            <div class="gallery-item {{ $galery->kategori ?? 'umum' }} rounded-xl overflow-hidden shadow-lg bg-white"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative group">
                    <img src="{{ $galery->photos->first()?->image ?? 'default.jpg' }}"
                         alt="{{ $galery->judul }}"
                         class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">

                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $galery->judul }}</h3>
                            <p class="text-white/80 text-sm mb-4">{{ Str::limit($galery->deskripsi, 100) }}</p>

                            <div class="flex items-center space-x-4">
                                <span class="text-white/80 text-sm">
                                    <i class="fas fa-image mr-1"></i>
                                    {{ $galery->photos->count() }} Foto
                                </span>
                                <span class="text-white/80 text-sm">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ date('d M Y', strtotime($galery->created_at)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ $galery->judul }}</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                            {{ $galery->kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <a href="{{ route('web.galery.photo', $galery->id) }}"
                       class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors">
                        <span>Lihat Galeri</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="text-center">
            <div class="loading-spinner w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full"></div>
            <p class="mt-4 text-lg text-gray-700">Memuat galeri...</p>
        </div>
    </div>

    <!-- Footer sama seperti sebelumnya -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Initialize Isotope
        let iso;
        document.addEventListener('DOMContentLoaded', function() {
            const grid = document.querySelector('#gallery-grid');
            iso = new Isotope(grid, {
                itemSelector: '.gallery-item',
                layoutMode: 'fitRows'
            });

            // Filter functionality
            document.querySelectorAll('.filter-button').forEach(button => {
                button.addEventListener('click', function() {
                    const filterValue = this.getAttribute('data-filter');

                    // Show loading overlay
                    document.querySelector('.loading-overlay').classList.remove('hidden');

                    // Update active state
                    document.querySelectorAll('.filter-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Filter items
                    setTimeout(() => {
                        if (filterValue === '*') {
                            iso.arrange({ filter: null });
                        } else {
                            iso.arrange({ filter: filterValue });
                        }
                        document.querySelector('.loading-overlay').classList.add('hidden');
                    }, 500);
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
