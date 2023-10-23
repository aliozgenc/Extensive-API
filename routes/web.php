<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OnlineUserController;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/list-admin-users', [AdminUserController::class, 'listAdminUsers']);

Route::get('/create-admin', [UserController::class, 'createAdmin']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-info', [OnlineUserController::class, 'getUserInfo']);
});
