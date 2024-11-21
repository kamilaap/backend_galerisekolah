<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $jurusan->nama }} - Detail Jurusan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Hero Section -->
    <div class="relative bg-blue-900 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">{{ $jurusan->nama }}</h1>

            <!-- Display the first image from the gallery -->
            @if($jurusan->photos->isNotEmpty())
                <img src="{{ $jurusan->photos->first()->image }}" alt="{{ $jurusan->nama }}" class="w-full h-auto object-cover rounded-lg mb-4">
            @else
                <p class="text-red-500">Tidak ada foto untuk jurusan ini.</p>
            @endif

            <p class="text-xl text-blue-100 mb-8" data-aos="fade-up" data-aos-delay="100">
                {{ $jurusan->deskripsi }}
            </p>

            <!-- Back Button -->
            <div class="mb-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center px-6 py-3 bg-white/10 text-white rounded-full hover:bg-white/20 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-4">Galeri {{ $jurusan->nama }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($jurusan->photos as $photo)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $photo->image }}" alt="{{ $photo->judul }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $photo->judul }}</h3>
                        <p class="text-gray-600">{{ Str::limit($photo->deskripsi, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
