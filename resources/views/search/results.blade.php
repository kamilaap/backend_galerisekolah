<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - {{ $query }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navbar (sama seperti sebelumnya) -->

    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6">
            @if(isset($hashtag))
                Hasil Pencarian untuk #{{ $hashtag->name }}
            @else
                Hasil Pencarian: "{{ $query }}"
            @endif
        </h1>

        <!-- Hashtags Section -->
        @if(isset($relatedHashtags) && count($relatedHashtags) > 0)
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-3">Hashtag Terkait:</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($relatedHashtags as $tag)
                <a href="{{ route('hashtag.show', $tag->name) }}"
                   class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition-colors">
                    #{{ $tag->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Informasi Results -->
        @if($informasi->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Informasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($informasi as $info)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $info->image }}" alt="{{ $info->judul }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $info->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($info->deskripsi, 100) }}</p>
                        <!-- Hashtags -->
                        @if($info->hashtags->count() > 0)
                        <div class="mb-3 flex flex-wrap gap-1">
                            @foreach($info->hashtags as $tag)
                            <a href="{{ route('hashtag.show', $tag->name) }}"
                               class="text-sm text-blue-600 hover:text-blue-800">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                        @endif
                        <a href="{{ route('web.informasi.show', $info->id) }}"
                           class="text-blue-600 hover:text-blue-800">
                            Baca selengkapnya
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Agenda Results -->
        @if($agenda->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Agenda</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agenda as $item)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center mb-2">
                        <i class="far fa-calendar-alt text-blue-600 mr-2"></i>
                        <span>{{ date('d M Y', strtotime($item->tanggal)) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">{{ $item->judul }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                    <!-- Hashtags -->
                    @if($item->hashtags->count() > 0)
                    <div class="mb-3 flex flex-wrap gap-1">
                        @foreach($item->hashtags as $tag)
                        <a href="{{ route('hashtag.show', $tag->name) }}"
                           class="text-sm text-blue-600 hover:text-blue-800">
                            #{{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                    <a href="{{ route('web.agenda.show', $item->id) }}"
                       class="text-blue-600 hover:text-blue-800">
                        Lihat detail
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Gallery Results -->
        @if($galeries->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Galeri</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galeries as $galery)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($galery->photos->first())
                    <img src="{{ $galery->photos->first()->image }}"
                         alt="{{ $galery->judul }}"
                         class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $galery->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($galery->deskripsi, 100) }}</p>
                        <!-- Hashtags -->
                        @if($galery->hashtags->count() > 0)
                        <div class="mb-3 flex flex-wrap gap-1">
                            @foreach($galery->hashtags as $tag)
                            <a href="{{ route('hashtag.show', $tag->name) }}"
                               class="text-sm text-blue-600 hover:text-blue-800">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                        @endif
                        <a href="{{ route('web.galery.photo', $galery->id) }}"
                           class="text-blue-600 hover:text-blue-800">
                            Lihat galeri
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($informasi->count() === 0 && $agenda->count() === 0 && $galeries->count() === 0)
        <div class="text-center py-8">
            <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-600">
                @if(isset($hashtag))
                    Tidak ada hasil yang ditemukan untuk hashtag #{{ $hashtag->name }}
                @else
                    Tidak ada hasil yang ditemukan untuk "{{ $query }}"
                @endif
            </p>
            <a href="{{ route('welcome') }}"
               class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Kembali ke Beranda
            </a>
        </div>
        @endif
    </div>

    <!-- Footer (sama seperti sebelumnya) -->
</body>
</html> 
