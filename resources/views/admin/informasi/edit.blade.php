@extends('layouts.app', ['title' => 'Edit Informasi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Informasi</h2>
                    <a href="{{ route('admin.informasi.index') }}"
                       class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.informasi.update', $informasi->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Informasi
                        </label>
                        <input type="text"
                               name="judul"
                               value="{{ old('judul', $informasi->judul) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select name="kategori_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $kategori)
                                <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id', $informasi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('deskripsi', $informasi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Preview & Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar
                    </label>
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <img src="{{ $informasi->image }}"
                                 alt="Current image"
                                 class="h-32 w-32 object-cover rounded-lg">
                        </div>
                        <div class="flex-1">
                            <input type="file"
                                   name="image"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">
                                Biarkan kosong jika tidak ingin mengubah gambar
                            </p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status & Tanggal -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="active" {{ old('status', $informasi->status) == 'active' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="inactive" {{ old('status', $informasi->status) == 'inactive' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Posting
                        </label>
                        <input type="date"
                               name="tanggal"
                               value="{{ old('tanggal', $informasi->tanggal) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

               

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
