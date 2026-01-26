<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #343a40 0%, #495057 100%);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .card-body {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }
        .card-header {
            background: linear-gradient(90deg, #212529 0%, #343a40 100%);
            border-radius: 15px 15px 0 0 !important;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
            transform: scale(1.02);
            transition: all 0.2s ease;
        }
        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #343a40;
        }
        #financeChart {
            max-height: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Finance Dashboard</a>
            <form class="d-flex" action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row g-4">

            <!-- Cards Summary -->
            <div class="col-sm-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="text-secondary">Pemasukan Bulan Ini</p>
                        {{-- <h3 class="text-success">Rp {{ number_format($income,0,',','.') }}</h3> --}}
                        Rp. 13.000.000
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="text-secondary">Pengeluaran Bulan Ini</p>
                        {{-- <h3 class="text-danger">Rp {{ number_format($expense,0,',','.') }}</h3> --}}
                        Rp. 13.000.000
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="text-secondary">Saldo</p>
                        {{-- <h3 class="text-dark">Rp {{ number_format($balance,0,',','.') }}</h3> --}}
                        Rp. 13.000.000
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="col-12 mt-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Latest Transactions -->
            <div class="col-12 mt-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        Transaksi Terbaru
                        <form class="d-flex" action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Tambah Transaksi</button>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Tipe</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($latestTransactions as $trx)
                                <tr>
                                    <td>{{ $trx->transaction_date }}</td>
                                    <td>{{ $trx->category->name }}</td>
                                    <td class="text-capitalize">{{ $trx->type }}</td>
                                    <td>
                                        Rp {{ number_format($trx->amount,0,',','.') }}
                                    </td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: 'rgba(25, 135, 84, 0.2)',
                        borderColor: '#198754',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        data: [12, 19, 9, 14]
                    },
                    {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgba(220, 53, 69, 0.2)',
                        borderColor: '#dc3545',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        data: [8, 11, 5, 18]
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>