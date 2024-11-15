{{-- resources/views/admin/interactions/index.blade.php --}}

@extends('layouts.app', ['title' => 'Manage Comments and Likes'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold mb-6">Manage Comments and Likes</h1>

        {{-- Comments Section --}}
        <h2 class="text-xl font-semibold mb-4">Comments</h2>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between bg-green-600">
                        <tr>
                            <th class="px-16 py-2">
                                <span class="text-white">User</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Photo</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Comment</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($comments as $comment)
                            <tr class="border bg-white">
                                <td class="px-4 py-2">
                                    {{ $comment->user->name }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.photo.index', $comment->photo_id) }}" target="_blank">
                                        View Photo
                                    </a>
                                </td>
                                <td class="px-4 py-2">
                                    {{ $comment->comment }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Delete</button>
                                    </form>

                                    {{-- Form untuk balasan --}}
                                    <form action="{{ route('admin.comment.reply', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="text" name="reply" placeholder="Reply..." required class="border p-1">
                                        <button type="submit" class="bg-green-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Reply</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                    No Comments Available!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Likes Section --}}
        <h2 class="text-xl font-semibold mb-4 mt-8">Likes</h2>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between bg-green-600">
                        <tr>
                            <th class="px-16 py-2">
                                <span class="text-white">User</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">Photo</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($likes as $like)
                            <tr class="border bg-white">
                                <td class="px-4 py-2">
                                    {{ $like->user->name }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.photo.index', $like->photo_id) }}" target="_blank">
                                        View Photo
                                    </a>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('admin.like.destroy', $like->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                    No Likes Available!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                    url: `/admin/agenda/${id}`,
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
