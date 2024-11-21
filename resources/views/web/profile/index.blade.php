<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .avatar-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar (sama seperti sebelumnya) -->

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Profile Card -->
            <div class="profile-card p-8" data-aos="fade-up">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Avatar Section -->
                    <div class="flex flex-col items-center space-y-4">
                        <div class="avatar-container">
                            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}"
                                 alt="Profile Picture"
                                 class="w-full h-full object-cover">
                        </div>
                        <a href="{{ route('web.profile.edit') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profile
                        </a>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-4">{{ auth()->user()->name }}</h1>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2 text-gray-600">
                                <i class="fas fa-envelope"></i>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                            <div class="flex items-center space-x-2 text-gray-600">
                                <i class="fas fa-clock"></i>
                                <span>Bergabung sejak {{ auth()->user()->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Comments Activity -->
                <div class="profile-card p-6" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-xl font-semibold mb-4">
                        <i class="fas fa-comments text-blue-600 mr-2"></i>
                        Komentar Terbaru
                    </h2>
                    <div class="space-y-4">
                        @forelse(auth()->user()->comments()->latest()->take(5)->get() as $comment)
                        <div class="border-b pb-4 last:border-0">
                            <p class="text-gray-600">{{ $comment->comment }}</p>
                            <div class="mt-2 text-sm text-gray-500">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">Belum ada komentar</p>
                        @endforelse
                    </div>
                </div>

                <!-- Likes Activity -->
                <div class="profile-card p-6" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-xl font-semibold mb-4">
                        <i class="fas fa-heart text-red-500 mr-2"></i>
                        Foto yang Disukai
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        @forelse(auth()->user()->likes()->latest()->take(4)->get() as $like)
                        <div class="relative group">
                            <img src="{{ $like->photo->image }}"
                                 alt="Liked Photo"
                                 class="w-full h-32 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                <a href="{{ route('web.galery.photo', $like->photo->id) }}"
                                   class="text-white hover:underline">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4 col-span-2">Belum ada foto yang disukai</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (sama seperti sebelumnya) -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
