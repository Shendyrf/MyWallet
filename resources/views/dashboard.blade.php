@extends('layouts.main')
@include('modal.budgetModal')
@include('modal.transaction')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang! 🎉</h5>
                                <p class="mb-4">
                                    Hari ini adalah hari yang baik untuk mengatur keuangan. Cek status <span
                                        class="fw-bold">pemasukan</span> dan <span class="fw-bold">pengeluaran</span> kamu
                                    sekarang.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- start card income --}}
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Pemasukan</h5>
                                    <span class="badge bg-label-primary rounded-pill">Income</span>
                                    {{-- <small class="text-primary text-nowrap fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                        +28.4%</small> --}}
                                </div>
                                <div class="mt-sm-auto">
                                    <h3 class="mb-0">Rp {{ number_format($income, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>

                        <hr>

                        <p class="card-text text-muted">
                            Catat semua sumber pendapatanmu di sini, mulai dari gaji bulanan hingga freelance.
                        </p>
                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#incomeModal">
                            <i class="bx bx-plus-circle me-1"></i> Tambah Pemasukan
                        </a>
                    </div>
                </div>
            </div>
            {{-- end card income --}}

            {{-- start card expense --}}
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Pengeluaran</h5>
                                    <span class="badge bg-label-danger rounded-pill">Expense</span>
                                    {{-- <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                        -14.8%</small> --}}
                                </div>
                                <div class="mt-sm-auto">
                                    <h3 class="mb-0">Rp {{ number_format($expense, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>

                        <hr>

                        <p class="card-text text-muted">
                            Rekam setiap transaksi belanja dan pembayaran tagihan agar arus kas tetap sehat.
                        </p>
                        <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal"
                            data-bs-target="#expenseModal">
                            <i class="bx bx-plus-circle me-1"></i> Tambah Pengeluaran
                        </a>
                    </div>
                </div>
            </div>
            {{-- end card expense --}}

            {{-- start card balance --}}
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Sisa Uang</h5>
                                    <span class="badge bg-label-success rounded-pill">Balance</span>
                                    <small class="text-success text-nowrap fw-semibold"><i class="bx bx-wallet me-1"></i>
                                        {{ number_format($persentaseBalance, 0, ',', '.') }}%</small>
                                </div>
                                <div class="mt-sm-auto">
                                    <h3 class="mb-0">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>

                        <hr>

                        <p class="card-text text-muted">
                            Ringkasan saldo keuanganmu berdasarkan pemasukan dan pengeluaran terbaru.
                        </p>
                        <a href="#" class="btn btn-success w-100">
                            <i class="bx bx-show me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            {{-- end card balance --}}

            {{-- start card budget --}}
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Budget Overview 🎯</h5>
                                        <p class="mb-4">Manage your finances effectively with our budgeting tools.</p>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#budgetModal">
                                            Create New Budget
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <canvas id="budgetPie"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Budget History</h5>
                                        <p class="mb-4">View your budget history and track your spending over time.</p>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row mb-2">
                            <div class="col-sm-12">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Rincian Pengeluaran</h5>
                                    <p class="mb-0">View your budget history and track your spending over time.</p>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center text-sm-left">
                                <div class="card-body px-md-4">
                                    @forelse ($budgetProgress as $item)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-semibold">{{ $item['category'] }}</span>
                                                <span>{{ $item['percent'] }}%</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar {{ $item['percent'] >= 90 ? 'bg-danger' : ($item['percent'] >= 70 ? 'bg-warning' : 'bg-success') }}"
                                                style="width: {{ $item['percent'] }}%">
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-1 mb-sm-0 pb-2 text-start">
                                            Rp {{ number_format($item['spent']) }}
                                            /
                                            Rp {{ number_format($item['limit']) }}
                                        </small>
                                    @empty
                                        <p class="text-muted mb-0">No budget data available</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card budget --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('budgetPie');
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.budgetChartData) return;

            const ctx = document.getElementById('budgetPie');
            if (!ctx) return;

            const data = window.budgetChartData;

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.map(i => i.category),
                    datasets: [{
                        data: data.map(i => i.amount),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection
