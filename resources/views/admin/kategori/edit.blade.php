@extends('layouts.app', ['title' => 'Edit Kategori - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold
capitalize">EDIT KATEGORI</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.kategori.update',
$kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="judul">JUDUL KATEGORI</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="judul" value="{{ old('judul') }}" placeholder="Judul Kategori" required>
                        @error('judul')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="deskripsi">DESKRIPSI</label>
                        <textarea class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" name="deskripsi" rows="4" placeholder="Deskripsi Kategori" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-green-600
text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
