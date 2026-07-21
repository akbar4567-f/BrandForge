@extends('layouts.website')

@section('title', 'Home')

@section('content')

<!-- Hero -->
<section class="hero">
    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Selamat Datang di BrandForge
        </h1>

        <p class="lead mt-3">
            Temukan koleksi fashion terbaik dengan kualitas premium dan desain modern.
        </p>

       <a href="{{ route('website.produk') }}" class="btn btn-light btn-lg mt-3">
            Lihat Produk
        </a>

    </div>
</section>

<!-- Produk Terbaru -->
<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2>Produk Terbaru</h2>
            <p class="text-muted">
                Koleksi terbaru BrandForge
            </p>
        </div>

        <div class="row">

            @forelse($produks as $item)

                <div class="col-md-3 mb-4">

                    <div class="card h-100 shadow-sm">

                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 class="card-img-top"
                                 style="height:250px; object-fit:cover;">
                        @else
                            <img src="https://via.placeholder.com/300x250?text=BrandForge"
                                 class="card-img-top">
                        @endif

                        <div class="card-body">

                            <h5>{{ $item->nama_produk }}</h5>

                            <p class="text-primary fw-bold">
                                Rp {{ number_format($item->harga,0,',','.') }}
                            </p>

                              <a href="{{ route('website.detail', $item->id) }}"
                                class="btn btn-primary w-100">
                                    Detail Produk
                                </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada produk.
                    </div>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-4">

           <a href="{{ route('website.produk') }}" class="btn btn-outline-primary">
                    Lihat Semua Produk
                </a>

        </div>

    </div>

</section>

<!-- Keunggulan -->
<section class="py-5 bg-light">

    <div class="container">

        <div class="row text-center">

            <div class="col-md-4 mb-4">
                <i class="bi bi-award display-4 text-primary"></i>
                <h4 class="mt-3">Kualitas Premium</h4>
                <p>
                    Produk dibuat dari bahan pilihan dengan kualitas terbaik.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <i class="bi bi-truck display-4 text-success"></i>
                <h4 class="mt-3">Pengiriman Cepat</h4>
                <p>
                    Pesanan diproses dan dikirim secepat mungkin.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <i class="bi bi-shield-check display-4 text-danger"></i>
                <h4 class="mt-3">Belanja Aman</h4>
                <p>
                    Transaksi aman dan data pelanggan terlindungi.
                </p>
            </div>

        </div>

    </div>

</section>

@endsection