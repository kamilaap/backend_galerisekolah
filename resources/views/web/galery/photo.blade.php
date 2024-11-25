<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Galeri - {{ $galery->judul }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .photo-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            border-radius: 1rem;
        }

        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .photo-container {
            position: relative;
            overflow: hidden;
            padding-top: 75%; /* 4:3 Aspect Ratio */
        }

        .photo-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .photo-card:hover .photo-container img {
            transform: scale(1.1);
        }

        .like-button {
            transition: all 0.3s ease;
        }

        .like-button:hover {
            transform: scale(1.1);
        }

        .like-button.liked {
            animation: likeEffect 0.5s ease;
        }

        @keyframes likeEffect {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .comment-section {
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(59, 130, 246, 0.5) transparent;
        }

        .comment-section::-webkit-scrollbar {
            width: 6px;
        }

        .comment-section::-webkit-scrollbar-thumb {
            background-color: rgba(59, 130, 246, 0.5);
            border-radius: 3px;
        }

        .modal {
            backdrop-filter: blur(8px);
        }

        .download-button {
            background: linear-gradient(45deg, #3B82F6, #2563EB);
            transition: all 0.3s ease;
        }

        .download-button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        /* Fullscreen Modal */
        #fullscreenModal {
            background: rgba(0, 0, 0, 0.9);
            transition: opacity 0.3s ease;
        }

        #fullscreenModal img {
            max-height: 90vh;
            max-width: 90vw;
            object-fit: contain;
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
        }

        .share-button:active {
            transform: scale(0.95);
        }

        /* Tambahan style untuk balasan admin */
        .admin-reply {
            background-color: #EBF8FF;
            border-left: 4px solid #3B82F6;
            margin-left: 2rem;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .admin-badge {
            background-color: #3B82F6;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0.5rem;
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

        /* Logo section styling */
        .logo-text {
            color: #f0f9ff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo-subtitle {
            color: #bfdbfe;
            font-weight: 500;
        }

        /* Hero section styling */
        .hero-section {
            background: linear-gradient(to right, rgba(12, 74, 110, 0.9), rgba(7, 89, 133, 0.9));
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('path/to/pattern.svg');
            opacity: 0.1;
            animation: slide 20s linear infinite;
        }

        /* Photo grid styling */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .photo-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .photo-container {
            position: relative;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            overflow: hidden;
        }

        .photo-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .photo-card:hover .photo-container img {
            transform: scale(1.1);
        }

        /* Comments section styling */
        .comments-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .comment-form {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .comment-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            resize: none;
            transition: all 0.3s ease;
        }

        .comment-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .comment-card {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .comment-card:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Like button animation */
        @keyframes likeEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .like-button {
            background: linear-gradient(45deg, #ff6b6b, #ff8787);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(255, 107, 107, 0.2);
        }

        .like-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 107, 107, 0.3);
        }

        .like-button.liked {
            animation: likeEffect 0.5s ease;
        }

        /* Share buttons styling */
        .share-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .share-button {
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .share-facebook {
            background: #1877f2;
            color: white;
        }

        .share-instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: white;
        }

        .share-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Fullscreen modal styling */
        .fullscreen-modal {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }

        .fullscreen-modal img {
            max-height: 90vh;
            max-width: 90vw;
            object-fit: contain;
            border-radius: 0.5rem;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        }

        /* Stats badges */
        .stats-badge {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Loading animation */
        .loading-spinner {
            width: 2rem;
            height: 2rem;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Login message styling */
        .login-message {
            background: linear-gradient(135deg, #60a5fa20, #3b82f620);
            border: 1px solid #60a5fa30;
            padding: 1.5rem;
            border-radius: 1rem;
            text-align: center;
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }

        .login-message:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.1);
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(45deg, #3b82f6, #2563eb);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }

        .shadow-text {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .photo-card {
            break-inside: avoid;
        }
        
        /* Animasi hover untuk photo card */
        .photo-card:hover {
            transform: translateY(-10px);
        }
        
        /* Custom scrollbar */
        .comment-section::-webkit-scrollbar {
            width: 6px;
        }
        
        .comment-section::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .comment-section::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        
        .comment-section::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(59, 130, 246, 0.5) transparent;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(59, 130, 246, 0.5);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(59, 130, 246, 0.7);
        }

        .photo-card {
            height: fit-content;
        }
    </style>
</head>

<body>

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

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb dengan efek hover yang lebih menarik -->
        <div class="flex items-center space-x-2 mb-6 text-sm" data-aos="fade-right">
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800 transition-all duration-300 hover:scale-105">
                <i class="fas fa-home"></i> Home
            </a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('web.galery.index') }}" class="text-blue-600 hover:text-blue-800 transition-all duration-300 hover:scale-105">Galeri</a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-600">{{ $galery->judul }}</span>
        </div>

        <!-- Gallery Header dengan desain yang lebih menarik -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-8 mb-8 shadow-lg border border-blue-100" data-aos="fade-up">
            <h1 class="text-4xl font-bold mb-4 text-gray-800 tracking-tight">{{ $galery->judul }}</h1>
            <p class="text-gray-600 text-lg leading-relaxed">{{ $galery->deskripsi }}</p>
            <div class="mt-4 flex items-center space-x-4 text-sm text-gray-500">
                <span><i class="far fa-calendar-alt mr-2"></i>{{ $galery->created_at->format('d M Y') }}</span>
                <span><i class="far fa-images mr-2"></i>{{ count($galery->photos) }} Foto</span>
            </div>
        </div>

        <!-- Masonry Grid Layout untuk foto dengan ukuran yang lebih konsisten -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
            @if($galery && $galery->photos)
                @foreach($galery->photos as $photo)
                    <div class="photo-card group bg-white rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl">
                        <!-- Photo Container dengan aspect ratio yang konsisten -->
                        <div class="relative overflow-hidden rounded-t-xl" style="aspect-ratio: 4/3;">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-opacity duration-300 z-10"></div>
                            <a href="{{ $photo->image }}" 
                               data-lightbox="gallery-{{ $galery->id }}" 
                               data-title="{{ $photo->judul ?? 'Photo' }}"
                               class="cursor-pointer">
                                <img src="{{ $photo->image }}" 
                                     alt="{{ $photo->judul ?? 'Photo' }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </a>
                            <!-- Overlay dengan informasi foto -->
                            <div class="absolute inset-0 flex flex-col justify-end p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                <h3 class="text-white text-xl font-bold mb-2 shadow-text">{{ $photo->judul ?? 'Untitled' }}</h3>
                                <div class="flex items-center space-x-4 text-white">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-2"></i>{{ $photo->views_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-heart mr-2"></i>{{ $photo->likes_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-comment mr-2"></i>{{ $photo->comments_count }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6 space-y-4">
                            <!-- Like Button -->
                            @auth
                                <button onclick="toggleLike({{ $photo->id }})"
                                        id="likeButton-{{ $photo->id }}"
                                        class="w-full flex items-center justify-center space-x-2 px-4 py-3 rounded-full transition-all duration-300
                                            {{ $photo->isLikedBy(auth()->user())
                                                ? 'bg-red-500 hover:bg-red-600 text-white'
                                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                                            }}">
                                    <i class="fas fa-heart"></i>
                                    <span id="likeCount-{{ $photo->id }}">{{ $photo->likes_count }}</span>
                                </button>
                            @else
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <p class="text-sm text-blue-600 mb-2">Login untuk menyukai foto ini</p>
                                    <a href="{{ route('login') }}" 
                                       class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-600 transition-colors duration-300">
                                        Login Sekarang
                                    </a>
                                </div>
                            @endauth

                            <!-- Share Buttons -->
                            <div class="flex items-center space-x-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full text-sm text-center transition-colors duration-300">
                                    <i class="fab fa-facebook-f mr-2"></i>Share
                                </a>
                                <button onclick="shareToInstagram('{{ $photo->image }}', '{{ $photo->judul ?? 'Photo' }}')"
                                        class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white py-2 px-4 rounded-full text-sm text-center transition-colors duration-300">
                                    <i class="fab fa-instagram mr-2"></i>Share
                                </button>
                                <a href="{{ $photo->image }}"
                                   download="{{ $photo->judul ?? 'Photo' }}"
                                   class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-full text-sm text-center transition-colors duration-300">
                                    <i class="fas fa-download mr-2"></i>Download
                                </a>
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold mb-4">Komentar</h4>
                                
                                @auth
                                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                                        @csrf
                                        <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                        <textarea
                                            name="comment"
                                            class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
                                            placeholder="Tulis komentar Anda..."
                                            rows="3"
                                            required
                                        ></textarea>
                                        <button type="submit" 
                                                class="mt-2 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300">
                                            Kirim Komentar
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-gray-50 p-4 rounded-lg text-center mb-6">
                                        <p class="text-gray-600 mb-2">Login untuk memberikan komentar</p>
                                        <a href="{{ route('login') }}" 
                                           class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                            Login Sekarang
                                        </a>
                                    </div>
                                @endauth

                                <!-- Daftar Komentar -->
                                <div class="space-y-4 max-h-96 overflow-y-auto custom-scrollbar">
                                    @forelse($photo->comments as $comment)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-start justify-between">
                                                <div class="flex items-center space-x-3">
                                                    @if($comment->user->avatar)
                                                        <img src="{{ asset($comment->user->avatar) }}" 
                                                             alt="Profile" 
                                                             class="w-8 h-8 rounded-full">
                                                    @else
                                                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                                            {{ substr($comment->user->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p class="font-semibold">{{ $comment->user->name }}</p>
                                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                
                                                @auth
                                                    @if(auth()->user()->role === 'admin' || auth()->id() === $comment->user_id)
                                                        <button onclick="deleteComment({{ $comment->id }})"
                                                                class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @endauth
                                            </div>
                                            <p class="mt-2 text-gray-700">{{ $comment->comment }}</p>

                                            <!-- Admin Replies -->
                                            @if($comment->replies && count($comment->replies) > 0)
                                                <div class="mt-4 ml-8 space-y-3">
                                                    @foreach($comment->replies as $reply)
                                                        <div class="bg-white p-4 rounded-lg border-l-4 border-blue-500">
                                                            <div class="flex justify-between items-start">
                                                                <div>
                                                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs">Admin</span>
                                                                    <p class="mt-2">{{ $reply->reply }}</p>
                                                                    <p class="text-sm text-gray-500 mt-1">{{ $reply->created_at->diffForHumans() }}</p>
                                                                </div>
                                                                @auth
                                                                    @if(auth()->user()->role === 'admin')
                                                                        <button onclick="deleteAdminReply({{ $reply->id }})"
                                                                                class="text-red-500 hover:text-red-700">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <!-- Admin Reply Form -->
                                            @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <button onclick="toggleReplyForm({{ $comment->id }})"
                                                            class="text-blue-500 text-sm mt-2 hover:underline">
                                                        Reply
                                                    </button>
                                                    <div id="replyForm-{{ $comment->id }}" class="mt-3 hidden">
                                                        <form action="{{ route('admin.reply.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                            <textarea
                                                                name="reply"
                                                                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
                                                                placeholder="Tulis balasan..."
                                                                rows="2"
                                                                required
                                                            ></textarea>
                                                            <button type="submit" 
                                                                    class="mt-2 px-4 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                                                                Kirim Balasan
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    @empty
                                        <p class="text-center text-gray-500">Belum ada komentar.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <div class="bg-gray-50 rounded-xl p-8">
                        <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 text-lg">Tidak ada foto yang tersedia.</p>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Fullscreen Modal -->
    <div id="fullscreenModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
        <button onclick="closeFullscreen()" class="absolute top-4 right-4 text-white text-xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
        <img id="fullscreenImage" src="" alt="Fullscreen view">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        function toggleLike(photoId) {
            fetch(`/photos/${photoId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likeButton = document.getElementById(`likeButton-${photoId}`);
                    const likeCount = document.getElementById(`likeCount-${photoId}`);

                    if (data.liked) {
                        likeButton.classList.remove('bg-gray-200', 'text-gray-700');
                        likeButton.classList.add('bg-red-500', 'text-white', 'liked');
                    } else {
                        likeButton.classList.remove('bg-red-500', 'text-white', 'liked');
                        likeButton.classList.add('bg-gray-200', 'text-gray-700');
                    }

                    likeCount.textContent = data.likes_count;
                } else {
                    window.location.href = '/login';
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function openFullscreen(imageSrc) {
            const modal = document.getElementById('fullscreenModal');
            const fullscreenImage = document.getElementById('fullscreenImage');

            fullscreenImage.src = imageSrc;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeFullscreen() {
            const modal = document.getElementById('fullscreenModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('fullscreenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFullscreen();
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFullscreen();
            }
        });

        function shareToInstagram(imageUrl, caption) {
            // Untuk mobile
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // Deep linking ke Instagram
                window.location.href = `instagram://library?AssetPath=${encodeURIComponent(imageUrl)}`;

                // Fallback jika deep linking gagal
                setTimeout(() => {
                    window.location.href = 'https://www.instagram.com/';
                }, 2000);
            } else {
                // Untuk desktop
                // Buat temporary textarea untuk copy caption
                const textarea = document.createElement('textarea');
                textarea.value = `${caption}\n\nLihat lebih banyak di: ${window.location.href}`;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                // Buka Instagram di tab baru
                window.open('https://www.instagram.com/', '_blank');

                // Tampilkan instruksi
                alert('Caption telah disalin ke clipboard.\nSilakan paste caption setelah mengupload foto ke Instagram.');

                // Download gambar
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = 'photo.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        // Tambahkan event listener untuk tracking share
        document.querySelectorAll('.share-button').forEach(button => {
            button.addEventListener('click', function() {
                // Animasi ketika tombol di klik
                this.classList.add('scale-110');
                setTimeout(() => {
                    this.classList.remove('scale-110');
                }, 200);
            });
        });

        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            replyForm.classList.toggle('hidden');
        }

        function toggleAdminReplies(commentId) {
            const repliesDiv = document.getElementById(`adminReplies-${commentId}`);
            const toggleText = document.getElementById(`toggleText-${commentId}`);
            const toggleIcon = document.getElementById(`toggleIcon-${commentId}`);

            if (repliesDiv.classList.contains('hidden')) {
                repliesDiv.classList.remove('hidden');
                toggleText.textContent = 'Sembunyikan balasan admin';
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            } else {
                repliesDiv.classList.add('hidden');
                toggleText.textContent = 'Lihat balasan admin';
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete forms
            document.querySelectorAll('.delete-reply-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (confirm('Yakin ingin menghapus balasan ini?')) {
                        fetch(this.action, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the reply element
                                this.closest('.admin-reply').remove();
                            } else {
                                alert('Gagal menghapus balasan');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus balasan');
                        });
                    }
                });
            });
        });

        function deleteComment(commentId) {
            Swal.fire({
                title: 'Hapus Komentar?',
                text: "Komentar yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Komentar berhasil dihapus.',
                                icon: 'success'
                            }).then(() => {
                                // Refresh halaman setelah komentar dihapus
                                window.location.reload();
                            });
                        } else {
                            // Tampilkan pesan error
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menghapus komentar',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus komentar',
                            'error'
                        );
                    });
                }
            });
        }

        // Fungsi untuk menghapus balasan admin
        function deleteAdminReply(replyId) {
            Swal.fire({
                title: 'Hapus Balasan?',
                text: "Balasan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/replies/${replyId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hapus elemen balasan dari DOM
                            const replyElement = document.querySelector(`[data-reply-id="${replyId}"]`);
                            if (replyElement) {
                                replyElement.remove();
                            }

                            // Tampilkan pesan sukses
                            Swal.fire(
                                'Terhapus!',
                                'Balasan berhasil dihapus.',
                                'success'
                            );
                        } else {
                            // Tampilkan pesan error
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menghapus balasan',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus balasan',
                            'error'
                        );
                    });
                }
            });
        }

        // Konfigurasi Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Foto %1 dari %2',
            'fadeDuration': 300,
            'imageFadeDuration': 300,
            'positionFromTop': 50,
            'maxWidth': 1200,
            'maxHeight': 800,
            'fitImagesInViewport': true,
            'showImageNumberLabel': true,
            'disableScrolling': true
        });
    </script>
</body>

</html>
