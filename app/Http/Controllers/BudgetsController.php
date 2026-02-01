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
            'categories_id' => 'required|exists:categories,categories_id',
            'amount_limit'  => 'required|numeric|min:1',
            'period'        => 'required|in:monthly,yearly',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);

        Budgets::create([
            'user_id'       => session('user_id'),
            'categories_id' => $request->categories_id,
            'amount_limit'  => $request->amount_limit,
            'period'        => $request->period,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Budget successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function budgetProgress()
    {
        $userId = session('user_id');


        $budgets = Budgets::join('categories', 'budgets.categories_id', '=', 'categories.categories_id')
            ->where('budgets.user_id', $userId)
            ->select('budgets.*', 'categories.categories_name')
            ->get()
            ->map(function ($budget) use ($userId) {
                $startOfMonth = Carbon::now()->startOfMonth();
                $endOfMonth   = Carbon::now()->endOfMonth();
                $spent = Transactions::where('user_id', $userId)
                    ->where('categories_id', $budget->categories_id)
                    ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
                    ->sum('amount');

                $percent = $budget->amount_limit > 0
                    ? min(100, round(($spent / $budget->amount_limit) * 100))
                    : 0;

                return [
                    'category' => $budget->categories_name,
                    'limit'    => $budget->amount_limit,
                    'spent'    => $spent,
                    'percent'  => $percent,
                ];
            });

        return $budgets;
    }

    public function showBudgetChartData()
    {
        $userId = session('user_id');
        $data = Budgets::join('categories', 'budgets.categories_id', '=', 'categories.categories_id')
            ->where('budgets.user_id', $userId)
            ->select('categories.categories_name', 'budgets.amount_limit')
            ->get()
            ->groupBy('categories_id')
            ->map(function ($items) {
                return [
                    'category' => $items->first()->categories_name,
                    'amount'   => $items->sum('amount_limit'),
                ];
            })
            ->values();

        return $data;
    }
}
