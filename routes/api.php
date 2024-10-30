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
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('logout', [AuthController::class, 'logout']);

// Galery Routes
Route::middleware('auth:sanctum')->apiResource('galery', GaleryController::class);

// Photo Routes
Route::middleware('auth:sanctum')->apiResource('photos', PhotoController::class);

// Like Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('photos/{photo}/likes', [LikeController::class, 'index']); // Get likes for a specific photo
    Route::post('photos/{photo}/likes', [LikeController::class, 'store']); // Like a specific photo
    Route::delete('photos/{photo}/likes', [LikeController::class, 'destroy']); // Unlike a specific photo
});

// Comment Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('photos/{photo}/comments', [CommentController::class, 'index']); // Get comments for a specific photo
    Route::post('photos/{photo}/comments', [CommentController::class, 'store']); // Add a comment to a specific photo
    Route::apiResource('photos.comments', CommentController::class)->only(['show', 'update', 'destroy']); // Show, update, and delete comments
});
