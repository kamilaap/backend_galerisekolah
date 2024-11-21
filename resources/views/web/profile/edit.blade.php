<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profile - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload {
            position: relative;
            max-width: 150px;
            margin: 0 auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 5px;
            bottom: 5px;
            z-index: 1;
        }

        .avatar-preview {
            width: 150px;
            height: 150px;
            position: relative;
            border-radius: 100%;
            overflow: hidden;
            border: 3px solid #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar (sama seperti sebelumnya) -->

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="profile-card p-8">
                <h1 class="text-2xl font-bold text-center mb-8">Edit Profile</h1>

                <form action="{{ route('web.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Avatar Upload Section -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Profil</label>

                        <!-- Preview Avatar -->
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="avatar-preview"
                                     class="h-32 w-32 object-cover rounded-full border-4 border-white shadow-lg"
                                     src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                     alt="Avatar preview">
                            </div>

                            <div class="flex flex-col">
                                <label class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                    <span>Pilih Foto</span>
                                    <input type="file"
                                           name="avatar"
                                           id="avatar-input"
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewImage(event)">
                                </label>
                                <p class="mt-2 text-sm text-gray-500">
                                    PNG, JPG, GIF hingga 2MB
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="mt-8 p-6 bg-red-50 rounded-lg border border-red-200">
                <h2 class="text-xl font-semibold text-red-600 mb-4">Hapus Akun</h2>
                <p class="text-gray-600 mb-4">
                    Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.
                </p>
                <form action="{{ route('web.profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Hapus Akun
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer (sama seperti sebelumnya) -->

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('avatar-preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
