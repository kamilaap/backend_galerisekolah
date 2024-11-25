<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="shortcut icon" type="image/jpg"
        href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }
    </style>
</head>
<body class="min-h-screen py-12 bg-gray-50">
    <!-- Back to Home Button -->
    <div class="container mx-auto px-4 mb-6">
        <a href="{{ route('welcome') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Beranda
        </a>
    </div>

    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white">Profile Settings</h1>
                </div>

                <!-- Profile Content -->
                <div class="p-6">
                    <!-- Avatar Section -->
                    <div class="flex items-center space-x-6 mb-8">
                        <div class="relative group">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset(auth()->user()->avatar) }}"
                                     alt="Profile"
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg"
                                     id="avatarImage">
                            @else
                                <div class="w-32 h-32 rounded-full bg-blue-500 flex items-center justify-center text-white text-4xl border-4 border-white shadow-lg"
                                     id="avatarPlaceholder">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif

                            <!-- Overlay for hover effect -->
                            <div class="absolute inset-0 rounded-full bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <label for="avatarInput" class="cursor-pointer">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </label>
                            </div>

                            <!-- Hidden file input -->
                            <input type="file"
                                   id="avatarInput"
                                   class="hidden"
                                   accept="image/*"
                                   onchange="updateAvatar(this)">
                        </div>

                        <div>
                            <h2 class="text-2xl font-semibold">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            <span class="inline-block px-3 py-1 mt-2 bg-blue-100 text-blue-800 rounded-full text-sm">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>
                    </div>

                    <!-- Profile Form dan Password Form dalam Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Profile Form -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Profil</h3>
                            <form action="{{ route('web.profile.update') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ auth()->user()->name }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           value="{{ auth()->user()->email }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Form -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Ganti Password</h3>
                            <form action="{{ route('web.profile.password') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                    <div class="relative mt-1">
                                        <input type="password"
                                               name="current_password"
                                               id="current_password"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10"
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" onclick="togglePassword('current_password')" class="text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                    <div class="relative mt-1">
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10"
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                    <div class="relative mt-1">
                                        <input type="password"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10"
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" onclick="togglePassword('password_confirmation')" class="text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-key mr-2"></i>
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 transform translate-y-full opacity-0 transition-all duration-300">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <span id="toastMessage"></span>
        </div>
    </div>

    <!-- Setelah bagian Profile Form, tambahkan Activity Tabs -->
    <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="border-b">
            <nav class="flex">
                <button onclick="switchTab('likes')"
                        id="likesTab"
                        class="px-6 py-4 text-blue-600 border-b-2 border-blue-600 font-medium">
                    <i class="fas fa-heart mr-2"></i>Foto yang Disukai
                </button>
                <button onclick="switchTab('comments')"
                        id="commentsTab"
                        class="px-6 py-4 text-gray-600 hover:text-blue-600 font-medium">
                    <i class="fas fa-comment mr-2"></i>Komentar Saya
                </button>
            </nav>
        </div>

        <!-- Likes Content -->
        <div id="likesContent" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse(auth()->user()->likes as $like)
                    <div class="bg-gray-50 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('web.galery.photo', $like->photo->id) }}" class="block">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ asset($like->photo->image) }}"
                                     alt="Liked photo"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">{{ $like->photo->judul ?? 'Untitled' }}</h3>
                                <p class="text-sm text-gray-500 mt-1">Disukai pada {{ $like->created_at->format('d M Y') }}</p>
                                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                    <span><i class="fas fa-heart mr-1"></i>{{ $like->photo->likes_count }}</span>
                                    <span><i class="fas fa-comment mr-1"></i>{{ $like->photo->comments_count }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <i class="fas fa-heart text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">Anda belum menyukai foto apapun.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Comments Content -->
        <div id="commentsContent" class="p-6 hidden">
            <div class="space-y-6">
                @forelse(auth()->user()->comments as $comment)
                    <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ asset($comment->photo->image) }}"
                                     alt="Commented photo"
                                     class="w-20 h-20 object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('web.galery.photo', $comment->photo->id) }}"
                                   class="font-semibold text-blue-600 hover:text-blue-800">
                                    {{ $comment->photo->judul ?? 'Untitled' }}
                                </a>
                                <p class="text-gray-700 mt-2">{{ $comment->comment }}</p>
                                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                    <span>
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                    @if($comment->replies_count > 0)
                                        <span>
                                            <i class="fas fa-reply mr-1"></i>
                                            {{ $comment->replies_count }} balasan
                                        </span>
                                    @endif
                                </div>
                                <!-- Admin Replies -->
                                @if($comment->replies && count($comment->replies) > 0)
                                    <div class="mt-3 pl-4 border-l-2 border-blue-200">
                                        @foreach($comment->replies as $reply)
                                            <div class="bg-white p-3 rounded-lg mt-2">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Admin</span>
                                                    <span class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-gray-700">{{ $reply->reply }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-comment text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">Anda belum memberikan komentar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');

            toastMessage.textContent = message;
            toast.classList.remove('translate-y-full', 'opacity-0');

            setTimeout(() => {
                toast.classList.add('translate-y-full', 'opacity-0');
            }, 3000);
        }

        function updateAvatar(input) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('avatar', input.files[0]);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                // Show loading state
                const avatarImage = document.getElementById('avatarImage');
                const avatarPlaceholder = document.getElementById('avatarPlaceholder');
                if (avatarImage) {
                    avatarImage.style.opacity = '0.5';
                }
                if (avatarPlaceholder) {
                    avatarPlaceholder.style.opacity = '0.5';
                }

                fetch('{{ route('web.profile.updateAvatar') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update avatar preview
                        if (avatarPlaceholder) {
                            avatarPlaceholder.style.display = 'none';
                        }
                        if (!avatarImage) {
                            const newAvatarImage = document.createElement('img');
                            newAvatarImage.id = 'avatarImage';
                            newAvatarImage.className = 'w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg';
                            avatarPlaceholder.parentNode.insertBefore(newAvatarImage, avatarPlaceholder);
                        }
                        avatarImage.src = data.avatar_url;
                        avatarImage.style.opacity = '1';

                        showToast(data.message);

                        // Refresh halaman setelah berhasil update
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast(data.message || 'Gagal mengupload avatar');
                        if (avatarImage) avatarImage.style.opacity = '1';
                        if (avatarPlaceholder) avatarPlaceholder.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat mengupload avatar');
                    if (avatarImage) avatarImage.style.opacity = '1';
                    if (avatarPlaceholder) avatarPlaceholder.style.opacity = '1';
                });
            }
        }

        function switchTab(tab) {
            // Update tab buttons
            document.getElementById('likesTab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('commentsTab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById(tab + 'Tab').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');

            // Update content visibility
            document.getElementById('likesContent').classList.add('hidden');
            document.getElementById('commentsContent').classList.add('hidden');
            document.getElementById(tab + 'Content').classList.remove('hidden');
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
