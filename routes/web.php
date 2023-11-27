<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleUserController;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\CategoryController as NonAPICategoryController;
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
    return view('home');
});

Route::get('/users', [UserController::class, 'index'])->middleware('admin:admin,master_admin');
Route::post('/users', [UserController::class, 'update']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::post('/users/{user}/update', [UserController::class, 'update']);


Route::get('/categories', [NonAPICategoryController::class, 'index'])->middleware('admin:master_admin,admin');
Route::post('/categories/create', [NonAPICategoryController::class, 'store']);
Route::get('/categories/create', [NonAPICategoryController::class, 'create']);
Route::get('/categories/{category}/edit', [NonAPICategoryController::class, 'edit']);
Route::post('/categories/{category}/update', [NonAPICategoryController::class, 'update']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('role_user', [RoleUserController::class, 'index']);
Route::post('role_user', [RoleUserController::class, 'match_role_and_user_id']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Google Login
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});
