<?php

use Illuminate\Support\Facades\Route;

// Controllers untuk Web/User
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebProfileController;
use App\Http\Controllers\AdminReplyController;

// Controllers untuk Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PhotoInteractionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\LikesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JurusanController;


Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Middleware
use App\Http\Middleware\PreventBackHistory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/full-informasi', [HomeController::class, 'fullInformasi'])->name('web.informasi.index');
Route::get('/full-gallery', [HomeController::class, 'fullGallery'])->name('web.galery.index');
Route::get('/full-agenda', [HomeController::class, 'fullAgenda'])->name('web.agenda.index');
Route::get('/galery/{id}/photos', [HomeController::class, 'showGalleryPhotos'])->name('web.galery.photo');
Route::get('/galery/{id}', [GaleryController::class, 'show'])->name('web.galery.show');
Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('web.agenda.show');
Route::get('/jurusan/{id}', [JurusanController::class, 'show'])->name('web.jurusan.show');Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('web.informasi.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/agenda/date/{date}', [HomeController::class, 'showByDate'])->name('web.agenda.by-date');


// Download Routes
Route::get('download-photo/{id}', [HomeController::class, 'downloadPhoto'])->name('download.photo');
Route::get('download-informasi-photo/{id}', [HomeController::class, 'downloadInformasiPhoto'])->name('download.informasi.photo');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [WebProfileController::class, 'index'])->name('web.profile');
        Route::get('/edit', [WebProfileController::class, 'edit'])->name('web.profile.edit');
        Route::post('/update', [WebProfileController::class, 'update'])->name('web.profile.update');
        Route::delete('/destroy', [WebProfileController::class, 'destroy'])->name('web.profile.destroy');
    });

    // Comment Routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comments.reply');

    // Like Routes
    Route::post('/photos/{photo}/like', [LikeController::class, 'toggleLike'])->name('photos.like');
    Route::post('photos/{photo}/likes', [LikeController::class, 'store']);
    Route::delete('photos/{photo}/likes', [LikeController::class, 'destroy']);
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin', PreventBackHistory::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Resource Routes
    Route::resource('jurusan', JurusanController::class, ['as' => 'admin']);
    Route::resource('/kategori', KategoriController::class, ['as' => 'admin']);
    Route::resource('/informasi', InformasiController::class, ['as' => 'admin']);
    Route::resource('/agenda', AgendaController::class, ['as' => 'admin']);
    Route::resource('/galery', GaleryController::class, ['as' => 'admin']);
    Route::resource('/photo', PhotoController::class, ['as' => 'admin']);
    Route::resource('/slider', SliderController::class, [
        'as' => 'admin',
        'except' => ['show', 'create', 'edit', 'update']
    ]);
    Route::resource('/users', UserController::class)->names('admin.users');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');

    // Photo Interactions
    Route::prefix('interactions')->group(function () {
        Route::get('/', [PhotoInteractionController::class, 'index'])->name('admin.interactions.index');
        Route::delete('/comments/{id}', [PhotoInteractionController::class, 'destroyComment'])->name('admin.comment.destroy');
        Route::delete('/likes/{id}', [PhotoInteractionController::class, 'destroyLike'])->name('admin.like.destroy');
        Route::post('/comments/{id}/reply', [PhotoInteractionController::class, 'replyToComment'])->name('admin.comment.reply');
    });

    // Comments Management
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');

    // Likes Management
    Route::get('/likes', [LikesController::class, 'index'])->name('admin.likes.index');
    Route::delete('/likes/{like}', [LikesController::class, 'destroy'])->name('admin.likes.destroy');

    // Admin Replies
    Route::post('/reply', [AdminReplyController::class, 'store'])->name('admin.reply.store');
    Route::delete('/reply/{reply}', [AdminReplyController::class, 'destroy'])->name('admin.reply.destroy');
});

// Storage Routes
Route::get('/storage/{path}', function($path) {
    $response = new \Symfony\Component\HttpFoundation\BinaryFileResponse(storage_path('app/public/' . $path));
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    return $response;
})->where('path', '.*');

Route::get('storage/slider/{filename}', function ($filename) {
    $path = storage_path('app/public/slider/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*'
    ]);
});

Route::get('storage/{informasi}', function ($informasi) {
    $path = storage_path('app/public/' . $informasi);
    return response()->file($path, [
        'Access-Control-Allow-Origin' => '*'
    ]);
});
