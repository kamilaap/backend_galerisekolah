<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galery - {{ $galery->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">


   <!-- Navbar -->
<nav class="bg-gray-800 p-4 sticky top-0 z-50">
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
            <a href="{{ route('web.informasi.index') }}" class="text-white flex items-center space-x-1">
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



    <!-- Konten Utama -->
    <div class="container mx-auto my-8 flex-grow">
        <h1 class="text-3xl font-bold mb-6">{{ $galery->judul }}</h1>
        <p>{{ $galery->description }}</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            @foreach($galery->photos as $photo)
            <div class="rounded overflow-hidden shadow-lg">
                <img class="w-full h-48 object-cover" src="{{ $photo->image }}" alt="Photo">
            </div>
            @endforeach
        </div>
        <button onclick="window.history.back()" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded">Back to Gallery</button>
    </div>

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

</body>

</html>
