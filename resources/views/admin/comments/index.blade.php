@extends('layouts.app', ['title' => 'Manajemen Komentar - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">Manajemen Komentar</h2>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Foto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Komentar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}"
                                         alt="Avatar"
                                         class="h-8 w-8 rounded-full">
                                    <span class="ml-3 font-medium text-gray-900">{{ $comment->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ $comment->photo->image }}"
                                     alt="Photo"
                                     class="h-16 w-16 object-cover rounded">
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $comment->comment }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">{{ $comment->created_at->format('d M Y H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onClick="destroy(this.id, 'comment')"
                                        id="{{ $comment->id }}"
                                        class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data komentar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($comments->hasPages())
            <div class="px-6 py-4 bg-gray-50">
                {{ $comments->links() }}
            </div>
            @endif
        </div>
    </div>
</main>

<!-- Delete Script -->
<script>
function destroy(id, type) {
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
                url: `/admin/${type}s/${id}`,
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
