<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\Backend\AdminVendorController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('front_end.home.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'profile_store'])->name('admin.profile.store');
    //Brands Route
    Route::get('/admin/brand/all', [BrandController::class, 'allBrands'])->name('admin.brand.all');
    Route::get('/admin/brand/add', [BrandController::class, 'addBrand'])->name('admin.brand.add');
    Route::post('/admin/brand/store', [BrandController::class, 'storeBrand'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'editBrand'])->name('admin.brand.edit');
    Route::post('/admin/brand/update', [BrandController::class, 'updateBrand'])->name('admin.brand.update');
    Route::get('/admin/brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('admin.brand.delete');
    //Categories Route
    Route::get('/admin/category/all', [CategoryController::class, 'allCategories'])->name('admin.category.all');
    Route::get('/admin/category/add', [CategoryController::class, 'addCategory'])->name('admin.category.add');
    Route::post('/admin/category/store', [CategoryController::class, 'storeCategory'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
    Route::post('/admin/category/update', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
    //Sub Categories Route
    Route::get('/admin/sub_category/all', [SubCategoryController::class, 'allSubCategories'])->name('admin.sub_category.all');
    Route::get('/admin/sub_category/add', [SubCategoryController::class, 'addSubCategory'])->name('admin.sub_category.add');
    Route::post('/admin/sub_category/store', [SubCategoryController::class, 'storeSubCategory'])->name('admin.sub_category.store');
    Route::get('/admin/sub_category/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('admin.sub_category.edit');
    Route::post('/admin/sub_category/update', [SubCategoryController::class, 'updateSubCategory'])->name('admin.sub_category.update');
    Route::get('/admin/sub_category/delete/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('admin.sub_category.delete');
    //Admin Vendors Routes
    Route::get('/admin/vendors/active', [AdminVendorController::class, 'activeVendors'])->name('admin.vendors.active');
    Route::get('/admin/vendors/new', [AdminVendorController::class, 'newVendors'])->name('admin.vendors.new');
    Route::get('/admin/vendors/{id}', [AdminVendorController::class, 'viewVendor'])->name('admin.vendors.view');
    Route::post('/admin/vendors/approve', [AdminVendorController::class, 'approveVendor'])->name('admin.vendor.approve');
    //Admin Product Routes
    Route::get('/admin/products/add', [AdminProductController::class, 'addProduct'])->name('admin.products.add');

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
