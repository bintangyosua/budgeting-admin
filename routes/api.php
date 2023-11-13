<?php

use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryTypeController;
use App\Http\Controllers\Api\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

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



Route::resource('transactions', TransactionController::class);
Route::post('transactions/{id}', function (Request $request, $id) {
    $transaction = Transaction::find($id);
    $transaction->update($request->all());
    $transaction->save();
    return $transaction;
});

Route::resource('wallets', WalletController::class);

Route::resource('categories', CategoryController::class);

Route::resource('category_types', CategoryTypeController::class);

Route::resource('users', UserController::class);
Route::post('users/{id}', [UserController::class, 'update']);
Route::get('users/{email}/transactions', function (string $email) {
    return DB::table('users')->join('transactions', 'transactions.user_id', '=', 'users.id')->join('categories', 'categories.id', '=', 'transactions.category_id')->join('category_types', 'category_types.id', '=', 'categories.category_type_id')->where('users.email', $email)->orderByDesc('transactions.created_at')->get();
});
