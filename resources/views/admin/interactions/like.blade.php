@extends('layouts.app', ['title' => 'Manage Likes'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold mb-6">Manage Likes</h1>

        {{-- Likes Section --}}
        <h2 class="text-xl font-semibold mb-4">Likes</h2>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between bg-green-600">
                        <tr>
                            <th class="px-16 py-2">
                                <span class="text-white">User</span>
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
                        @forelse($likes as $like)
                            <tr class="border bg-white">
                                <td class="px-4 py-2">
                                    {{ $like->user->name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $like->comment->comment }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('admin.likes.destroy', $like->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Delete Like</button>
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
@endsection
