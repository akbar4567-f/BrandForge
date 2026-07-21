@extends('layouts.app')

@section('title', 'Belanja Produk')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">
        🛍️ Belanja Produk
    </h2>

    <div class="row">

        @forelse($produks as $produk)

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             class="card-img-top"
                             style="height:250px;object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=Produk"
                             class="card-img-top">
                    @endif

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $produk->nama }}
                        </h5>

                        <h4 class="text-primary">
                            Rp {{ number_format($produk->harga,0,',','.') }}
                        </h4>

                        <p>
                            Stok :
                            {{ $produk->stok()->sum('jumlah') }}
                        </p>

                        <div class="d-grid gap-2">

                     <a href="{{ route('pelanggan.detailProduk', $produk->id) }}"
                        class="btn btn-primary">
                            Lihat Produk
                        </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    Belum ada produk.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection