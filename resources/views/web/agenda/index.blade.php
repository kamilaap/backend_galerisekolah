<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg"  href="{{ asset('assets/images/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agenda - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }

        .hero-section {
            background: linear-gradient(rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.9)),
                        url('path/to/background-image.jpg') center/cover no-repeat;
            height: 50vh;
        }

        .calendar-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .timeline-container {
            position: relative;
            padding: 2rem 0;
        }

        .timeline-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, #3B82F6, transparent);
        }

        .timeline-item {
            position: relative;
            margin: 2rem 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 20px;
            height: 20px;
            background: #3B82F6;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        .timeline-content {
            width: calc(50% - 50px);
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
        }

        .flatpickr-calendar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 15px;
        }

        .flatpickr-day.has-event {
            background: #3b82f6 !important;
            color: white !important;
            border-color: #3b82f6 !important;
            font-weight: bold;
            cursor: pointer !important;
            position: relative;
        }

        .flatpickr-day.has-event:hover {
            background: #2563eb !important;
            transform: scale(1.1);
        }

        @keyframes eventPulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        .flatpickr-day.has-event {
            animation: eventPulse 2s infinite;
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
                            SMK INDONESIA DIGITAL
                        </a>
                        <p class="logo-subtitle text-sm">Unggul dalam Digital, Berkarakter dalam Akhlak</p>
                    </div>
                </div>

                <!-- Search Bar -->
                <form id="search-form" action="{{ route('search') }}" method="GET"
                      class="hidden md:flex items-center">
                    <div class="relative">
                        <input type="text" name="query"
                               placeholder="Cari informasi..."
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

    <!-- Hero Section -->
    <div class="hero-section flex items-center justify-center text-white">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">Agenda SMKN 4 Bogor</h1>
            <p class="text-xl opacity-90 mb-8" data-aos="fade-up" data-aos-delay="100">
                Jadwal kegiatan dan acara penting sekolah kami
            </p>
            <!-- Back Button -->
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center px-6 py-3 bg-white/10 text-white rounded-full hover:bg-white/20 transition-all duration-300"
               data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-16 relative z-10">
        <!-- Calendar Section -->
        <div class="calendar-card p-6 mb-12" data-aos="fade-up">
            <div id="calendar"></div>
        </div>

        <!-- Timeline Section -->
        <div class="timeline-container">
            <div class="timeline-line"></div>
            @foreach($agenda as $item)
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-content">
                    <div class="flex items-center justify-between mb-4">
                        <!-- Date Badge -->
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 rounded-lg p-4 text-center">
                                <span class="block text-2xl font-bold text-blue-600">
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->format('d') }}
                                </span>
                                <span class="block text-sm text-blue-600">
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->format('M Y') }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $item['judul'] }}</h3>
                                <p class="text-gray-600">{{ $item['deskripsi'] }}</p>
                            </div>
                        </div>

                        <!-- Category Badge -->
                        <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                            {{ $item['kategori'] }}
                        </span>
                    </div>

                    <!-- Time and Location -->
                    <div class="flex items-center space-x-6 text-gray-600">
                        <span class="flex items-center">
                            <i class="far fa-clock mr-2 text-blue-500"></i>
                            {{ $item['waktu'] }} WIB
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                            {{ $item['lokasi'] }}
                        </span>
                    </div>

                    <!-- View Detail Button -->
                    <a href="{{ route('web.agenda.show', $item['id']) }}"
                       class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <!-- Di bagian script -->
<script>
    AOS.init({
        duration: 800,
        once: true
    });

    // Siapkan data agenda
    const agendaData = @json($agenda->map(function($item) {
        return [
            'id' => $item->id,
            'tanggal' => $item->tanggal,
            'judul' => $item->judul
        ];
    }));

    // Initialize calendar
    const calendar = flatpickr("#calendar", {
        inline: true,
        dateFormat: "Y-m-d",
        locale: 'id',
        onChange: function(selectedDates, dateStr) {
            // Cek apakah ada agenda pada tanggal yang dipilih
            const agendasForDate = agendaData.filter(item => {
                const itemDate = new Date(item.tanggal).toISOString().split('T')[0];
                return itemDate === dateStr;
            });

            if (agendasForDate.length > 0) {
                // Jika hanya ada 1 agenda, langsung ke detail agenda tersebut
                if (agendasForDate.length === 1) {
                    window.location.href = `/agenda/${agendasForDate[0].id}`;
                } else {
                    // Jika ada lebih dari 1 agenda, ke halaman daftar agenda tanggal tersebut
                    window.location.href = `/agenda/date/${dateStr}`;
                }
            }
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const currentDate = flatpickr.formatDate(dayElem.dateObj, "Y-m-d");

            // Cek apakah ada agenda pada tanggal ini
            const agendasForDay = agendaData.filter(item => {
                const itemDate = new Date(item.tanggal).toISOString().split('T')[0];
                return itemDate === currentDate;
            });

            if (agendasForDay.length > 0) {
                // Tambahkan class untuk styling
                dayElem.classList.add('has-event');

                // Tambahkan jumlah agenda jika lebih dari 1
                if (agendasForDay.length > 1) {
                    const badge = document.createElement('span');
                    badge.className = 'event-badge';
                    badge.textContent = agendasForDay.length;
                    dayElem.appendChild(badge);
                }

                // Tambahkan tooltip dengan judul agenda
                const tooltipText = agendasForDay.map(item => item.judul).join('\n');
                dayElem.setAttribute('title', tooltipText);
            }
        }
    });
</script>

<!-- Tambahkan style untuk badge -->
<style>
    .event-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background-color: #ef4444;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 2px solid white;
    }

    .flatpickr-day.has-event {
        background: #3b82f6 !important;
        color: white !important;
        border-color: #3b82f6 !important;
        font-weight: bold;
        cursor: pointer !important;
        position: relative;
    }

    .flatpickr-day.has-event:hover {
        background: #2563eb !important;
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
    }
</style>
</body>
</html>
