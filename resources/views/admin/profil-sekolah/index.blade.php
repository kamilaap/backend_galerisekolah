@extends('layouts.app', ['title' => 'Profil Sekolah - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">Kelola Profil Sekolah</h2>
            <div>
                <a href="{{ route('admin.profil-sekolah.edit') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Profil
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- Content Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Welcome Section Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden col-span-2">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-home text-blue-600 text-xl mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Welcome Section</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Judul Welcome</label>
                            <p class="text-gray-800 mt-1">{{ $profil->welcome_title }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Sub Judul Welcome</label>
                            <p class="text-gray-800 mt-1">{{ $profil->welcome_subtitle }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Deskripsi Welcome</label>
                            <p class="text-gray-800 mt-1">{{ $profil->welcome_description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-info-circle text-blue-600 text-xl mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Deskripsi</h3>
                    </div>
                    <p class="text-gray-600">{{ $profil->deskripsi }}</p>
                </div>
            </div>

            <!-- Visi Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-bullseye text-blue-600 text-xl mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Visi</h3>
                    </div>
                    <p class="text-gray-600">{{ $profil->visi }}</p>
                </div>
            </div>

            <!-- Misi Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-list-ul text-blue-600 text-xl mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Misi</h3>
                    </div>
                    <div class="text-gray-600 misi-content">
                        {!! nl2br(e($profil->misi)) !!}
                    </div>
                </div>
            </div>

            <!-- Video Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-video text-blue-600 text-xl mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Video Profile</h3>
                    </div>
                    @if($profil->video_url)
                        <div class="aspect-w-16 aspect-h-9 mb-4">
                            <iframe
                                src="{{ $profil->video_url }}"
                                class="w-full rounded-lg"
                                allowfullscreen
                                frameborder="0">
                            </iframe>
                        </div>
                        <a href="{{ $profil->video_url }}"
                           target="_blank"
                           class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Buka di YouTube
                        </a>
                    @else
                        <div class="bg-gray-100 rounded-lg p-4 text-center">
                            <i class="fas fa-film text-gray-400 text-4xl mb-2"></i>
                            <p class="text-gray-500">Video belum diatur</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.misi-content {
    white-space: pre-line;
}
</style>
@endsection
