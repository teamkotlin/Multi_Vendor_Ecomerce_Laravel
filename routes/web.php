<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('front_end.home.index');
});

Route::get('/dashboard', function () {
    return view('front_end.home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'profile_store'])->name('admin.profile.store');
});

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'profile_store'])->name('vendor.profile.store');
});
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('vendor/login', [VendorController::class, 'login'])->name('vendor.login');
Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');


require __DIR__ . '/auth.php';
