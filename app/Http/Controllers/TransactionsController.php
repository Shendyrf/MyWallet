<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionsController extends Controller
{
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

    public function transactionDetails()
    {
        return Transactions::join('categories', 'transactions.categories_id', '=', 'categories.categories_id')
            ->where('user_id', session('user_id'))
            ->selectRaw('transactions.categories_id, categories.categories_name, transactions.transaction_date, SUM(amount) as total, transactions.note')
            ->groupBy('transactions.categories_id', 'categories.categories_name', 'transactions.transaction_date', 'transactions.note')
            ->orderBy('transactions.transaction_date', 'desc')
            ->get();
    }
}
