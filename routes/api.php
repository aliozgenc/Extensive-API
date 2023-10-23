<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnlineUserController;

// Oturum açma rotası
Route::post('/login', [AuthController::class, 'login']);

// Kullanıcı kayıt rotası
Route::post('/register', [RegisterController::class, 'register']);

// Oturumu kapatma rotası
Route::post('/signout', [AuthController::class, 'logout']);

// API rotaları için gruplama ve izin kontrolü
Route::middleware('auth:sanctum')->group(function () {
    // Tüm kullanıcılar için (herkes için)
    Route::get('/websites', [WebsiteController::class, 'index']);
    Route::get('/websites/{website}', [WebsiteController::class, 'show']);

    // Sadece adminler için
    Route::middleware('can:admin')->group(function () {
        Route::post('/websites', [WebsiteController::class, 'store']);
        Route::put('/websites/{website}', [WebsiteController::class, 'update']);
        Route::delete('/websites/{website}', [WebsiteController::class, 'destroy']);
        Route::post('/websites/{website}/categories', [WebsiteController::class, 'addCategories']);
        Route::delete('/websites/{website}/categories/{category}', [WebsiteController::class, 'removeCategory']);
        Route::put('/websites/{website}/update-status', [WebsiteController::class, 'updateStatus']);
    });

    // User rolüne sahip kullanıcılar için
    Route::middleware('can:user')->group(function () {
        Route::post('/websites', [WebsiteController::class, 'store']);
        Route::put('/websites/{website}', [WebsiteController::class, 'updateOwn']);
        Route::delete('/websites/{website}', [WebsiteController::class, 'deleteOwn']);
    });

    // Kategoriler için sadece adminlerin erişebileceği rotalar
    Route::middleware('can:admin')->group(function () {
        Route::post('/websites/{website}/categories', [WebsiteController::class, 'manageCategories']);
        Route::get('/categories', [CategoryController::class, 'viewCategories']);
    });

    // Kim olduğunuzu kontrol etmek için
    Route::get('/user-info', [OnlineUserController::class, 'getUserInfo']);
});
