<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg"
        href="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMKN 4 Kota Bogor</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
           /* Pastikan gambar dan teks terpisah sesuai dengan desain */
 /* Kontainer animasi untuk menjaga agar teks bergerak penuh dari luar layar */
 @keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

.animate-marquee {
    animation: marquee 30s linear infinite;
}

.animate-marquee:hover {
    animation-play-state: paused;
}

/* Tambahkan animasi untuk informasi section */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.slide-in-right {
    animation: slideInRight 0.5s ease-out forwards;
}

.informasi-auto-scroll {
    height: 400px;
    overflow-y: hidden;
}

.informasi-content {
    animation: autoScroll 20s linear infinite;
}

@keyframes autoScroll {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-100%);
    }
}

        /* Ukuran gambar informasi */
        .informasi-item img {
            width: 100%;
            height: 400px;
            /* Menambah tinggi gambar menjadi 400px */
            object-fit: cover;
        }
        /* Slider CSS */
.swiper-container {
    height: 700px; /* Atur tinggi slider sesuai kebutuhan, lebih besar dari sebelumnya */
}

.swiper-slide img {
    width: 100%;
    height: 100%; /* Pastikan gambar memenuhi area slider */
    object-fit: cover; /* Memastikan gambar terpotong dengan proporsional */
}
.btn-view-gallery {
    display: inline-block;
    padding: 10px 20px;
    background-color: #40534c; /* Warna sesuai dengan palet */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-view-gallery:hover {
    background-color: #1a3636; /* Warna saat hover */
}

        /* Tambahkan style untuk efek hover dan animasi */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .gradient-text {
            background: linear-gradient(45deg, #4F46E5, #2563EB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-shadow {
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }

        .card-shadow:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        /* Efek parallax untuk banner */
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Animasi untuk counter */
        @keyframes countUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .counter {
            animation: countUp 1s ease-out forwards;
        }

        /* Tambahkan style untuk background dan efek visual */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            position: relative;
            overflow-x: hidden;
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

        .bg-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .bg-shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 50%;
            right: -100px;
            animation-delay: -5s;
        }

        .bg-shape:nth-child(3) {
            width: 250px;
            height: 250px;
            bottom: -125px;
            left: 30%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            25% {
                transform: translateY(-20px) rotate(5deg);
            }
            50% {
                transform: translateY(0) rotate(0deg);
            }
            75% {
                transform: translateY(20px) rotate(-5deg);
            }
        }

        /* Card styling improvements */
        .card-shadow {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Section backgrounds */
        section {
            position: relative;
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(37, 99, 235, 0.05) 100%);
            z-index: -1;
        }

        /* Navbar improvement */
        .navbar-blur {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
        }

        /* Footer improvement */
        footer {
            background: linear-gradient(to right, #1e3a8a, #1e40af);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 45%, rgba(255,255,255,0.1) 48%, rgba(255,255,255,0.1) 52%, transparent 55%);
            background-size: 200% 200%;
            animation: shine 10s linear infinite;
        }

        @keyframes shine {
            to {
                background-position: 200% 200%;
            }
        }

        /* Swiper custom styles */
        .informasiSwiper {
            padding: 20px 0 40px 0;
        }

        .informasiSwiper .swiper-button-next,
        .informasiSwiper .swiper-button-prev {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .informasiSwiper .swiper-button-next:hover,
        .informasiSwiper .swiper-button-prev:hover {
            background-color: #f8fafc;
            transform: scale(1.1);
        }

        .informasiSwiper .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background-color: #e2e8f0;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .informasiSwiper .swiper-pagination-bullet-active {
            background-color: #3b82f6;
            width: 24px;
            border-radius: 5px;
        }

        /* Hover effects for cards */
        .informasiSwiper .swiper-slide {
            transition: transform 0.3s ease;
        }

        .informasiSwiper .swiper-slide:hover {
            transform: translateY(-5px);
        }

        /* Update existing styles */
        .informasiSwiper {
            height: 600px; /* Sesuaikan dengan tinggi yang diinginkan */
        }

        .informasiSwiper .swiper-slide {
            height: 100%;
        }

        .informasiSwiper .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .informasiSwiper .swiper-pagination-bullet-active {
            background-color: #ffffff;
            width: 24px;
            border-radius: 5px;
        }

        .informasiSwiper .swiper-button-next,
        .informasiSwiper .swiper-button-prev {
            opacity: 0;
            transition: all 0.3s ease;
        }

        .informasiSwiper:hover .swiper-button-next,
        .informasiSwiper:hover .swiper-button-prev {
            opacity: 1;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Tambahan untuk efek backdrop blur */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        /* Agenda card animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .agenda-card {
            animation: slideIn 0.5s ease forwards;
        }

        .agenda-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="bg-shapes">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar-blur sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <!-- Desktop Navbar -->
            <div class="flex justify-between items-center h-20">
                <!-- Logo dan Nama -->
                <div class="flex items-center space-x-4">
                    <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg"
                         alt="Logo SMKN 4 Bogor"
                         class="h-12 w-auto hover:scale-105 transition-transform duration-300">
                    <div>
                        <a href="{{ route('welcome') }}"
                           class="text-white font-bold text-xl hover:text-yellow-300 transition-colors duration-300">
                            SMK INDONESIA DIGITAL
                        </a>
                        <p class="text-blue-200 text-sm">Unggul dalam Digital, Berkarakter dalam Akhlak</p>
                    </div>
                </div>

                <!-- Search Bar -->
                <form id="search-form" action="{{ route('search') }}" method="GET"
                      class="hidden md:flex items-center">
                    <div class="relative">
                        <input type="text" name="query"
                               placeholder="Cari informasi..."
                               class="bg-blue-800/50 text-white placeholder-blue-300 px-6 py-2 rounded-full w-64 focus:w-80 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <button type="submit"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-300 hover:text-yellow-400 transition-colors duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('web.informasi.index') }}"
                       class="text-white group flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                        <i class="fas fa-info-circle transform group-hover:scale-110 transition-transform"></i>
                        <span>Informasi</span>
                    </a>
                    <a href="{{ route('web.agenda.index') }}"
                       class="text-white group flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                        <i class="fas fa-calendar-alt transform group-hover:scale-110 transition-transform"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="{{ route('web.galery.index') }}"
                       class="text-white group flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                        <i class="fas fa-images transform group-hover:scale-110 transition-transform"></i>
                        <span>Galeri</span>
                    </a>

                    <!-- Auth Buttons/Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-white hover:text-yellow-300 transition-colors duration-300">
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
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard.index') }}"
                                       class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('web.profile') }}"
                                       class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                                        <i class="fas fa-user-circle mr-2"></i>Profile
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-yellow-400 text-blue-900 px-6 py-2 rounded-full font-semibold hover:bg-yellow-300 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white hover:text-yellow-300 transition-colors duration-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>




    <!-- Banner Slider Section -->
    <section class="relative parallax">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-black/70 z-10"></div>
        <div class="absolute inset-0 flex items-center justify-center z-20">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-5xl font-bold text-white text-center mb-4">
                    Selamat Datang Di SMKN 4 Kota Bogor
                </h1>
                <p class="text-xl text-white/90 text-center">
                    Membangun Generasi Digital yang Unggul dan Berkarakter
                </p>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                <div class="swiper-slide">
                    <a href="{{ $slider->link }}" target="_blank">
                        <img src="{{ $slider->image }}" alt="Slider Image">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

   <!-- Scrolling Title for Informasi Terbaru -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8 relative overflow-hidden rounded-lg shadow-xl my-6">
    <!-- Header dengan waktu -->
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-white text-gray-800 px-8 py-3 rounded-b-xl shadow-lg">
        <div class="flex items-center space-x-2">
            <i class="fas fa-clock text-blue-600"></i>
            <p class="font-semibold">{{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y H:i') }} WIB</p>
        </div>
    </div>

    <!-- Label Informasi Terkini -->
    <div class="container mx-auto px-4 pt-12">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-yellow-400 text-blue-900 px-6 py-2 rounded-full shadow-lg flex items-center space-x-2">
                <i class="fas fa-newspaper text-xl"></i>
                <span class="font-bold text-lg">INFORMASI TERKINI</span>
            </div>
        </div>

        <!-- Scrolling Content -->
        <div class="overflow-hidden w-full">
            <div class="whitespace-nowrap animate-marquee">
                <div class="inline-flex items-center space-x-8">
                    @foreach($informasi as $info)
                    <div class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full">
                        <i class="fas fa-arrow-right text-yellow-400"></i>
                        <a href="{{ route('web.informasi.show', $info->id) }}"
                           class="text-lg font-semibold hover:text-yellow-300 transition duration-300">
                            {{ $info->judul }}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="flex justify-center mt-6 space-x-4">
            <a href="{{ route('web.informasi.index') }}"
               class="bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition duration-300 flex items-center space-x-2 shadow-lg">
                <i class="fas fa-list"></i>
                <span>Lihat Semua Informasi</span>
            </a>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="absolute -right-10 top-1/2 transform -translate-y-1/2 opacity-10">
        <i class="fas fa-newspaper text-9xl"></i>
    </div>
    <div class="absolute -left-10 top-1/2 transform -translate-y-1/2 opacity-10">
        <i class="fas fa-bullhorn text-9xl"></i>
    </div>
</div>


  <!-- Galery Section -->
<!-- Galery Section -->
<section class="my-16 px-8" data-aos="fade-up">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4 gradient-text">Galeri Terbaru</h2>
            <p class="text-gray-600">Dokumentasi kegiatan dan momen berharga SMKN 4 Bogor</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($photos as $photo)
            <div class="relative bg-white rounded-xl overflow-hidden card-shadow group transform hover:-translate-y-2 transition-all duration-300">
                <!-- Image Container -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $photo->image }}"
                         alt="{{ $photo->judul }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">

                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Stats Container -->
                    <div class="absolute top-4 right-4 flex flex-col space-y-2">
                        <!-- Comments Counter -->
                        <div class="bg-white/90 backdrop-blur text-gray-800 text-xs font-semibold rounded-full px-3 py-1 shadow-lg flex items-center space-x-1">
                            <i class="fas fa-comment text-blue-500"></i>
                            <span>{{ $photo->comments_count ?? 0 }}</span>
                        </div>

                        <!-- Views Counter -->
                        <div class="bg-white/90 backdrop-blur text-gray-800 text-xs font-semibold rounded-full px-3 py-1 shadow-lg flex items-center space-x-1">
                            <i class="fas fa-eye text-green-500"></i>
                            <span>{{ $photo->views->count() }}</span>
                        </div>

                        <!-- Likes Counter -->
                        <div class="bg-white/90 backdrop-blur text-gray-800 text-xs font-semibold rounded-full px-3 py-1 shadow-lg flex items-center space-x-1">
                            <i class="fas fa-heart text-red-500"></i>
                            <span>{{ $photo->likes_count }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                        {{ $photo->judul }}
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $photo->created_at->format('d M Y') }}
                        </span>
                        <a href="{{ route('web.galery.photo', $photo->id) }}"
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lihat Detail
                            <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('web.galery.index') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                <span class="mr-2">Lihat Semua Galeri</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Tambahkan setelah section Galeri -->
<section class="py-12 bg-gradient-to-r from-blue-900 to-blue-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Tag Populer</h2>
            <p class="text-blue-200">Tag yang sering digunakan dalam postingan</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            @php
                $popularTags = \App\Models\Tag::withCount(['informasi', 'agenda', 'galeries'])
                    ->having('informasi_count', '>', 0)
                    ->orHaving('agenda_count', '>', 0)
                    ->orHaving('galeries_count', '>', 0)
                    ->orderByRaw('(informasi_count + agenda_count + galeries_count) DESC')
                    ->limit(10)
                    ->get();
            @endphp

            @foreach($popularTags as $tag)
                @php
                    $totalUses = $tag->informasi_count + $tag->agenda_count + $tag->galeries_count;
                @endphp
                <div class="group relative">
                    <a href="{{ route('search', ['tag' => $tag->slug]) }}"
                       class="inline-flex items-center px-6 py-2 bg-white/10 text-white rounded-full hover:bg-white/20 transition-all duration-300">
                        <span class="text-lg">#{{ $tag->name }}</span>
                        <span class="ml-2 bg-white/20 px-2 py-0.5 rounded-full text-sm">
                            {{ $totalUses }}
                        </span>
                    </a>
                    <!-- Tooltip -->
                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 bg-white text-gray-800 text-sm rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap">
                        <div class="text-xs">
                            @if($tag->informasi_count > 0)
                                <span class="mr-2">Informasi: {{ $tag->informasi_count }}</span>
                            @endif
                            @if($tag->agenda_count > 0)
                                <span class="mr-2">Agenda: {{ $tag->agenda_count }}</span>
                            @endif
                            @if($tag->galeries_count > 0)
                                <span>Galeri: {{ $tag->galeries_count }}</span>
                            @endif
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-2 h-2 bg-white rotate-45"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tag Categories -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <!-- Informasi Tags -->
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Tag Informasi
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($popularTags->where('informasi_count', '>', 0)->take(5) as $tag)
                        <a href="{{ route('search', ['tag' => $tag->slug, 'type' => 'informasi']) }}"
                           class="px-3 py-1 bg-white/10 text-white rounded-full text-sm hover:bg-white/20 transition-colors">
                            #{{ $tag->name }}
                            <span class="text-xs">({{ $tag->informasi_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Agenda Tags -->
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Tag Agenda
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($popularTags->where('agenda_count', '>', 0)->take(5) as $tag)
                        <a href="{{ route('search', ['tag' => $tag->slug, 'type' => 'agenda']) }}"
                           class="px-3 py-1 bg-white/10 text-white rounded-full text-sm hover:bg-white/20 transition-colors">
                            #{{ $tag->name }}
                            <span class="text-xs">({{ $tag->agenda_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Galeri Tags -->
            <div class="bg-white/10 backdrop-blur p-6 rounded-xl">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-images mr-2"></i>
                    Tag Galeri
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($popularTags->where('galeries_count', '>', 0)->take(5) as $tag)
                        <a href="{{ route('search', ['tag' => $tag->slug, 'type' => 'galeri']) }}"
                           class="px-3 py-1 bg-white/10 text-white rounded-full text-sm hover:bg-white/20 transition-colors">
                            #{{ $tag->name }}
                            <span class="text-xs">({{ $tag->galeries_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Informasi and Agenda Section -->
    <div class="container mx-auto py-8 flex flex-col md:flex-row gap-6">
      <!-- Informasi Section -->
<div class="md:w-2/3">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
        <!-- Header Section with Animation -->
        <div class="flex flex-col md:flex-row justify-between items-center p-8 space-y-4 md:space-y-0">
            <div class="flex items-center space-x-3" data-aos="fade-right">
                <div class="bg-blue-600 p-3 rounded-lg">
                    <i class="fas fa-newspaper text-2xl text-white"></i>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    Informasi Terbaru
                </h2>
            </div>
            <a href="{{ route('web.informasi.index') }}"
               class="group flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-300"
               data-aos="fade-left">
                <span>Lihat Semua</span>
                <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Swiper Container with Enhanced Styling -->
        <div class="swiper informasiSwiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                @foreach($informasi as $info)
                <div class="swiper-slide">
                    <div class="relative h-[600px] group">
                        <!-- Full Image Background -->
                        <img src="{{ $info->image }}"
                             alt="{{ $info->judul }}"
                             class="w-full h-full object-cover">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60"></div>

                        <!-- Content Overlay -->
                        <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                            <!-- Top Badges -->
                            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                                <!-- Category Badge -->
                                <div class="bg-blue-600/90 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $info->category ?? 'Umum' }}
                                </div>

                                <!-- Date Badge -->
                                <div class="bg-white/90 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                                    <i class="far fa-calendar-alt text-blue-600 mr-1"></i>
                                    {{ $info->created_at->locale('id')->format('d M Y') }}
                                </div>
                            </div>

                            <!-- Title and Description -->
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 text-white">
                                {{ $info->judul }}
                            </h3>
                            <p class="text-white/90 mb-4 line-clamp-2 text-lg">
                                {{ Str::limit($info->deskripsi, 150) }}
                            </p>

                            <!-- Tags Section -->
                            @if($info->hashtags->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($info->hashtags as $hashtag)
                                <a href="{{ route('hashtag.show', $hashtag->name) }}"
                                   class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm hover:bg-white/30 transition-colors duration-300 flex items-center space-x-1">
                                    <i class="fas fa-hashtag text-xs"></i>
                                    <span>{{ $hashtag->name }}</span>
                                </a>
                                @endforeach
                            </div>
                            @endif

                            <!-- Footer Section -->
                            <div class="flex items-center justify-between pt-4 border-t border-white/20">
                                <!-- Author Info -->
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $info->user->avatar ?? 'https://ui-avatars.com/api/?name=Admin' }}"
                                         alt="Author"
                                         class="w-10 h-10 rounded-full border-2 border-white">
                                    <div>
                                        <p class="font-semibold">{{ $info->user->name ?? 'Admin' }}</p>
                                        <p class="text-sm text-white/80">{{ $info->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <!-- Read More Button -->
                                <a href="{{ route('web.informasi.show', $info->id) }}"
                                   class="group bg-white/20 backdrop-blur-sm hover:bg-white/30 px-6 py-2 rounded-full flex items-center space-x-2 transition-all duration-300">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Enhanced Navigation Buttons -->
            <div class="swiper-button-next !w-12 !h-12 !bg-white/80 backdrop-blur !rounded-full !shadow-lg after:!text-2xl after:!text-blue-600">
                <i class="fas fa-chevron-right text-blue-600"></i>
            </div>
            <div class="swiper-button-prev !w-12 !h-12 !bg-white/80 backdrop-blur !rounded-full !shadow-lg after:!text-2xl after:!text-blue-600">
                <i class="fas fa-chevron-left text-blue-600"></i>
            </div>

            <!-- Enhanced Pagination -->
            <div class="swiper-pagination !bottom-4"></div>
        </div>
    </div>
</div>

          <!-- Agenda Sekolah Section -->
<div class="md:w-1/3 bg-white rounded-xl p-8 card-shadow" data-aos="fade-left">
    <h2 class="text-xl font-bold mb-4 text-center">Agenda Sekolah</h2>
    <div class="space-y-4">
        @foreach($agenda as $item)
        <div class="bg-blue-50 border border-blue-300 rounded-lg p-4">
            <h3 class="font-semibold text-lg text-blue-700 mb-2">{{ $item->judul }}</h3>
            <p class="text-sm text-gray-500 mb-1">Tanggal: {{ $item->tanggal }}</p>
            <p class="text-gray-600 mb-2">{{ Str::limit($item->deskripsi, 100) }}</p>
            <a href="{{ route('web.agenda.show', $item->id) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600 transition duration-200">Detail</a>
        </div>
        @endforeach
    </div>
</div>


    </div>
    <!-- Google Maps Section -->
<section id="maps" class="py-4 -mt-2"> <!-- Mengurangi jarak dari navbar -->
    <div class="w-full h-80"> <!-- Tinggi peta lebih kecil -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31722.047149155723!2d106.815542!3d-6.6407334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1693082189497!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</section>

  <!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
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

<!-- Font Awesome untuk Ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>

        // Initialize Swipers with individual configurations if required
        const mainSwiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        const infoSwiper = new Swiper('.informasi-swiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

       // Function to display current date and time
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('id-ID', options);
    }

    // Update date and time on page load
    document.addEventListener('DOMContentLoaded', () => {
        updateDateTime();
        // Initialize Swipers here if needed
    });

    AOS.init({
        duration: 800,
        once: true
    });

    // Tambahkan smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Initialize Informasi Swiper
    const informasiSwiper = new Swiper('.informasiSwiper', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    // Pause autoplay on hover
    const swiperContainer = document.querySelector('.informasiSwiper');
    swiperContainer.addEventListener('mouseenter', () => {
        informasiSwiper.autoplay.stop();
    });
    swiperContainer.addEventListener('mouseleave', () => {
        informasiSwiper.autoplay.start();
    });

    </script>

</body>

</html>
