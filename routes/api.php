<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);


Route::middleware([JwtMiddleware::class, 'role:admin'])->group(function () {
    Route::post('/project', [ProjectController::class, 'store'])->name('store.project');
});
