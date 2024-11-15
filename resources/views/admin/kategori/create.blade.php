@extends('layouts.app', ['title' => 'Tambah Kategori - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Tambah Kategori Baru</h2>
                    <a href="{{ route('admin.kategori.index') }}"
                       class="inline-flex items-center px-3 py-2 border border-white/20 rounded-md text-sm text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.kategori.store') }}"
                  method="POST"
                  class="p-6 space-y-6">
                @csrf

                <!-- Grid Layout untuk Form -->
                <div class="grid grid-cols-1 gap-6">
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="judul"
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan nama kategori"
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi"
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                  placeholder="Masukkan deskripsi kategori"
                                  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-2">
                    <button type="reset"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        Reset
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
