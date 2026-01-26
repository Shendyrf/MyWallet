<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        $income = Transactions::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $expense = Transactions::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        return view('dashboard', compact(
            'expense',
            'balance',
            'latestTransactions'
        ));
    }
}
