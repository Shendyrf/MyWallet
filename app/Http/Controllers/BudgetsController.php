<?php

namespace App\Http\Controllers;

use App\Models\Budgets;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Transactions;
use Carbon\Carbon;

class BudgetsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'categories_id' => 'required',
            'amount_limit' => 'required|numeric',
            'period' => 'required|in:monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'custom_category' => 'nullable|string|max:100'
        ]);

        // default category id
        $categoryId = $request->categories_id;

        // kalau user pilih "Others"
        if ($request->categories_id === 'other') {

            if (!$request->custom_category) {
                return back()->withErrors([
                    'custom_category' => 'Please enter category name'
                ]);
            }

            // buat category baru
            $category = Categories::create([
                'categories_name' => $request->custom_category,
                'type' => 'expense',
            ]);

            $categoryId = $category->categories_id;
        }

        Budgets::create([
            'user_id' => session('user_id'),
            'categories_id' => $categoryId,
            'amount_limit' => $request->amount_limit,
            'period' => $request->period,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('success', 'Budget created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function budgetProgress()
    {
        $userId = session('user_id');

        $budgets = Budgets::join('categories', 'budgets.categories_id', '=', 'categories.categories_id')
            ->where('budgets.user_id', $userId)
            ->whereIn('budgets.period', ['monthly', 'daily', 'yearly'])
            ->select('budgets.*', 'categories.categories_name')
            ->get()
            ->map(function ($budget) use ($userId) {
                $today = Carbon::now();
                $startOfWeek = Carbon::now()->startOfWeek();
                $endOfWeek   = Carbon::now()->endOfWeek();
                $startOfMonth = Carbon::now()->startOfMonth();
                $endOfMonth   = Carbon::now()->endOfMonth();
                $spentMonthly = Transactions::where('user_id', $userId)
                    ->where('categories_id', $budget->categories_id)
                    ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
                    ->sum('amount');

                $spentWeekly = Transactions::where('user_id', $userId)
                    ->where('categories_id', $budget->categories_id)
                    ->whereBetween('transaction_date', [$startOfWeek, $endOfWeek])
                    ->sum('amount');

                $spentDaily = Transactions::where('user_id', $userId)
                    ->where('categories_id', $budget->categories_id)
                    ->whereDate('transaction_date', $today)
                    ->sum('amount');

                $percentMonthly = $budget->amount_limit > 0
                    ? min(100, round(($spentMonthly / $budget->amount_limit) * 100))
                    : 0;

                $percentWeekly = $budget->amount_limit > 0
                    ? min(100, round(($spentWeekly / $budget->amount_limit) * 100))
                    : 0;

                $percentDaily = $budget->amount_limit > 0
                    ? min(100, round(($spentDaily / $budget->amount_limit) * 100))
                    : 0;

                return [
                    'category' => $budget->categories_name,
                    'limit'    => $budget->amount_limit,
                    'spentMonthly'    => $spentMonthly,
                    'spentDaily' => $spentDaily,
                    'spentWeekly' => $spentWeekly,
                    'percentMonthly' => $percentMonthly,
                    'percentWeekly' => $percentWeekly,
                    'percentDaily' => $percentDaily,
                ];
            });

        return $budgets;
    }

    public function showBudgetChartData()
    {
        $userId = session('user_id');

        return Budgets::join('categories', 'budgets.categories_id', '=', 'categories.categories_id')
            ->where('budgets.user_id', $userId)
            // ->where('budgets.period', 'monthly')
            ->groupBy('categories.categories_id', 'categories.categories_name')
            ->selectRaw('categories.categories_name as category, SUM(budgets.amount_limit) as amount')
            ->get();
    }
}
