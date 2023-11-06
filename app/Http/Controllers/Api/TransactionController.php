<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Transaction::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->date = $request->date;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->description = $request->description;
        $transaction->wallet_id = $request->wallet_id;
        $transaction->user_id = $request->user_id;
        $transaction->save();

        return Transaction::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Transaction::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expense = Transaction::find($id);
        $expense->delete();
        return Transaction::all();
    }
}
