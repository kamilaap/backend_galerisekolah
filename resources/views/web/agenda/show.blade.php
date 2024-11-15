<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $agenda->judul }} - Detail Agenda</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }

        .card-shadow {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .event-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(45deg, #3B82F6, #2563EB);
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 1rem;
            min-width: 100px;
            text-align: center;
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .event-details {
            position: relative;
            z-index: 1;
        }

        .event-details-item {
            background: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .event-details-item:hover {
            transform: translateY(-5px);
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
        }

        .calendar-button {
            background: linear-gradient(45deg, #3B82F6, #2563EB);
            transition: all 0.3s ease;
        }

        .calendar-button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }
    </style>
</head>

<body>
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

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 mb-6 text-sm" data-aos="fade-right">
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-home"></i> Home
            </a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('web.agenda.index') }}" class="text-blue-600 hover:text-blue-800">Agenda</a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-600">{{ $agenda->judul }}</span>
        </div>

        <!-- Event Card -->
        <div class="event-card card-shadow p-8" data-aos="fade-up">
            <!-- Event Header -->
            <div class="event-details text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-4">{{ $agenda->judul }}</h1>

                <!-- Countdown -->
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <div class="countdown-item">
                        <span class="text-2xl font-bold" id="days">00</span>
                        <div class="text-sm">Hari</div>
                    </div>
                    <div class="countdown-item">
                        <span class="text-2xl font-bold" id="hours">00</span>
                        <div class="text-sm">Jam</div>
                    </div>
                    <div class="countdown-item">
                        <span class="text-2xl font-bold" id="minutes">00</span>
                        <div class="text-sm">Menit</div>
                    </div>
                    <div class="countdown-item">
                        <span class="text-2xl font-bold" id="seconds">00</span>
                        <div class="text-sm">Detik</div>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="event-details-item flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="far fa-calendar-alt text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Tanggal</div>
                        <div class="font-semibold">{{ $agenda->tanggal->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="event-details-item flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="far fa-clock text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Waktu</div>
                        <div class="font-semibold">{{ $agenda->waktu ?? '08:00' }} WIB</div>
                    </div>
                </div>

                <div class="event-details-item flex items-center space-x-4">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Lokasi</div>
                        <div class="font-semibold">{{ $agenda->lokasi ?? 'SMKN 4 Bogor' }}</div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold mb-4">Deskripsi Acara</h2>
                <p class="text-gray-700 leading-relaxed">{{ $agenda->deskripsi }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="addToCalendar(event)"
                        class="calendar-button flex items-center space-x-2 px-6 py-3 text-white rounded-lg">
                    <i class="far fa-calendar-plus"></i>
                    <span>Tambahkan ke Kalender</span>
                </button>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                       target="_blank"
                       class="share-button text-blue-600 hover:text-blue-800">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $agenda->judul }}"
                       target="_blank"
                       class="share-button text-blue-400 hover:text-blue-600">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="https://wa.me/?text={{ $agenda->judul }}%20{{ url()->current() }}"
                       target="_blank"
                       class="share-button text-green-600 hover:text-green-800">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                </div>
            </div>

         
        </div>

        <!-- Navigation -->
        <div class="flex justify-between mt-8">
            @if($prevAgenda = \App\Models\Agenda::where('tanggal', '<', $agenda->tanggal)->orderBy('tanggal', 'desc')->first())
            <a href="{{ route('web.agenda.show', $prevAgenda->id) }}"
               class="flex items-center space-x-2 px-4 py-2 bg-white rounded-lg text-gray-700 hover:text-blue-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-chevron-left"></i>
                <span>Agenda Sebelumnya</span>
            </a>
            @endif

            @if($nextAgenda = \App\Models\Agenda::where('tanggal', '>', $agenda->tanggal)->orderBy('tanggal')->first())
            <a href="{{ route('web.agenda.show', $nextAgenda->id) }}"
               class="flex items-center space-x-2 px-4 py-2 bg-white rounded-lg text-gray-700 hover:text-blue-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <span>Agenda Selanjutnya</span>
                <i class="fas fa-chevron-right"></i>
            </a>
            @endif
        </div>
    </main>

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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Countdown Timer
        function updateCountdown() {
            const eventDate = new Date("{{ $agenda->tanggal }}").getTime();
            const now = new Date().getTime();
            const distance = eventDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").textContent = String(days).padStart(2, '0');
            document.getElementById("hours").textContent = String(hours).padStart(2, '0');
            document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
            document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Add to Calendar Function
        function addToCalendar(e) {
            e.preventDefault();
            const event = {
                title: "{{ $agenda->judul }}",
                start: "{{ $agenda->tanggal }}",
                duration: 60,
                description: "{{ $agenda->deskripsi }}",
                location: "{{ $agenda->lokasi ?? 'SMKN 4 Bogor' }}"
            };

            const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(event.title)}&dates=${event.start}/${event.start}&details=${encodeURIComponent(event.description)}&location=${encodeURIComponent(event.location)}`;

            window.open(googleCalendarUrl, '_blank');
        }
    </script>
</body>

</html>
