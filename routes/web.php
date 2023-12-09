<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
});

Route::resource('post', PostController::class);
Route::get('/chart', [ChartController::class, 'index'])->name('chart');
Route::get('likes', [LikeController::class, 'index'])->name('likes');
Route::post('like/{post}', [LikeController::class, 'create'])->name('like');
Route::delete('unlike/{post}', [LikeController::class, 'destroy'])->name('unlike');
Route::get('/calendar', [CalendarController::class, 'show'])->name('calendar');
Route::get('get_posts', [CalendarController::class, 'getPosts'])->name('calendar.getPosts');

require __DIR__ . '/auth.php';
