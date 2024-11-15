@extends('layouts.app', ['title' => 'Manage Comments'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold mb-6">Manage Comments</h1>

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
                        @foreach($comments as $comment)
                            <tr class="border bg-white">
                                <td class="px-4 py-2">
                                    {{ $comment->user ? $comment->user->name : 'Unknown User' }}
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
                                    {{-- Only show reply form for admin --}}
                                    @if(Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.comment.reply', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="text" name="reply" placeholder="Reply..." required class="border p-1">
                                            <button type="submit" class="bg-green-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Reply</button>
                                        </form>
                                    @endif
                                    {{-- Delete button --}}
                                    <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @foreach($comments as $comment)
    <tr class="border bg-white">
        <td class="px-4 py-2">
            {{ $comment->user ? $comment->user->name : 'Unknown User' }}
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
            {{-- Show like count --}}
            <span>{{ $comment->likes_count }} Likes</span>

            {{-- Like button (only for authenticated users) --}}
            @auth
                <form action="{{ route('comment.like', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="bg-blue-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">
                        Like
                    </button>
                </form>
            @endauth
        </td>
    </tr>
@endforeach

                            {{-- Display replies --}}
                            @foreach($comment->replies as $reply)
                                <tr class="border bg-gray-100">
                                    <td class="px-4 py-2">
                                        {{ $reply->user ? $reply->user->name : 'Unknown User' }} (Reply)
                                    </td>
                                    <td colspan="2" class="px-4 py-2">
                                        {{ $reply->reply }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        {{-- Only admins can delete replies --}}
                                        @if(Auth::user()->role === 'admin')
                                            <form action="{{ route('admin.reply.destroy', $reply->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none">Delete Reply</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
