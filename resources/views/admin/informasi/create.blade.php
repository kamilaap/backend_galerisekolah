@extends('layouts.app', ['title' => 'Tambah Informasi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Tambah Informasi Baru</h2>
                    <a href="{{ route('admin.informasi.index') }}"
                       class="inline-flex items-center px-3 py-2 border border-white/20 rounded-md text-sm text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.informasi.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-6">
                @csrf

                <!-- Grid Layout untuk Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Informasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="judul"
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan judul informasi"
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi"
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                  placeholder="Masukkan deskripsi informasi"
                                  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload gambar</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Posting <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="tanggal"
                               value="{{ old('tanggal') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tags
                        </label>
                        <input type="text"
                               name="tags"
                               value="{{ old('tags') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Contoh: event, sekolah, prestasi (pisahkan dengan koma)">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-2">
                    <button type="reset"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        Reset
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Preview Image Script -->
<script>
document.getElementById('image').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.className = 'mt-2 rounded-lg w-full max-h-48 object-cover';
            const container = document.querySelector('.space-y-1');
            const existingPreview = container.querySelector('img');
            if (existingPreview) {
                container.removeChild(existingPreview);
            }
            container.appendChild(preview);
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
