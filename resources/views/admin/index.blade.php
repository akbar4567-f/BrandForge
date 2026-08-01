@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container mt-4">

    <h2 class="mb-2">Dashboard Admin</h2>

    <p class="text-muted">
        Selamat Datang,
        <strong>{{ auth()->user()->name }}</strong>
        ({{ ucfirst(auth()->user()->role) }})
    </p>

    @if(auth()->user()->role == 'owner')
        <a href="{{ route('owner.index') }}" class="btn btn-primary mb-4">
            Dashboard Owner
        </a>
    @endif

            {{-- Notifikasi Stok Menipis --}}
        @if($jumlahStokMenipis > 0)

        <div class="alert alert-warning shadow-sm">

            <h5 class="mb-3">
                ⚠️ Notifikasi Stok Menipis
                <span class="badge bg-danger">
                    {{ $jumlahStokMenipis }}
                </span>
            </h5>

            <table class="table table-bordered table-sm mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($stokMenipis as $stok)

                    <tr>

                        <td>{{ $stok->produk->nama_produk ?? '-' }}</td>

                        <td>{{ $stok->ukuran->nama_ukuran ?? '-' }}</td>

                        <td>{{ $stok->warna->nama_warna ?? '-' }}</td>

                        <td>

                            <span class="badge bg-danger">
                                {{ $stok->jumlah }}
                            </span>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

        @endif

    <div class="row">

        <!-- Kategori -->
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>📂</h1>
                    <h4>Kategori</h4>
                    <p>Kelola data kategori produk.</p>

                    <a href="{{ route('kategori.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>📦</h1>
                    <h4>Produk</h4>
                    <p>Kelola data produk.</p>

                    <a href="{{ route('produk.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Koleksi -->
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>🛍️</h1>
                    <h4>Koleksi</h4>
                    <p>Kelola koleksi produk.</p>

                    <a href="{{ route('koleksi.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Ukuran -->
        <div class="col-md-4 mb-4">
            <div class="card bg-warning shadow h-100">
                <div class="card-body text-center">
                    <h1>📏</h1>
                    <h4>Ukuran</h4>
                    <p>Kelola data ukuran.</p>

                    <a href="{{ route('ukuran.index') }}"
                       class="btn btn-dark">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Warna -->
        <div class="col-md-4 mb-4">
            <div class="card bg-danger text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>🎨</h1>
                    <h4>Warna</h4>
                    <p>Kelola data warna.</p>

                    <a href="{{ route('warna.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Stok -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>📦</h1>
                    <h4>Stok</h4>
                    <p>Kelola stok produk.</p>

                    <a href="{{ route('stok.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <!-- Pengiriman -->
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white shadow h-100">
                <div class="card-body text-center">
                    <h1>🚚</h1>
                    <h4>Pengiriman</h4>
                    <p>Kelola pengiriman pesanan.</p>

                    <a href="{{ route('admin.pengiriman.index') }}"
                       class="btn btn-light">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection