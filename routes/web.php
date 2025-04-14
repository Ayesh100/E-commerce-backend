<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Route::get('/home',function(){
//     return view('home');
// });


// Orders Controller




Route::group(['middleware' => ['role:super-admin|admin']], function () {

    Route::resource('roles', RoleController::class);
    Route::delete('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
    Route::resource('users', UserController::class);
    Route::delete('users/{userId}/delete', [UserController::class, 'destroy']);
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
});

Route::middleware(['role:super-admin'])->group(function () {

    Route::resource('permissions', PermissionController::class);
    Route::delete('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
});

Route::middleware(['role:customer-service|order-manager|super-admin|admin'])->group(function () {

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');
    Route::put('/admin/orders/{order}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::get('/admin/orders/search', [OrderController::class, 'search'])->name('orders.search');
});

Route::middleware(['role:manager|super-admin|admin'])->group(function () {

    // Categories Controller

Route::get('/admin/category', [CategoryController::class, 'index'])->name('category');;
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('category.create');;
Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.store');;
Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');;
Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('category.update');;
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');;



// Brands Controller

Route::get('/admin/brand', [BrandController::class, 'index'])->name('brand');
Route::get('/admin/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/admin/brand', [BrandController::class, 'store'])->name('brand.store');
Route::get('/admin/brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
Route::put('/admin/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/admin/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');




// Products Controller

Route::get('/admin/product', [ProductController::class, 'index'])->name('product');;
Route::get('/admin/product/create', [ProductController::class, 'create'])->name('product.create');;
Route::post('/admin/product', [ProductController::class, 'store'])->name('product.store');;
Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');;
Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('product.update');;
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');;
});
