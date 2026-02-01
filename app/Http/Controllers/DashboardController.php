<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Categories;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(BudgetsController $budgetsController)
    {
        $userId = session('user_id');
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

        $balance = $income - $expense;

        $latestTransactions = Transactions::where('user_id', $userId)
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get();

        $incomeCategories = Categories::where('type', 'income')->get();
        $expenseCategories = Categories::where('type', 'expense')->get();

        $persentaseBalance = $income == 0 ? 0 : ($expense / $income) * 100;

        return view('dashboard', array_merge(compact(
            'income',
            'expense',
            'balance',
            'latestTransactions',
            'incomeCategories',
            'expenseCategories',
            'persentaseBalance',
        ), [
            'budgetProgress' => $budgetsController->budgetProgress(),
            'budgetChartData' => $budgetsController->showBudgetChartData(),
        ]));
    }
}
