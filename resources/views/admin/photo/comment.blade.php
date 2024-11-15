@extends('layouts.app', ['title' => 'Komentar - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <!-- Tabel Komentar -->
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between bg-green-500">
                        <tr>
                            <th class="px-16 py-2">
                                <span class="text-white">ID FOTO</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">USERNAME</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">KOMENTAR</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">TANGGAL KOMENTAR</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">BALASAN ADMIN</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">AKSI</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($comments as $comment)
                            <tr class="border bg-white">
                                <td class="px-16 py-2">{{ $comment->photo_id }}</td>
                                <td class="px-16 py-2">{{ $comment->user->name }}</td>
                                <td class="px-16 py-2">{{ $comment->comment }}</td>
                                <td class="px-16 py-2">{{ $comment->created_at }}</td>
                                <td class="px-16 py-2">{{ $comment->admin_reply ?? 'Belum ada balasan' }}</td>
                                <td class="px-16 py-2 text-center">
                                    <form action="{{ route('admin.comments.reply', $comment->id) }}" method="POST">
                                        @csrf
                                        <input type="text" name="reply" class="form-input" placeholder="Balas komentar" required>
                                        <button type="submit" class="bg-green-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none mt-2">BALAS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="bg-green-500 text-white text-center p-3 rounded-sm shadow-md">
                                        Belum Ada Komentar!
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($comments->hasPages())
                    <div class="bg-white p-3">
                        {{ $comments->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
