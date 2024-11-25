@extends('layouts.app', ['title' => 'Edit Profil Sekolah - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Profil Sekolah</h2>

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.profil-sekolah.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Welcome Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Welcome Page</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Judul Welcome
                                </label>
                                <input type="text" name="welcome_title"
                                    value="{{ old('welcome_title', $profil->welcome_title ?? 'Selamat Datang Di Edu Galery') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Sub Judul Welcome
                                </label>
                                <input type="text" name="welcome_subtitle"
                                    value="{{ old('welcome_subtitle', $profil->welcome_subtitle ?? 'Membangun Generasi Digital yang Unggul dan Berkarakter') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Deskripsi Welcome
                                </label>
                                <textarea name="welcome_description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('welcome_description', $profil->welcome_description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Deskripsi Sekolah
                        </label>
                        <textarea name="deskripsi" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                    </div>

                    <!-- Visi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Visi
                        </label>
                        <textarea name="visi" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('visi', $profil->visi ?? '') }}</textarea>
                    </div>

                    <!-- Misi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Misi
                        </label>
                        <textarea name="misi" id="misi" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('misi', $profil->misi ?? '') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">
                            Format misi akan ditampilkan dalam bentuk list. Gunakan format HTML (ul/li) untuk membuat daftar misi yang rapih.
                        </p>
                    </div>

                    <!-- Video URL -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Video URL
                        </label>
                        <input type="url" name="video_url"
                            value="{{ old('video_url', $profil->video_url ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="https://www.youtube.com/embed/...">
                        <p class="mt-1 text-sm text-gray-500">
                            Gunakan URL embed dari YouTube (contoh: https://www.youtube.com/embed/VIDEO_ID)
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.profil-sekolah.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#misi'), {
            toolbar: ['bulletedList', 'numberedList', '|', 'undo', 'redo'],
            removePlugins: ['Heading', 'Link', 'image'],
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
