<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgets;
use App\Models\Categories;
use App\Models\Transactions;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(BudgetsController $budgetsController)
    {
        $userId = session('user_id');
        $today = Carbon::now();
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

        // $latestTransactions = Transactions::where('user_id', $userId)
        //     ->orderBy('transaction_date', 'desc')
        //     ->limit(5)
        //     ->get();

        $incomeCategories = Categories::where('type', 'income')->get();
        $expenseCategories = Categories::where('type', 'expense')->get();

        $persentaseBalance = $income == 0 ? 0 : ($expense / $income) * 100;

        // $expenseMonthly = Transactions::where('user_id', $userId)
        //     ->where('type', 'expense')
        //     ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
        //     ->sum('amount');

        // $budgetMonthly = Budgets::where('user_id', $userId)
        //     ->where('period', 'monthly')
        //     ->whereMonth('start_date', date('m')) // Filter hanya bulan ini
        //     ->whereYear('start_date', date('Y'))  // Filter hanya tahun ini (PENTING!)
        //     ->sum('amount_limit'); // Langsung jumlahkan jadi satu angka

        // // Jika kosong (null), ubah jadi 0
        // $budget = $budgetMonthly ?? 0;

        $fillMonths = function ($transactions) {
            $data = array_fill(1, 12, 0); // Buat array bulan 1-12 isinya 0
            foreach ($transactions as $t) {
                $data[$t->month] = $t->total;
            }
            return array_values($data); // Reset index jadi 0-11 untuk JS
        };

        $incomeQuery = Transactions::where('type', 'income')
            ->whereYear('transaction_date', date('Y'))
            ->selectRaw('MONTH(transaction_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
        $chartIncome = $fillMonths($incomeQuery);

        $expenseQuery = Transactions::where('type', 'expense')
            ->whereYear('transaction_date', date('Y'))
            ->selectRaw('MONTH(transaction_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
        $chartExpense = $fillMonths($expenseQuery);

        $chartProfit = [];
        for ($i = 0; $i < 12; $i++) {
            $chartProfit[] = $chartIncome[$i] - $chartExpense[$i];
        }

        // Hitung Total Balance saat ini (untuk teks besar di atas chart)
        $totalBalance = array_sum($chartProfit);

        return view('dashboard', array_merge(compact(
            'income',
            'expense',
            'balance',
            'incomeCategories',
            'expenseCategories',
            'persentaseBalance',
            // 'expenseMonthly',
            // 'budget'
            'chartIncome',
            'chartExpense',
            'chartProfit',
            'totalBalance'
        ), [
            'budgetProgress' => $budgetsController->budgetProgress(),
            'budgetChartData' => $budgetsController->showBudgetChartData(),
        ]));
    }
}
