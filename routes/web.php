<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');

// Public FAQ Routes
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/{category:slug}', [FaqController::class, 'show'])->name('faq.show');

// Public Contact Route
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    
    // FAQ Management
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Admin\FaqCategoryController::class);
        Route::resource('items', \App\Http\Controllers\Admin\FaqItemController::class);
    });
});

require __DIR__.'/auth.php';
