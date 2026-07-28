@extends('layouts.app')

@section('title','Dashboard status')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

       <h2>Dashboard Status</h2>
        @if(Auth::user()->role == 'owner')
            <a href="{{ route('owner.index') }}" class="btn btn-warning">
                <i class="bi bi-speedometer2"></i> Dashboard Owner
            </a>
        @endif

    </div>

    <div class="alert alert-success">
        Selamat datang di BrandForge
    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Pesanan</h5>
                    <h2>{{ $totalPesanan }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center bg-secondary text-white">
                <div class="card-body">
                    <h5>Menunggu Verifikasi</h5>
                    <h2>{{ $menungguVerifikasi }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center bg-warning">
                <div class="card-body">
                    <h5>Belum Bayar</h5>
                    <h2>{{ $belumBayar }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5>Diproses</h5>
                    <h2>{{ $diproses }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5>Selesai</h5>
                    <h2>{{ $selesai }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
    <div class="card text-center bg-primary text-white">
        <div class="card-body">
            <h5>Dikirim</h5>
            <h2>{{ $dikirim }}</h2>
        </div>
    </div>
</div>

    </div>

    <div class="mt-4">

        <a href="{{ route('website.home') }}" class="btn btn-primary">
            🌐 Website 
        </a>

        <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-success">
            📋 Riwayat Pesanan
        </a>
    </div>

</div>

@endsection