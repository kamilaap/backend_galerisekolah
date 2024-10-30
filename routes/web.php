<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PhotoInteractionController;

/**
 * Route for admin
 */
Route::get('/', function () {
    return view('welcome');
});

// Group route with prefix "admin"
Route::prefix('admin')->group(function () {
    // Group route with middleware "auth" and "PreventBackHistory"
    Route::group(['middleware' => ['auth', PreventBackHistory::class]], function () {
        // Route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        // Route resource kategori
        Route::resource('/kategori', KategoriController::class, ['as' =>'admin']);

        // Route resource informasi
        Route::resource('/informasi', InformasiController::class, ['as' =>'admin']);

        // Route resource agenda
        Route::resource('/agenda', AgendaController::class, ['as' =>'admin']);

        // Route resource galery
        Route::resource('/galery', GaleryController::class, ['as' =>'admin']);

        // Route resource photo
        Route::resource('/photo', PhotoController::class, ['as' =>'admin']);

        // Route resource slider
        Route::resource('/slider', SliderController::class, ['except' => ['show', 'create', 'edit', 'update'], 'as' => 'admin']);

        // Route profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');

        // Route untuk mengelola interaksi foto (like dan komentar)
        Route::get('/interactions', [PhotoInteractionController::class, 'index'])->name('admin.interactions.index');
        Route::delete('/comments/{id}', [PhotoInteractionController::class, 'destroyComment'])->name('admin.comment.destroy');
        Route::delete('/likes/{id}', [PhotoInteractionController::class, 'destroyLike'])->name('admin.like.destroy'); // Note the singular 'like'
        Route::post('/comments/{id}/reply', [PhotoInteractionController::class, 'replyToComment'])->name('admin.comment.reply');
    });
});
