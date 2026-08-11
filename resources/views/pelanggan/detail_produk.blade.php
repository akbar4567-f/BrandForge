@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="container py-4">

    <a href="{{ route('pelanggan.belanja') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="row">

        <div class="col-md-5">

            @if($produk->foto)
                <img src="{{ asset('produk/'.$produk->foto) }}"
                     class="img-fluid rounded shadow">
            @else
                <img src="https://via.placeholder.com/500x500?text=Produk"
                     class="img-fluid rounded shadow">
            @endif

        </div>

        <div class="col-md-7">

         <h2>{{ $produk->nama_produk }}</h2>

            <h3 class="text-primary mb-3">
                Rp {{ number_format($produk->harga,0,',','.') }}
            </h3>

            <p>
                <strong>Stok :</strong>
                {{ $produk->stok->sum('jumlah') }}
            </p>

            <hr>

            <form action="{{ route('pelanggan.tambahKeranjang', $produk->id) }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Pilih Warna
                    </label>

                    <select name="warna_id" class="form-select">

                        @foreach($warna as $item)

                            <option value="{{ $item->id }}">
                             {{ $item->nama_warna }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Pilih Ukuran
                    </label>

                    <select name="ukuran_id" class="form-select">

                        @foreach($ukuran as $item)

                            <option value="{{ $item->id }}">
                               {{ $item->nama_ukuran }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jumlah
                    </label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           value="1"
                           min="1"
                           max="{{ $produk->stok->sum('jumlah') }}">

                </div>
                <hr>
             <div class="d-grid gap-2">

                <button type="submit"
                        class="btn btn-success">
                    🛒 Tambah ke Keranjang
                </button>

                <a href="{{ route('pelanggan.checkout') }}"
                class="btn btn-warning">
                    ⚡ Checkout
                </a>

            </div>

            </form>

        </div>
        <hr class="my-5">

<h4 class="mb-4">
    🛍️ Produk Terkait
</h4>

<div class="row">

@forelse($produkTerkait as $item)

<div class="col-md-3 mb-4">

    <div class="card h-100 shadow-sm">

        @if($item->foto)
            <img src="{{ asset('storage/'.$item->foto) }}"
                 class="card-img-top"
                 style="height:220px;object-fit:cover;">
        @else
            <img src="https://via.placeholder.com/400x220?text=Produk"
                 class="card-img-top"
                 style="height:220px;object-fit:cover;">
        @endif

        <div class="card-body">

            <h6>{{ $item->nama_produk }}</h6>

            <p class="text-danger fw-bold">
                Rp {{ number_format($item->harga,0,',','.') }}
            </p>

            <p class="small text-muted">
                Stok :
                {{ $item->stok->sum('jumlah') }}
            </p>

            <a href="{{ route('pelanggan.detailProduk', $item->id) }}"
               class="btn btn-outline-primary btn-sm w-100">
                Lihat Produk
            </a>

        </div>

    </div>

</div>

@empty

<div class="col-12">

    <div class="alert alert-warning text-center">
        Belum ada produk terkait.
    </div>

</div>

@endforelse

</div>

    </div>

</div>

@endsection