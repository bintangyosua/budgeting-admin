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
// Route::get('users/{email}/transactions', function (string $email) {
//     // return DB::table('transactions')->join('categories', 'categories.id', '=', 'transactions.category_id')->join('category_types', 'category_types.id', '=', 'categories.category_type_id')->where('transactions.user_id', $id)->orderByDesc('transactions.created_at')->limit(10)->get();
//     return DB::table('transactions')->join('categories', 'categories.id', '=', 'transactions.category_id')->join('category_types', 'category_types.id', '=', 'categories.category_type_id')->join('users', 'users.id', '=', 'transactions.user_id')->select("transactions.*")->where('users.email', $email)->orderByDesc('transactions.created_at')->get();
// });
Route::get('users/{user_id}/transactions', function (Request $request, int $user_id) {
    if (($request->input("firstdate")) && ($request->input("lastdate"))) {
        $results = Transaction::join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select(
                DB::raw('strftime("%m", transactions.date) as month'),
                DB::raw('CAST(SUM(CASE WHEN categories.category_type_id = 1 THEN transactions.amount ELSE 0 END) AS TEXT) as sum_category_1'),
                DB::raw('CAST(SUM(CASE WHEN categories.category_type_id = 2 THEN transactions.amount ELSE 0 END) AS TEXT) as sum_category_2')
            )
            ->where('transactions.user_id', $user_id)
            ->whereBetween('transactions.date', [$request->input("firstdate"), $request->input("lastdate")])
            ->groupBy(DB::raw('strftime("%Y", transactions.date)'), DB::raw('strftime("%m", transactions.date)'))
            ->orderBy(DB::raw('strftime("%Y", transactions.date)'), 'asc')
            ->orderBy(DB::raw('strftime("%m", transactions.date)'), 'asc')
            ->get();


        $data = [];
        foreach ($results as $result) {
            $data[] = [
                'month' => $result->month,
                'sum_category_1' => $result->sum_category_1,
                'sum_category_2' => $result->sum_category_2,
            ];
        }
    } else {
        $data = DB::table('transactions')->join('categories', 'categories.id', '=', 'transactions.category_id')->join('category_types', 'category_types.id', '=', 'categories.category_type_id')->join('users', 'users.id', '=', 'transactions.user_id')->select("transactions.*")->where('users.id', $user_id)->orderByDesc('transactions.created_at')->get();
    }

    return ($data);
});
