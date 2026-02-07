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
                                            <form action="{{ route('categories.destroy', $category->categories_id) }}" method="POST" class="d-inline">
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
                                <tr>
                                    <td>1</td>
                                    <td>January</td>
                                    <td>Rp 3.000.000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>February</td>
                                    <td>Rp 2.500.000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>March</td>
                                    <td>Rp 4.200.000</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>April</td>
                                    <td>Rp 3.800.000</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>May</td>
                                    <td>Rp 4.500.000</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>June</td>
                                    <td>Rp 3.900.000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>July</td>
                                    <td>Rp 4.200.000</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>August</td>
                                    <td>Rp 3.700.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Transaction Summary</h5>
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
                                <tr>
                                    <td>1</td>
                                    <td>Food & Drink</td>
                                    <td>Rp 150.000</td>
                                    <td>2026-01-05</td>
                                    <td>Lunch with friends</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Transportation</td>
                                    <td>Rp 75.000</td>
                                    <td>2026-01-06</td>
                                    <td>Online ride</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Entertainment</td>
                                    <td>Rp 300.000</td>
                                    <td>2026-01-08</td>
                                    <td>Movie & snacks</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Utilities</td>
                                    <td>Rp 500.000</td>
                                    <td>2026-01-10</td>
                                    <td>Electricity bill</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
