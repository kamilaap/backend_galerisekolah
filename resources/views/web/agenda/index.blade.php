<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background: #3B82F6;
            color: white;
            border-radius: 50%;
            animation: eventPulse 2s infinite;
        }

        @keyframes eventPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <!-- Navbar (sama seperti sebelumnya) -->

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
            <div class="timeline-item" data-aos="{{ $loop->iteration % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                <div class="timeline-content">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="far fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div>
                                <span class="text-gray-600">{{ date('d M Y', strtotime($item->tanggal)) }}</span>
                                <div class="text-sm text-gray-500">{{ $item->waktu ?? '08:00' }} WIB</div>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                            {{ $item->kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <h2 class="text-xl font-bold mb-3">{{ $item->judul }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($item->deskripsi, 150) }}</p>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                            {{ $item->lokasi ?? 'SMKN 4 Bogor' }}
                        </div>

                        <a href="{{ route('web.agenda.show', $item->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer (sama seperti sebelumnya) -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Initialize calendar
        const calendar = flatpickr("#calendar", {
            inline: true,
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                window.location.href = `/agenda/date/${dateStr}`;
            }
        });

        // Mark dates with events
        document.addEventListener('DOMContentLoaded', function() {
            const dates = document.querySelectorAll('.flatpickr-day');
            const eventDates = [
                {!! $agenda->map(function($item) {
                    return "'" . date("Y-m-d", strtotime($item->tanggal)) . "'";
                })->implode(',') !!}
            ];

            dates.forEach(date => {
                if (eventDates.includes(date.getAttribute('aria-label'))) {
                    date.classList.add('has-event');
                }
            });
        });
    </script>
</body>
</html>
