@extends('layouts.app', ['title' => 'Informasi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center">
            <button class="text-white focus:outline-none bg-green-600 px-4 py-2 shadow-sm rounded-md">
                <a href="{{ route('admin.informasi.create') }}">TAMBAH</a>
            </button>
            <div class="relative mx-4">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <form action="{{ route('admin.informasi.index') }}" method="GET">
                    <input class="form-input w-full rounded-lg pl-10 pr-4" type="text" name="q" value="{{ request()->query('q') }}"
                        placeholder="Search">
                </form>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="w-auto table-auto">
                    <thead class="justify-between">
                        <tr class="bg-green-600">
                            <th class="px-4 py-2" style="width: 30%">
                                <span class="text-white">JUDUL INFORMASI</span>
                            </th>
                            <th class="px-4 py-2 text-left" style="width: 15%">
                                <span class="text-white">KATEGORI</span>
                            </th>
                            <th class="px-4 py-2" style="width: 25%">
                                <span class="text-white">DESKRIPSI</span>
                            </th>
                            <th class="px-4 py-2" style="width: 10%">
                                <span class="text-white">GAMBAR</span>
                            </th>
                            <th class="px-4 py-2 text-left" style="width: 10%">
                                <span class="text-white">TANGGAL POSTING</span>
                            </th>
                            <th class="px-4 py-2 text-left" style="width: 5%">
                                <span class="text-white">STATUS</span>
                            </th>
                            <th class="px-4 py-2" style="width: 5%">
                                <span class="text-white">AKSI</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($informasi as $info)
                        <tr class="border bg-white">
                            <td class="px-4 py-2">
                                {{ $info->judul }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $info->kategori->judul }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $info->deskripsi }}
                            </td>
                            <td class="px-4 py-2">
                                <img src="{{$info->image }}" alt="{{ $info->judul }}" class="w-16 h-16 object-cover" />
                            </td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($info->tanggal)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ ucfirst($info->status) }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.informasi.edit', $info->id) }}" class="bg-indigo-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">EDIT</a>
                                <button onClick="destroy(this.id)" id="{{ $info->id }}" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                Data Belum Tersedia!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($informasi->hasPages())
                <div class="bg-white p-3">
                    {{ $informasi->links('vendor.pagination.tailwind') }} <!-- Adjust pagination -->
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    // AJAX delete function remains the same
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'APAKAH KAMU YAKIN?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX delete
                jQuery.ajax({
                    url: `/admin/informasi/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function(response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }
</script>
@endsection
