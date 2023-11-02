<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ApiExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Expense::all();
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
        $expense = new Expense;

        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->category = $request->category;
        $expense->description = $request->description;
        $expense->wallet = $request->wallet;
        $expense->userid = $request->userid;

        $expense->save();

        return Expense::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Expense::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return Expense::all();
    }
}
