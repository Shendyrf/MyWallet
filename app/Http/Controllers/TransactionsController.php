<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(session('user_id'));

        $request->validate([
            'amount' => 'required|numeric',
            'categories_id' => 'required|exists:categories,categories_id',
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
            'note' => 'nullable|string',
        ]);

        Transactions::create([
            'user_id' => session('user_id'),
            'amount' => $request->amount,
            'categories_id' => $request->categories_id,
            'transaction_date' => Carbon::parse($request->transaction_date),
            'type' => $request->type,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
