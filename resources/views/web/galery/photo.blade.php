<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - {{ $galery->judul }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .photo-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            border-radius: 1rem;
        }

        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .photo-container {
            position: relative;
            overflow: hidden;
            padding-top: 75%; /* 4:3 Aspect Ratio */
        }

        .photo-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .photo-card:hover .photo-container img {
            transform: scale(1.1);
        }

        .like-button {
            transition: all 0.3s ease;
        }

        .like-button:hover {
            transform: scale(1.1);
        }

        .like-button.liked {
            animation: likeEffect 0.5s ease;
        }

        @keyframes likeEffect {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .comment-section {
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(59, 130, 246, 0.5) transparent;
        }

        .comment-section::-webkit-scrollbar {
            width: 6px;
        }

        .comment-section::-webkit-scrollbar-thumb {
            background-color: rgba(59, 130, 246, 0.5);
            border-radius: 3px;
        }

        .modal {
            backdrop-filter: blur(8px);
        }

        .download-button {
            background: linear-gradient(45deg, #3B82F6, #2563EB);
            transition: all 0.3s ease;
        }

        .download-button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        /* Fullscreen Modal */
        #fullscreenModal {
            background: rgba(0, 0, 0, 0.9);
            transition: opacity 0.3s ease;
        }

        #fullscreenModal img {
            max-height: 90vh;
            max-width: 90vw;
            object-fit: contain;
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
        }

        .share-button:active {
            transform: scale(0.95);
        }

        /* Tambahan style untuk balasan admin */
        .admin-reply {
            background-color: #EBF8FF;
            border-left: 4px solid #3B82F6;
            margin-left: 2rem;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .admin-badge {
            background-color: #3B82F6;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo SMKN 4 Bogor" class="h-10 mr-2">
                <a href="#" class="text-white font-bold text-lg">SMK INDONESIA DIGITAL</a>
            </div>

            <!-- Form Pencarian -->
            <form id="search-form" action="{{ route('search') }}" method="GET" class="flex items-center bg-gray-700 rounded-lg overflow-hidden">
                <input type="text" name="query" placeholder="Cari..." class="bg-transparent text-white px-4 py-1 outline-none" required>
                <button type="submit" class="text-white px-3 hover:bg-gray-600 transition duration-300">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="flex items-center space-x-6">
                <a href="{{ route('web.informasi.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-info-circle"></i><span>Informasi</span>
                </a>
                <a href="{{ route('web.informasi.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-calendar-alt"></i><span>Agenda</span>
                </a>
                <a href="{{ route('web.galery.index') }}" class="text-white flex items-center space-x-1">
                    <i class="fas fa-images"></i><span>Galeri</span>
                </a>
            </div>

            <div>
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Login</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 mb-6 text-sm" data-aos="fade-right">
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-home"></i> Home
            </a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('web.galery.index') }}" class="text-blue-600 hover:text-blue-800">Galeri</a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-600">{{ $galery->judul }}</span>
        </div>

        <!-- Gallery Header -->
        <div class="bg-white rounded-xl p-6 mb-8 shadow-lg" data-aos="fade-up">
            <h1 class="text-3xl font-bold mb-4">{{ $galery->judul }}</h1>
            <p class="text-gray-600">{{ $galery->deskripsi }}</p>
        </div>

        <!-- Photo Grid -->
        <div class="photo-grid">
            @if($galery && $galery->photos)
                @foreach($galery->photos as $photo)
                <div class="photo-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Photo Container -->
                    <div class="photo-container cursor-pointer" onclick="openFullscreen('{{ $photo->image }}')">
                        <img src="{{ $photo->image }}" alt="{{ $photo->judul ?? 'Photo' }}" class="transition-transform duration-500">
                    </div>

                    <!-- Photo Info -->
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-4">{{ $photo->judul ?? 'Untitled' }}</h3>

                        <!-- Like Button -->
                        <div class="flex items-center space-x-4 mt-4">
                            @auth
                                <button
                                    onclick="toggleLike({{ $photo->id }})"
                                    id="likeButton-{{ $photo->id }}"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-full transition-all duration-300
                                        {{ $photo->isLikedBy(auth()->user())
                                            ? 'bg-red-500 text-white'
                                            : 'bg-gray-200 text-gray-700'
                                        }} hover:bg-red-500 hover:text-white"
                                >
                                    <i class="fas fa-heart"></i>
                                    <span id="likeCount-{{ $photo->id }}">{{ $photo->likes_count }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                                    Login untuk menyukai foto
                                </a>
                            @endauth
                        </div>

                        <!-- Comments Section -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold mb-4">Komentar</h4>

                            @auth
                                @if(auth()->user()->role === 'user')
                                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                                        @csrf
                                        <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                        <textarea
                                            name="comment"
                                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                            placeholder="Tulis komentar Anda..."
                                            rows="3"
                                            required
                                        ></textarea>
                                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            Kirim Komentar
                                        </button>
                                    </form>
                                @endif
                            @else
                                <p class="text-gray-600 mb-4">
                                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> untuk memberikan komentar
                                </p>
                            @endauth

                            <!-- Daftar Komentar -->
                            <div class="space-y-4">
                                @if($photo->comments && $photo->comments->count() > 0)
                                    @foreach($photo->comments as $comment)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <!-- User Comment -->
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-1">
                                                        <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                                        <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>

                                                        <!-- Delete Button (for admin and comment owner) -->
                                                        @auth
                                                            @if(auth()->user()->role === 'admin' || auth()->id() === $comment->user_id)
                                                                <button
                                                                    onclick="deleteComment({{ $comment->id }})"
                                                                    class="ml-2 text-red-500 hover:text-red-700 transition-colors duration-200"
                                                                    title="Hapus komentar"
                                                                >
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                    <p class="text-gray-700">{{ $comment->comment }}</p>

                                                    <!-- Toggle Button for Replies -->
                                                    @if($comment->replies && count($comment->replies) > 0)
                                                        <button
                                                            onclick="toggleAdminReplies({{ $comment->id }})"
                                                            class="text-blue-500 text-sm mt-2 hover:underline flex items-center"
                                                        >
                                                            <span id="toggleText-{{ $comment->id }}">Lihat balasan admin</span>
                                                            <i id="toggleIcon-{{ $comment->id }}" class="fas fa-chevron-down ml-1"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Admin Replies (Hidden by default) -->
                                            <div id="adminReplies-{{ $comment->id }}" class="hidden mt-3">
                                                @if($comment->replies)
                                                    @foreach($comment->replies as $reply)
                                                        <div class="admin-reply" data-reply-id="{{ $reply->id }}">
                                                            <div class="flex justify-between items-start">
                                                                <div>
                                                                    <span class="admin-badge">
                                                                        <i class="fas fa-shield-alt mr-1"></i>Admin
                                                                    </span>
                                                                    <div class="flex items-center mb-1">
                                                                        <span class="font-semibold text-gray-800">
                                                                            {{ $reply->admin ? $reply->admin->name : 'Admin' }}
                                                                        </span>
                                                                        <span class="text-gray-500 text-sm ml-2">
                                                                            {{ $reply->created_at->diffForHumans() }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                @auth
                                                                    @if(auth()->user()->role === 'admin')
                                                                        <button
                                                                            onclick="deleteAdminReply({{ $reply->id }})"
                                                                            class="ml-2 text-red-500 hover:text-red-700 transition-colors duration-200"
                                                                            title="Hapus balasan"
                                                                        >
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                            <p class="text-gray-700">{{ $reply->reply }}</p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <!-- Reply Button (Only visible to admin) -->
                                            @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <button
                                                        onclick="toggleReplyForm({{ $comment->id }})"
                                                        class="text-blue-500 text-sm mt-2 hover:underline"
                                                    >
                                                        Reply
                                                    </button>

                                                    <!-- Reply Form -->
                                                    <div id="replyForm-{{ $comment->id }}" class="mt-3 hidden">
                                                        <form action="{{ route('admin.reply.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                            <textarea
                                                                name="reply"
                                                                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                                                placeholder="Tulis balasan..."
                                                                rows="2"
                                                                required
                                                            ></textarea>
                                                            <button type="submit" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                                                                Kirim Balasan
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-center">Belum ada komentar.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="flex items-center space-x-6 mt-4 text-gray-600 text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-eye"></i>
                                <span>{{ $photo->views_count }} views</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-heart"></i>
                                <span>{{ $photo->likes_count }} likes</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-comment"></i>
                                <span>{{ $photo->comments_count }} comments</span>
                            </div>
                        </div>

                        <!-- Share Buttons -->
                        <div class="flex items-center space-x-4 mt-4">
                            <span class="text-gray-600">Bagikan:</span>
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="share-button text-blue-600 hover:text-blue-800">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <!-- Instagram -->
                            <button
                                onclick="shareToInstagram('{{ $photo->image }}', '{{ $photo->judul ?? 'Photo' }}')"
                                class="share-button text-pink-600 hover:text-pink-800">
                                <i class="fab fa-instagram"></i>
                            </button>
                        </div>

                        <!-- Tags -->
                        @if($galery->hashtags && $galery->hashtags->count() > 0)
                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach($galery->hashtags as $tag)
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                #{{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Tidak ada foto yang tersedia.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Fullscreen Modal -->
    <div id="fullscreenModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
        <button onclick="closeFullscreen()" class="absolute top-4 right-4 text-white text-xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
        <img id="fullscreenImage" src="" alt="Fullscreen view">
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto text-center">
            <div class="mb-4">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo SMKN 4 Bogor" class="h-16 mx-auto">
            </div>
            <p class="text-lg">&copy; 2024 SMK Negeri 4 Bogor. Semua hak cipta dilindungi.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        function toggleLike(photoId) {
            fetch(`/photos/${photoId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likeButton = document.getElementById(`likeButton-${photoId}`);
                    const likeCount = document.getElementById(`likeCount-${photoId}`);

                    if (data.liked) {
                        likeButton.classList.remove('bg-gray-200', 'text-gray-700');
                        likeButton.classList.add('bg-red-500', 'text-white', 'liked');
                    } else {
                        likeButton.classList.remove('bg-red-500', 'text-white', 'liked');
                        likeButton.classList.add('bg-gray-200', 'text-gray-700');
                    }

                    likeCount.textContent = data.likes_count;
                } else {
                    window.location.href = '/login';
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function openFullscreen(imageSrc) {
            const modal = document.getElementById('fullscreenModal');
            const fullscreenImage = document.getElementById('fullscreenImage');

            fullscreenImage.src = imageSrc;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeFullscreen() {
            const modal = document.getElementById('fullscreenModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('fullscreenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFullscreen();
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFullscreen();
            }
        });

        function shareToInstagram(imageUrl, caption) {
            // Untuk mobile
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // Deep linking ke Instagram
                window.location.href = `instagram://library?AssetPath=${encodeURIComponent(imageUrl)}`;

                // Fallback jika deep linking gagal
                setTimeout(() => {
                    window.location.href = 'https://www.instagram.com/';
                }, 2000);
            } else {
                // Untuk desktop
                // Buat temporary textarea untuk copy caption
                const textarea = document.createElement('textarea');
                textarea.value = `${caption}\n\nLihat lebih banyak di: ${window.location.href}`;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                // Buka Instagram di tab baru
                window.open('https://www.instagram.com/', '_blank');

                // Tampilkan instruksi
                alert('Caption telah disalin ke clipboard.\nSilakan paste caption setelah mengupload foto ke Instagram.');

                // Download gambar
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = 'photo.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        // Tambahkan event listener untuk tracking share
        document.querySelectorAll('.share-button').forEach(button => {
            button.addEventListener('click', function() {
                // Animasi ketika tombol di klik
                this.classList.add('scale-110');
                setTimeout(() => {
                    this.classList.remove('scale-110');
                }, 200);
            });
        });

        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            replyForm.classList.toggle('hidden');
        }

        function toggleAdminReplies(commentId) {
            const repliesDiv = document.getElementById(`adminReplies-${commentId}`);
            const toggleText = document.getElementById(`toggleText-${commentId}`);
            const toggleIcon = document.getElementById(`toggleIcon-${commentId}`);

            if (repliesDiv.classList.contains('hidden')) {
                repliesDiv.classList.remove('hidden');
                toggleText.textContent = 'Sembunyikan balasan admin';
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            } else {
                repliesDiv.classList.add('hidden');
                toggleText.textContent = 'Lihat balasan admin';
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete forms
            document.querySelectorAll('.delete-reply-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (confirm('Yakin ingin menghapus balasan ini?')) {
                        fetch(this.action, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the reply element
                                this.closest('.admin-reply').remove();
                            } else {
                                alert('Gagal menghapus balasan');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus balasan');
                        });
                    }
                });
            });
        });

        function deleteComment(commentId) {
            Swal.fire({
                title: 'Hapus Komentar?',
                text: "Komentar yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Komentar berhasil dihapus.',
                                icon: 'success'
                            }).then(() => {
                                // Refresh halaman setelah komentar dihapus
                                window.location.reload();
                            });
                        } else {
                            // Tampilkan pesan error
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menghapus komentar',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus komentar',
                            'error'
                        );
                    });
                }
            });
        }

        // Fungsi untuk menghapus balasan admin
        function deleteAdminReply(replyId) {
            Swal.fire({
                title: 'Hapus Balasan?',
                text: "Balasan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/replies/${replyId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hapus elemen balasan dari DOM
                            const replyElement = document.querySelector(`[data-reply-id="${replyId}"]`);
                            if (replyElement) {
                                replyElement.remove();
                            }

                            // Tampilkan pesan sukses
                            Swal.fire(
                                'Terhapus!',
                                'Balasan berhasil dihapus.',
                                'success'
                            );
                        } else {
                            // Tampilkan pesan error
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menghapus balasan',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus balasan',
                            'error'
                        );
                    });
                }
            });
        }
    </script>
</body>

</html>
