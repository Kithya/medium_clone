<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublcProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', [PostController::class, 'index'])
    ->name('dashboard');
    
Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])
    ->name('post.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/category/{category}', [PostController::class, 'category'])
        ->name('post.byCategory');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('/post', [PostController::class, 'store'])
        ->name('post.store');



    Route::post('/follow/{user}', [FollowerController::class, 'followUnFollow'])
        ->name('follow');
    Route::post('/clap/{post}', [ClapController::class, 'clap'])
        ->name('clap');
});

Route::get('/@{user:username}', [PublcProfileController::class, 'show'])
    ->name('profile.show');

require __DIR__ . '/auth.php';
