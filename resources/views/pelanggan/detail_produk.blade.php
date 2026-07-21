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
                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="img-fluid rounded shadow">
            @else
                <img src="https://via.placeholder.com/500x500?text=Produk"
                     class="img-fluid rounded shadow">
            @endif

        </div>

        <div class="col-md-7">

            <h2>{{ $produk->nama }}</h2>

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

    </div>

</div>

@endsection