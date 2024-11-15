<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                <form action="{{ route('web.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Avatar Upload -->
                    <div class="avatar-upload mb-8">
                        <div class="avatar-edit">
                            <label for="avatar" class="bg-blue-600 text-white p-2 rounded-full cursor-pointer hover:bg-blue-700 transition-colors">
                                <i class="fas fa-camera"></i>
                                <input type="file"
                                       id="avatar"
                                       name="avatar"
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                            </label>
                        </div>
                        <div class="avatar-preview">
                            <img id="avatar-preview"
                                 src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}"
                                 alt="Profile Avatar"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ auth()->user()->email }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru (opsional)</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Biarkan kosong jika tidak ingin mengubah">
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
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
