@extends('layouts.app', ['title' => 'Agenda - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">Kelola Agenda</h2>
            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 w-full md:w-auto">
                <!-- Search Box -->
                <div class="relative flex-grow md:flex-grow-0">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-500"></i>
                    </span>
                    <form action="{{ route('admin.agenda.index') }}" method="GET">
                        <input type="text"
                               name="q"
                               value="{{ request()->query('q') }}"
                               class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               placeholder="Cari agenda...">
                    </form>
                </div>

                <!-- Add Button -->
                <a href="{{ route('admin.agenda.create') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Agenda
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul & Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($agendas as $agenda)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-900">{{ $agenda->judul }}</span>
                                    <span class="text-sm text-gray-500">{{ $agenda->kategori->judul }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $agenda->deskripsi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        Post: {{ \Carbon\Carbon::parse($agenda->tanggal_post_agenda)->format('d M Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $agenda->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($agenda->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}"
                                       class="text-blue-600 hover:text-blue-900 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onClick="destroy(this.id)"
                                            id="{{ $agenda->id }}"
                                            class="text-red-600 hover:text-red-900 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data agenda
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($agendas->hasPages())
            <div class="px-6 py-4 bg-gray-50">
                {{ $agendas->links() }}
            </div>
            @endif
        </div>
    </div>
</main>

<!-- Delete Confirmation Modal -->
<script>
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
                url: `/admin/agenda/${id}`,
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
