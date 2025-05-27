<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('/project', [ProjectController::class, 'store'])->name('store.project');