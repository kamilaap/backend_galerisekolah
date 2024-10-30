@extends('layouts.app', ['title' => 'Tambah Informasi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH INFORMASI</h2>
            <hr class="mt-4">

            <!-- Form untuk menambah informasi -->
            <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">

                    <!-- Judul Informasi -->
                    <div>
                        <label class="text-gray-700" for="judul">JUDUL INFORMASI</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="judul" value="{{ old('judul') }}" placeholder="Judul Informasi" required>
                        @error('judul')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="text-gray-700" for="kategori_id">KATEGORI</label>
                        <select name="kategori_id" class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->judul }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="text-gray-700" for="deskripsi">DESKRIPSI</label>
                        <textarea class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" name="deskripsi" rows="4" placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="text-gray-700" for="image">GAMBAR</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white p-3" type="file" name="image">
                        @error('image')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-gray-700" for="status">STATUS</label>
                        <select name="status" class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" required>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Posting -->
                    <div>
                        <label class="text-gray-700" for="tanggal">TANGGAL POSTING</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date" name="tanggal" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</main>


@endsection
