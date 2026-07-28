@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Dashboard Kasir</h2>

    @if(auth()->user()->role == 'owner')
       <a href="/owner" class="btn btn-primary">
            Dashboard Owner
        </a>
</div>
    @endif

        <div class="row">

            <!-- Card Menunggu Verifikasi -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5>Menunggu Verifikasi</h5>
                        <h2>{{ $menungguVerifikasi }}</h2>
                    </div>
                </div>
            </div>

            <!-- Card Diproses -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5>Diproses</h5>
                        <h2>{{ $diproses }}</h2>
                    </div>
                </div>
            </div>

            <!-- Card Selesai -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5>Selesai</h5>
                        <h2>{{ $selesai }}</h2>
                    </div>
                </div>
            </div>

            <!-- Card Transaksi -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5>Transaksi</h5>
                        <p>Mulai transaksi penjualan.</p>

                        <a href="{{ route('kasir.transaksi') }}" class="btn btn-primary">
                            Buka Transaksi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Riwayat -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5>Riwayat</h5>
                        <p>Lihat riwayat transaksi.</p>

                        <a href="{{ route('kasir.riwayat') }}" class="btn btn-success">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection