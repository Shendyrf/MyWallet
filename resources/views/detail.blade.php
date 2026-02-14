@extends('layouts.main')
{{-- @include('modal.catergoryModal') --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h5 class="mb-0">Categories List</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->categories_name }}</td>
                                        <td>{{ $category->type }}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category->categories_id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm me-1">
                                                    <i class="bx bx-delete"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Budget Summary</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($budgetSummary as $budget)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::create()->month($budget->month)->translatedFormat('F') }}
                                        </td>
                                        <td>Rp {{ number_format($budget->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4" id="transactionDetail">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h5 class="mb-0">Transaction Detail</h5>
                        <a class="text-muted float-end">Total Transactions: Rp {{ number_format($totalTransactions, 0, ',', '.') }}</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>note</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($transactionDetails as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->categories_name }}</td>
                                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $transaction->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
