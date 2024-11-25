<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg"
        href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edu Galery</title>
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
            background: linear-gradient(to right, #0c4a6e, #075985); /* Darker sky blue gradient */
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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

        .school-profile {
            background-color: #ffffff; /* Warna latar belakang putih untuk kontras */
            border-radius: 10px; /* Sudut yang lebih halus */
            padding: 20px; /* Ruang di dalam section */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        }

        .principal-photo {
            border: 4px solid #4F46E5; /* Border berwarna untuk foto kepala sekolah */
        }

        .description, .vision, .mission {
            text-align: justify; /* Rata kiri dan kanan untuk teks */
        }

        iframe {
            max-width: 100%; /* Responsif untuk video */
            height: auto; /* Tinggi otomatis */
        }

        /* Custom color variables */
        :root {
            --primary: #2563eb;      /* Biru lebih cerah */
            --primary-dark: #1e40af; /* Biru gelap */
            --secondary: #3b82f6;    /* Biru medium */
            --accent: #60a5fa;       /* Biru muda */
            --dark: #1e3a8a;         /* Biru sangat gelap */
            --light: #eff6ff;        /* Biru sangat muda */
        }

        /* Improved gradient backgrounds */
        .hero-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .card-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        /* Enhanced animations */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Improved text gradients */
        .gradient-text {
            background: linear-gradient(45deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced section styling */
        section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        /* Improved navbar */
        .navbar-blur {
            background: linear-gradient(to right, #1e3a8a, #1e40af);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Enhanced card designs */
        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Improved button styles */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        /* Enhanced jurusan card styling */
        .jurusan-card {
            height: 450px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .jurusan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Improved modal styling */
        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced footer styling */
        footer {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
        }

        /* Decorative elements */
        .decoration-dot {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--accent);
            opacity: 0.5;
        }

        /* Navbar link hover effect */
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

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #38bdf8; /* Sky blue 400 */
        }

        /* Search bar styling */
        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Jurusan card button styling */
        .jurusan-card .button-explore {
            background: #0ea5e9; /* Sky blue 500 */
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .jurusan-card .button-explore:hover {
            background: #0284c7; /* Sky blue 600 */
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        /* Auth button styling */
        .profile-button {
    transition: all 0.3s ease;
}

.profile-button:hover {
    transform: translateY(-2px);
}

.dropdown-menu {
    z-index: 50;
    min-width: 200px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

@media (max-width: 768px) {
    .dropdown-menu {
        position: absolute;
        right: 0;
        width: 100%;
        max-width: 300px;
    }
}

/* Auth button styling */
.auth-button {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.auth-button::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
    transform: translateX(-100%);
}

.auth-button:hover::after {
    transform: translateX(100%);
    transition: transform 0.6s ease;
}

/* Dropdown styling */
.dropdown-menu {
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
}

.dropdown-menu a:first-child {
    border-top-left-radius: 0.75rem;
    border-top-right-radius: 0.75rem;
}

.dropdown-menu button:last-child {
    border-bottom-left-radius: 0.75rem;
    border-bottom-right-radius: 0.75rem;
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

        /* Navigation link styling */
        .nav-link {
            color: #f0f9ff;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #93c5fd;
        }

        /* Search bar styling */
        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
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

        /* Profile button styling */
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

        /* Dropdown menu styling */
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

        /* Tambahkan style untuk aspect ratio */
        .aspect-w-16 {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        }

        .aspect-w-16 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Galeri card styling */
        .galeri-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .galeri-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Line clamp untuk membatasi teks */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Backdrop blur effect */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .maps-section {
            position: relative;
            z-index: 1;
        }

        .contact-form {
            position: relative;
            z-index: 10;
        }

        /* Pastikan form berada di atas elemen lain */
        input, textarea, button {
            position: relative;
            z-index: 20;
        }

        /* Hapus pointer-events dari elemen yang mungkin menutupi form */
        .background-elements {
            pointer-events: none;
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
                               placeholder="Cari berdasarkan kategori..."
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
                  <!-- Auth Buttons/Menu -->
@auth
    <div class="relative group">
        <button class="profile-button flex items-center space-x-2">
            @if(auth()->user()->avatar)
                <img src="{{ asset(auth()->user()->avatar) }}"
                     alt="Profile"
                     class="w-8 h-8 rounded-full border-2 border-white object-cover">
            @else
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white border-2 border-white">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
            <span class="text-white">{{ auth()->user()->name }}</span>
            <i class="fas fa-chevron-down text-sm text-white group-hover:rotate-180 transition-transform duration-300"></i>
        </button>
        <!-- Dropdown Menu -->
        <div class="dropdown-menu absolute right-0 mt-2 w-48 py-2 bg-white rounded-lg shadow-xl invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard.index') }}"
                   class="block px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    <span>Dashboard</span>
                </a>
            @else
                <a href="{{ route('web.profile') }}"
                   class="block px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300">
                    <i class="fas fa-user-circle mr-2"></i>
                    <span>Profile</span>
                </a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
@else
    <div class="flex items-center space-x-4">
        <a href="{{ route('login') }}"
           class="px-6 py-2 text-white hover:text-blue-200 transition-colors duration-300">
            Login
        </a>
        <a href="{{ route('register') }}"
           class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transform hover:-translate-y-0.5 transition-all duration-300 shadow-lg hover:shadow-xl">
            Register
        </a>
    </div>
@endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white hover:text-blue-200 transition-colors duration-300">
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
                    {{ $profil->welcome_title ?? 'Selamat Datang Di Edu Galery' }}
                </h1>
                <p class="text-xl text-white/90 text-center">
                    {{ $profil->welcome_subtitle ?? 'Membangun Generasi Digital yang Unggul dan Berkarakter' }}
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
 <!-- Profil Sekolah Section -->
<section class="school-profile my-16 px-8" data-aos="fade-up">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4 gradient-text">Profil Sekolah</h2>
            <p class="text-lg text-gray-600">
                <i class="fas fa-school text-blue-600"></i>
                {{ $profil->deskripsi ?? 'SMKN 4 Bogor merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Visi & Misi -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300">
                <h3 class="text-2xl font-bold mb-6 text-blue-800">Visi:</h3>
                <p class="vision mb-8 text-gray-700 leading-relaxed">
                    <i class="fas fa-bullseye text-blue-500 mr-2"></i>
                    {{ $profil->visi ?? 'Visi belum diatur' }}
                </p>

                <h3 class="text-2xl font-bold mb-6 text-blue-800">Misi:</h3>
                <div class="mission space-y-4">
                    {!! $profil->misi ?? 'Misi belum diatur' !!}
                </div>
            </div>

            <!-- Video Profile -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300">
                <h3 class="text-2xl font-bold mb-6 text-blue-800">Video Profile</h3>
                <div class="aspect-w-16 rounded-lg overflow-hidden shadow-lg">
                    @if($profil && $profil->video_url)
                        <iframe
                            src="{{ $profil->video_url }}"
                            title="Video Profile SMKN 4"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="w-full h-full">
                        </iframe>
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                            <p class="text-gray-500">Video belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Jurusan Section -->
<section class="py-16 px-8 relative" data-aos="fade-up">
    <!-- Decorative elements -->
    <div class="decoration-dot top-10 left-10 animate-pulse"></div>
    <div class="decoration-dot bottom-10 right-10 animate-pulse delay-300"></div>

    <div class="container mx-auto relative">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4 gradient-text">Program Keahlian</h2>
            <p class="text-gray-600 text-lg">Pilih jalur kesuksesanmu di SMKN 4 Bogor</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($jurusan as $jurusanItem)
            <div class="jurusan-card group">
                @php
                    $photo = $jurusanPhotos->firstWhere('judul', $jurusanItem->nama);
                @endphp

                <div class="relative h-full">
                    <!-- Image -->
                    <div class="absolute inset-0">
                        @if($photo)
                            <img src="{{ $photo->image }}"
                                 alt="{{ $jurusanItem->nama }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <img src="default-image-url.jpg"
                                 alt="Default Image"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @endif
                    </div>

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>

                    <!-- Content -->
                    <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                        <h3 class="text-2xl font-bold mb-2 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            {{ $jurusanItem->nama }}
                        </h3>

                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">
                            <button onclick="showJurusanDetail('{{ $jurusanItem->nama }}', '{{ $jurusanItem->deskripsi }}')"
                                    class="button-explore mt-4 inline-flex items-center gap-2">
                                <span>Explore</span>
                                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal Detail Jurusan dengan animasi yang lebih halus -->
<div id="jurusanModal" class="fixed inset-0 bg-dark/70 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="modal-content p-8 max-w-lg w-full mx-4 relative transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- Close Button -->
        <button onclick="closeJurusanModal()"
                class="absolute -top-4 -right-4 bg-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-300">
            <i class="fas fa-times text-dark"></i>
        </button>

        <!-- Modal Content -->
        <div class="space-y-6">
            <h2 id="modalTitle" class="text-3xl font-bold text-dark gradient-text"></h2>
            <div class="h-px bg-gradient-to-r from-primary to-secondary"></div>
            <p id="modalDescription" class="text-gray-600 leading-relaxed text-lg"></p>
        </div>
    </div>
</div>

<!-- Update script untuk animasi yang lebih halus -->
<script>
    function showJurusanDetail(nama, deskripsi) {
        const modal = document.getElementById('jurusanModal');
        const modalContent = document.getElementById('modalContent');
        const title = document.getElementById('modalTitle');
        const description = document.getElementById('modalDescription');

        title.textContent = nama;
        description.textContent = deskripsi;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Animate modal content
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeJurusanModal() {
        const modal = document.getElementById('jurusanModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    document.getElementById('jurusanModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeJurusanModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('jurusanModal').classList.contains('hidden')) {
            closeJurusanModal();
        }
    });
</script>

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
<div class="md:w-1/3">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
        <!-- Header Section with Animation -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 p-6 text-white">
            <div class="flex items-center space-x-3" data-aos="fade-right">
                <div class="bg-white/10 p-3 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">Agenda Sekolah</h2>
                    <p class="text-blue-200">Kegiatan mendatang</p>
                </div>
            </div>
        </div>

        <!-- Agenda List -->
        <div class="divide-y divide-gray-100">
            @foreach($agenda as $item)
            <div class="p-6 hover:bg-gray-50 transition-colors duration-300">
                <div class="flex items-start space-x-4">
                    <!-- Date Badge -->
                    <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3 text-center min-w-[80px]">
                        <span class="block text-2xl font-bold text-blue-600">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}
                        </span>
                        <span class="block text-sm text-blue-600">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 hover:text-blue-600 transition-colors duration-300">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                            {{ Str::limit($item->deskripsi, 100) }}
                        </p>

                        <!-- Time and Location -->
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <i class="far fa-clock mr-2 text-blue-500"></i>
                                {{ $item->waktu ?? '08:00' }} WIB
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                {{ $item->lokasi ?? 'SMKN 4 Bogor' }}
                            </span>
                        </div>

                        <!-- View Detail Button -->
                        <a href="{{ route('web.agenda.show', $item->id) }}"
                           class="inline-flex items-center mt-3 text-blue-600 hover:text-blue-700 transition-colors duration-300">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="p-6 bg-gray-50">
            <a href="{{ route('web.agenda.index') }}"
               class="flex justify-center items-center space-x-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300">
                <span>Lihat Semua Agenda</span>
                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</div>
   </div>



   <!-- Galeri Section -->
   <section class="my-16 px-8" data-aos="fade-up">
       <div class="container mx-auto">
           <div class="text-center mb-12">
               <h2 class="text-3xl font-bold mb-4 gradient-text">Galeri Terbaru</h2>
               <p class="text-gray-600 text-lg">Dokumentasi kegiatan dan momen berharga SMKN 4 Bogor</p>
           </div>

           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
               @foreach($latestPhotos as $photo)
               <div class="group relative h-[400px] rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                   <!-- Image Container -->
                   <div class="absolute inset-0">
                       <img src="{{ $photo->image }}"
                            alt="{{ $photo->judul }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                   </div>

                   <!-- Gradient Overlay -->
                   <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>

                   <!-- Content Overlay -->
                   <div class="absolute inset-0 p-6 flex flex-col justify-between text-white">
                       <!-- Top Section -->
                       <div class="flex justify-between items-start opacity-0 group-hover:opacity-100 transform translate-y-[-20px] group-hover:translate-y-0 transition-all duration-300">
                           <span class="bg-blue-600/80 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium">
                               <i class="far fa-calendar-alt mr-1"></i>
                               {{ $photo->created_at->format('d M Y') }}
                           </span>
                           <div class="flex gap-3">
                               <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm flex items-center">
                                   <i class="fas fa-eye mr-1"></i>
                                   {{ $photo->views->count() }}
                               </span>
                               <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm flex items-center">
                                   <i class="fas fa-heart mr-1 text-red-500"></i>
                                   {{ $photo->likes_count }}
                               </span>
                               <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm flex items-center">
                                   <i class="fas fa-comment mr-1 text-blue-400"></i>
                                   {{ $photo->comments_count ?? 0 }}
                               </span>
                           </div>
                       </div>

                       <!-- Bottom Section -->
                       <div class="transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                           <h3 class="text-xl font-bold mb-2 line-clamp-2">
                               {{ $photo->judul }}
                           </h3>
                           <p class="text-white/80 text-sm mb-4 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                               {{ Str::limit($photo->deskripsi, 100) }}
                           </p>
                           <a href="{{ route('web.galery.photo', $photo->id) }}"
                              class="inline-flex items-center gap-2 bg-blue-600/90 hover:bg-blue-700 text-white px-4 py-2 rounded-full transition-all duration-300 transform group-hover:translate-x-2">
                               <span>Lihat Detail</span>
                               <i class="fas fa-arrow-right"></i>
                           </a>
                       </div>
                   </div>
               </div>
               @endforeach
           </div>

           <!-- View All Button -->
           <div class="mt-12 text-center">
               <a href="{{ route('web.galery.index') }}"
                  class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-300 group">
                   <span class="mr-2">Jelajahi Semua Galeri</span>
                   <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform duration-300"></i>
               </a>
           </div>
       </div>
   </section>
 <!-- Google Maps and Form Section -->
 <section id="maps" class="py-16 px-8 bg-white">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Peta -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <h2 class="text-2xl font-bold p-6 text-blue-800 border-b">Lokasi Edu Galery</h2>
                <div class="aspect-w-16">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31722.047149155723!2d106.815542!3d-6.6407334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1693082189497!5m2!1sid!2sid"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        class="w-full h-full"
                    ></iframe>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="bg-white rounded-xl shadow-lg p-8 relative z-10">
                <h2 class="text-2xl font-bold mb-6 text-blue-800">Kontak Kami</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6 relative">
                    @csrf
                    <div class="relative">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input type="text"
                               id="name"
                               name="name"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                               placeholder="Masukkan nama Anda"
                               style="z-index: 20;">
                    </div>

                    <div class="relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                               placeholder="Masukkan email Anda"
                               style="z-index: 20;">
                    </div>

                    <div class="relative">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message"
                                  name="message"
                                  required
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                  placeholder="Tulis pesan Anda"
                                  style="z-index: 20;"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-[1.02] relative"
                            style="z-index: 20;">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
  <!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto text-center">
        <div class="mb-4">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo SMKN 4 Bogor" class="h-12 mx-auto">
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
