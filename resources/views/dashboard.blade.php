@extends('layouts.main')

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
                                Hari ini adalah hari yang baik untuk mengatur keuangan. Cek status <span class="fw-bold">pemasukan</span> dan <span class="fw-bold">pengeluaran</span> kamu sekarang.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Pemasukan</h5>
                                <span class="badge bg-label-success rounded-pill">Income</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.4%</small>
                                <h3 class="mb-0">Rp 0</h3>
                            </div>
                        </div>
                        <div id="profileReportChart"></div>
                    </div>
                    
                    <hr>
                    
                    <p class="card-text text-muted">
                        Catat semua sumber pendapatanmu di sini, mulai dari gaji bulanan hingga freelance.
                    </p>
                    <a href="#" class="btn btn-primary w-100">
                        <i class="bx bx-plus-circle me-1"></i> Tambah Pemasukan
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                     <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Pengeluaran</h5>
                                <span class="badge bg-label-danger rounded-pill">Expense</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.8%</small>
                                <h3 class="mb-0">Rp 0</h3>
                            </div>
                        </div>
                        <div id="profileReportChart"></div>
                    </div>

                    <hr>

                    <p class="card-text text-muted">
                        Rekam setiap transaksi belanja dan pembayaran tagihan agar arus kas tetap sehat.
                    </p>
                    <a href="#" class="btn btn-danger w-100">
                        <i class="bx bx-minus-circle me-1"></i> Catat Pengeluaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection