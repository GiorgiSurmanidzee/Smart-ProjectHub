<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['jwt.auth', 'role:admin|project manager'])->group(function () {
    Route::post('/project', [ProjectController::class, 'store'])->name('store.project');
});
