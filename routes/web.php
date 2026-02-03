<?php

use App\Http\Controllers\CodeReviewController;

Route::get('/', [CodeReviewController::class, 'index'])->name('home');
Route::post('/', [CodeReviewController::class, 'review'])->name('review');
