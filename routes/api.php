<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\GaleryController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ContactController;

/*
 * Routes for getting authenticated user (only if token is valid)
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API Resources
Route::apiResource('agenda', AgendaController::class);
Route::apiResource('informasi', InformasiController::class);
Route::apiResource('kategori', KategoriController::class);
Route::apiResource('profile', ProfileController::class);
Route::apiResource('sliders', SliderController::class);

// Auth Routes
Route::post('register', action: [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Galery Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('galery', GaleryController::class);
});

// Atau jika ingin index dan show bisa diakses tanpa login:
Route::get('galery', [GaleryController::class, 'index']);
Route::get('galery/{id}', [GaleryController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('galery', [GaleryController::class, 'store']);
    Route::put('galery/{id}', [GaleryController::class, 'update']);
    Route::delete('galery/{id}', [GaleryController::class, 'destroy']);
});

// Photo Routes
Route::apiResource('photos', PhotoController::class);

// Like Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('photos/{photoId}/likes', [LikeController::class, 'getPhotoLikes']);
    Route::post('photos/{photoId}/likes', [LikeController::class, 'toggleLike']);
});

// Comment Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('photos/{photo}/comments', [CommentController::class, 'getPhotoComments']);
    Route::post('photos/{photo}/comments', [CommentController::class, 'addComment']);
});

// Contact Routes
Route::post('/contact', [ContactController::class, 'store']);

// Route yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Route untuk admin
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', 'AdminDashboardController@index');
    });

    // Route untuk user biasa
    Route::get('/profile', 'ProfileController@show');
});

Route::middleware(['cors'])->group(function () {
    // API routes
    Route::get('/informasi', [InformasiController::class, 'index']);
    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/agenda', [AgendaController::class, 'index']);
    Route::get('/galery', [GaleryController::class, 'index']);
});
