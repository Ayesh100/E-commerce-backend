<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Customer;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\VerificationController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/brands',[BrandController::class,'getBrands']);
Route::get('/products',[ProductController::class,'getProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);


Route::get('/category/{id}', function ($id) {
    $category = Category::findOrFail($id);
    return response()->json([
        'category_name' => $category->category_name,
        'products' => $category->products->map(function ($product) {
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_price' => $product->product_price,
                'brand_id' => $product->brand_id,
                'product_img' => asset('uploads/' . $product->product_img),
            ];
        }),
    ]);
});

Route::get('/category/{id}/brands', function ($id) {
    $category = Category::findOrFail($id);

    $brands = $category->brands;

    return response()->json($brands);
});

Route::post('/register', [AuthController::class, 'register']);


Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    // ->middleware(['signed'])
    ->name('verification.verify');

Route::post('/resend-verification', [VerificationController::class, 'resendVerificationEmail']);



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);
    Route::get('/cart/count', [CartController::class, 'getCartCount']);
    Route::put('/cart/{id}', [CartController::class, 'updateQuantity']);

});

Route::middleware('auth:sanctum')->post('/checkout', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'getCustomerOrders']);

Route::get('/search', [ProductController::class, 'search']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification']);
    Route::get('/notifications/{id}', [NotificationController::class, 'showNotification']);

});




