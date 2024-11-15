<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
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
    <nav class="navbar-blur sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo SMKN 4 Bogor" class="h-10 mr-2">
                <a href="#" class="text-white font-bold text-lg">SMK INDONESIA DIGITAL</a>
            </div>

            <!-- Form Pencarian dengan Tailwind CSS -->
            <form id="search-form" action="{{ route('search') }}" method="GET" class="flex items-center bg-gray-700 rounded-lg overflow-hidden">
                <input type="text" name="query" placeholder="Cari..." class="bg-transparent text-white px-4 py-1 outline-none" required>
                <button type="submit" class="text-white px-3 hover:bg-gray-600 transition duration-300">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="flex items-center space-x-6">
                <a href="{{ route('web.informasi.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-info-circle"></i>
                    <span>Informasi</span>
                </a>
                <a href="{{ route('web.agenda.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Agenda</span>
                </a>
                <a href="{{ route('web.galery.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
            </div>

            <div>
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Login</a>
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
                           placeholder="Cari informasi...">
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
    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white mt-16">
        <div class="container mx-auto text-center">
            <div class="mb-4">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo SMKN 4 Bogor" class="h-12 mx-auto">
            </div>
            <p class="text-sm mb-2">
                SMKN 4 Bogor, Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara Sari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137
            </p>
            <p class="text-sm">
                © 2024 SMKN 4 Bogor. All rights reserved.
            </p>

            <!-- Media Sosial dan Email -->
            <div class="flex justify-center space-x-6 mt-6">
                <a href="https://web.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" class="text-gray-400 hover:text-blue-600" aria-label="Facebook" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/smkn4kotabogor/" class="text-gray-400 hover:text-pink-500" aria-label="Instagram" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com" class="text-gray-400 hover:text-blue-400" aria-label="Twitter" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/@smknegeri4bogor905" class="text-gray-400 hover:text-red-500" aria-label="YouTube" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="mailto:smkn4@smkn4bogor.sch.id" class="text-gray-400 hover:text-yellow-400" aria-label="Email">
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
