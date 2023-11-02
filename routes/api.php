<?php

use App\Http\Controllers\ApiTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

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

// Route::get('/expenses', function (Request $request) {
//     return Expense::all();
// });

// Route::post('/expenses', function (Request $request) {
//     $expense = new Expense;

//     $expense->date = $request->date;
//     $expense->amount = $request->amount;
//     $expense->category = $request->category;
//     $expense->description = $request->description;
//     $expense->wallet = $request->wallet;
//     $expense->userid = $request->userid;

//     $expense->save();

//     return Expense::all();
// });

// Route::put('/expenses/{id}', function (Request $request, $id) {
//     $expense = Expense::find($id);

//     $expense->update($request->all());

//     return Expense::find($request->id);
// });

// Route::get('expenses/{expense}', function (Expense $expense) {
//     return $expense;
// });

// Route::put('expenses/{expense}', function ($id, Expense $expense) {
//     return $expense;
// });




Route::resource('transactions', ApiTransactionController::class);
Route::post('transactions/{id}', function (Request $request, $id) {
    $transaction = Transaction::find($id);
    $transaction->update($request->all());
    $transaction->save();
    return $transaction;
});
