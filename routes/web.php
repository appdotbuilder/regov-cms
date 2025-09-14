<?php

use App\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Public CMS routes
Route::get('/', [CMSController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');
Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{slug}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('departments.show');
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.photos');
Route::get('/videos', [App\Http\Controllers\GalleryController::class, 'show'])->name('gallery.videos');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
