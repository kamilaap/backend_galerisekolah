<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg"
        href="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- js -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.
js" defer></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f3f4f6;
        }

        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(180deg, #1e40af 0%, #1d4ed8 100%);
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #e2e8f0;
            border-radius: 0.5rem;
            margin: 0.25rem 0.75rem;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .nav-icon {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.75rem;
        }

        /* Header Styles */
        .top-header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* Profile Dropdown */
        .profile-dropdown {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 lg:relative lg:translate-x-0"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

            <!-- Logo -->
            <div class="flex items-center justify-center p-6 border-b border-blue-700">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" class="h-10 w-auto" alt="Logo">
                <div class="ml-3">
                    <h1 class="text-white font-bold text-lg">SMKN 4 BOGOR</h1>
                    <p class="text-blue-200 text-xs">Admin Dashboard</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 space-y-2 px-4">
                <a href="{{ route('admin.dashboard.index') }}"
                   class="sidebar-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-home nav-icon"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.kategori.index') }}"
                   class="sidebar-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                    <i class="fas fa-tags nav-icon"></i>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('admin.informasi.index') }}"
                   class="sidebar-link {{ Request::is('admin/informasi*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <span>Informasi</span>
                </a>

                <a href="{{ route('admin.agenda.index') }}"
                   class="sidebar-link {{ Request::is('admin/agenda*') ? 'active' : '' }}">
                    <i class="fas fa-calendar nav-icon"></i>
                    <span>Agenda</span>
                </a>

                <a href="{{ route('admin.galery.index') }}"
                   class="sidebar-link {{ Request::is('admin/galery*') ? 'active' : '' }}">
                    <i class="fas fa-images nav-icon"></i>
                    <span>Galeri</span>
                </a>

                <a href="{{ route('admin.photo.index') }}"
                   class="sidebar-link {{ Request::is('admin/photo*') ? 'active' : '' }}">
                    <i class="fas fa-camera nav-icon"></i>
                    <span>Photo</span>
                </a>

                <a href="{{ route('admin.comments.index') }}"
                   class="sidebar-link {{ Request::is('admin/comments*') ? 'active' : '' }}">
                    <i class="fas fa-comments nav-icon"></i>
                    <span>Komentar</span>
                </a>

                <a href="{{ route('admin.likes.index') }}"
                   class="sidebar-link {{ Request::is('admin/likes*') ? 'active' : '' }}">
                    <i class="fas fa-heart nav-icon"></i>
                    <span>Like</span>
                </a>

                <a href="{{ route('admin.slider.index') }}"
                   class="sidebar-link {{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h nav-icon"></i>
                    <span>Slider</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                    <i class="fas fa-users nav-icon"></i>
                    <span>Users</span>
                </a>

                <div class="border-t border-blue-700 my-4"></div>

                <a href="{{ route('admin.profile.index') }}"
                   class="sidebar-link {{ Request::is('admin/profile*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="top-header flex items-center justify-between px-6 py-4">
                <!-- Left side - Menu Button & Title -->
                <div class="flex items-center">
                    <!-- Menu Button - Hanya muncul di mobile -->
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Page Title -->
                    <h1 class="ml-4 text-xl font-semibold text-gray-800">{{ $title }}</h1>
                </div>

                <!-- Right side - Profile Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications - Optional -->
                    <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-bell"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center space-x-3 focus:outline-none">
                            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}"
                                 class="h-8 w-8 rounded-full object-cover border-2 border-blue-500"
                                 alt="Profile">
                            <div class="hidden md:block text-left">
                                <h2 class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                                <p class="text-xs text-gray-600">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('admin.profile.index') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-user-circle mr-2"></i>Profile
                            </a>
                            <a href="{{ route('welcome') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-cog mr-2"></i>Website
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif
</body>

</html>
