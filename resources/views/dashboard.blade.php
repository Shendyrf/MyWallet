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
                        <a href="/detail#transactionDetail" class="btn btn-success w-100">
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
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Laporan Keuangan</h5>
                                    <small class="text-muted">Ringkasan Tahunan</small>
                                </div>

                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active"
                                            onclick="updateChart('income')">Income</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link"
                                            onclick="updateChart('expense')">Expenses</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link"
                                            onclick="updateChart('profit')">Profit</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar p-2 me-2 bg-label-primary rounded">
                                        <i class="bx bx-wallet fs-3"></i>
                                    </div>
                                    <div>
                                        <span class="d-block text-muted">Total Balance Tahun Ini</span>
                                        <h4 class="mb-0">Rp {{ number_format($totalBalance, 0, ',', '.') }}</h4>
                                    </div>
                                </div>

                                <div id="financeChart"></div>
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
                                    <p>View your budget history and track your spending over time.</p>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="showSection('Daily')">Daily</button>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="showSection('Weekly')">Weekly</button>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="showSection('Monthly')">Monthly</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center text-sm-left">
                                <div class="card-body px-md-4" id="budgetDetailsDaily">
                                    @forelse ($budgetProgress as $item)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-semibold">{{ $item['category'] }}</span>
                                                <span>{{ $item['percentDaily'] }}%</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar {{ $item['percentDaily'] >= 90 ? 'bg-danger' : ($item['percentDaily'] >= 70 ? 'bg-warning' : 'bg-success') }}"
                                                style="width: {{ $item['percentDaily'] }}%">
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-1 mb-sm-0 pb-2 text-start">
                                            Rp {{ number_format($item['spentDaily']) }}
                                            /
                                            Rp {{ number_format($item['limit']) }}
                                        </small>
                                    @empty
                                        <p class="text-muted mb-0">No budget data available</p>
                                    @endforelse
                                </div>
                                <div class="card-body px-md-4" id="budgetDetailsWeekly">
                                    @forelse ($budgetProgress as $item)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-semibold">{{ $item['category'] }}</span>
                                                <span>{{ $item['percentWeekly'] }}%</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar {{ $item['percentWeekly'] >= 90 ? 'bg-danger' : ($item['percentWeekly'] >= 70 ? 'bg-warning' : 'bg-success') }}"
                                                style="width: {{ $item['percentWeekly'] }}%">
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-1 mb-sm-0 pb-2 text-start">
                                            Rp {{ number_format($item['spentWeekly']) }}
                                            /
                                            Rp {{ number_format($item['limit']) }}
                                        </small>
                                    @empty
                                        <p class="text-muted mb-0">No budget data available</p>
                                    @endforelse
                                </div>
                                <div class="card-body px-md-4" id="budgetDetailsMonthly">
                                    @forelse ($budgetProgress as $item)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-semibold">{{ $item['category'] }}</span>
                                                <span>{{ $item['percentMonthly'] }}%</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar {{ $item['percentMonthly'] >= 90 ? 'bg-danger' : ($item['percentMonthly'] >= 70 ? 'bg-warning' : 'bg-success') }}"
                                                style="width: {{ $item['percentMonthly'] }}%">
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mb-1 mb-sm-0 pb-2 text-start">
                                            Rp {{ number_format($item['spentMonthly']) }}
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
    <script>
        function showSection(type) {
            const sections = ['Daily', 'Weekly', 'Monthly'];

            sections.forEach(section => {
                document.getElementById('budgetDetails' + section).style.display =
                    section === type ? 'block' : 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSection('Daily');
        });

        const categorySelect = document.getElementById('categoriesSelect');
        const customCategoryWrapper = document.getElementById('customCategoryWrapper');

        categorySelect.addEventListener('change', function() {
            if (this.value === 'other') {
                customCategoryWrapper.classList.remove('d-none');
            } else {
                customCategoryWrapper.classList.add('d-none');
            }
        });

        const rawData = @json($budgetChartData);

        const labels = rawData.map(item => item.category);
        const values = rawData.map(item => item.amount);

        const ctx = document.getElementById('budgetPie').getContext('2d');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    borderWidth: 1
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
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil data dari Controller
            var dataIncome = {!! json_encode($chartIncome) !!};
            var dataExpense = {!! json_encode($chartExpense) !!};
            var dataProfit = {!! json_encode($chartProfit) !!};

            // Konfigurasi Chart (Mirip referensi gambar)
            var options = {
                series: [{
                    name: 'Nominal',
                    data: dataIncome // Default tampilkan Income dulu
                }],
                chart: {
                    height: 300,
                    type: 'area', // Tipe Area supaya ada arsir warna di bawah garis
                    toolbar: {
                        show: false
                    } // Hilangkan menu download di pojok
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth', // Bikin garis melengkung
                    width: 2
                },
                colors: ['#696cff'], // Warna Ungu Utama Sneat
                fill: {
                    type: 'gradient', // Efek gradasi pudar ke bawah
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.1, // Bagian bawah transparan
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            // Format angka jadi K (Ribuan) atau Jt (Juta) biar rapi
                            if (value >= 1000000) return (value / 1000000).toFixed(1) + "Jt";
                            if (value >= 1000) return (value / 1000).toFixed(0) + "Rb";
                            return value;
                        }
                    }
                },
                grid: {
                    borderColor: '#eceef1',
                    strokeDashArray: 4, // Garis putus-putus di background
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                }
            };

            // Render Chart
            var chart = new ApexCharts(document.querySelector("#financeChart"), options);
            chart.render();

            // --- Logic Tombol Ganti Data (Income/Expense/Profit) ---
            window.updateChart = function(type) {
                var newData = [];
                var newColor = '';

                if (type === 'income') {
                    newData = dataIncome;
                    newColor = '#696cff'; // Ungu
                } else if (type === 'expense') {
                    newData = dataExpense;
                    newColor = '#ff3e1d'; // Merah
                } else {
                    newData = dataProfit;
                    newColor = '#71dd37'; // Hijau
                }

                // Update Chart tanpa refresh halaman
                chart.updateOptions({
                    colors: [newColor],
                    series: [{
                        data: newData
                    }]
                });

                // Logic ganti class 'active' di tombol (Pemanis UI)
                var buttons = document.querySelectorAll('.nav-link');
                buttons.forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
            }
        });
    </script>
@endsection
