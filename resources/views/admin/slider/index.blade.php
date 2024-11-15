@extends('layouts.app', ['title' => 'Slider - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">Kelola Slider</h2>
        </div>

        <!-- Upload Form Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-white">Upload Slider Baru</h2>
            </div>

            <form action="{{ route('admin.slider.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-6">
                @csrf

                <!-- Grid Layout untuk Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image Upload -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Slider <span class="text-red-500">*</span>
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

                    <!-- Link -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link Slider <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="link"
                               value="{{ old('link') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan link slider"
                               required>
                        @error('link')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Slider
                    </button>
                </div>
            </form>
        </div>

        <!-- Slider List Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Preview
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Link
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($sliders as $slider)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ $slider->image }}"
                                     alt="Slider Image"
                                     class="h-32 w-64 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ $slider->link }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $slider->link }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onClick="destroy(this.id)"
                                        id="{{ $slider->id }}"
                                        class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data slider
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($sliders->hasPages())
            <div class="px-6 py-4 bg-gray-50">
                {{ $sliders->links() }}
            </div>
            @endif
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

// Delete Confirmation
function destroy(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                url: `/admin/slider/${id}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                },
                error: function (error) {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>
@endsection
