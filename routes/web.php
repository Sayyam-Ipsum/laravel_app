<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix("posts")
        ->controller(PostController::class)
        ->name("post.")
        ->group(function () {
            Route::get('/modal/{id?}', ["as" => "modal", "uses" => "modal"]);
            Route::post('/store/{id?}', ["as" => "store", "uses" => "store"]);
            Route::delete('/{id}', ["as" => "delete", "uses" => "destroy"]);
        });
});

require __DIR__.'/auth.php';
