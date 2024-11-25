<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Edu Galery</title>
    <link rel="shortcut icon" type="image/jpg"
        href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0c4a6e 0%, #075985 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .input-group label {
            position: absolute;
            left: 0.75rem;
            top: -0.7rem;
            padding: 0 0.5rem;
            background: white;
            color: #4B5563;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #E5E7EB;
            border-radius: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        .form-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: white;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            transition: all 0.3s ease;
        }
        .form-input:focus + .input-icon {
            color: #3B82F6;
        }
        .submit-button {
            background: linear-gradient(45deg, #3B82F6, #2563EB);
            color: white;
            padding: 1rem 2rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        .submit-button:active {
            transform: translateY(0);
        }
        .submit-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
        }
        .submit-button:hover::after {
            transform: translateX(100%);
            transition: transform 0.6s ease;
        }
        .link-hover {
            position: relative;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .link-hover::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: #3B82F6;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .link-hover:hover::after {
            transform: scaleX(1);
        }
        .error-container {
            background: rgba(254, 226, 226, 0.9);
            border-left: 4px solid #DC2626;
            backdrop-filter: blur(10px);
        }
        .wave {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') repeat-x;
            background-size: 1440px 100px;
            animation: wave 10s linear infinite;
        }
        @keyframes wave {
            0% { background-position-x: 0; }
            100% { background-position-x: 1440px; }
        }
    </style>
</head>
<body class="flex items-center justify-center p-6">
    <div class="wave"></div>
    <div class="form-container w-full max-w-md p-8 relative z-10">
        <!-- Logo dan Header -->
        <div class="text-center mb-8">
            <img src="{{ asset('assets/images/logo/logo.png') }}"
                 alt="Logo"
                 class="mx-auto h-24 w-auto hover:scale-105 transition-transform duration-300">
            <h2 class="mt-6 text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
                Daftar Akun Baru
            </h2>
            <p class="mt-2 text-gray-600">
                Atau
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700 link-hover">
                    masuk jika sudah punya akun
                </a>
            </p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="error-container mb-6 p-4 rounded-lg">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                    <h3 class="font-semibold text-red-600">Terdapat beberapa kesalahan:</h3>
                </div>
                <ul class="list-disc list-inside space-y-1 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div class="input-group">
                <label for="name">Nama Lengkap</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       class="form-input"
                       placeholder="Masukkan nama lengkap">
                <i class="fas fa-user input-icon"></i>
            </div>

            <!-- Email -->
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email') }}"
                       class="form-input"
                       placeholder="nama@email.com">
                <i class="fas fa-envelope input-icon"></i>
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Password</label>
                <div class="relative">
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-input"
                           placeholder="Minimal 8 karakter">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-input"
                           placeholder="Ulangi password">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </button>
        </form>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 link-hover">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
    <script>
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
