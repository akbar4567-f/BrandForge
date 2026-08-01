@extends('layouts.website')

@section('title', 'Detail Produk')

@section('content')

<div class="container py-5">

    <div class="row">

        <!-- Foto Produk -->
        <div class="col-md-5">

            @if($produk->foto)
                <img src="{{ asset('produk/'.$produk->foto) }}"
                     class="img-fluid rounded shadow"
                     style="width:100%; height:500px; object-fit:cover;">
            @else
                <img src="https://via.placeholder.com/500x500?text=BrandForge"
                     class="img-fluid rounded shadow"
                     style="width:100%; height:500px; object-fit:cover;">
            @endif

        </div>

        <!-- Detail Produk -->
        <div class="col-md-7">

            <h2 class="fw-bold">
                {{ $produk->nama_produk }}
            </h2>

            <h3 class="text-primary fw-bold">
                Rp {{ number_format($produk->harga,0,',','.') }}
            </h3>

            <hr>

            <p>
                <strong>Kategori :</strong>
                {{ $produk->kategori->nama_kategori ?? '-' }}
            </p>

            @if($produk->koleksi)
            <p>
                <strong>Koleksi :</strong>
                {{ $produk->koleksi->nama_koleksi }}
            </p>
            @endif

            <p>
                <strong>Stok :</strong>
                {{ $produk->stok->sum('jumlah') }}
            </p>

            <p>
                <strong>Deskripsi :</strong>
            </p>

            <p>
                {{ $produk->deskripsi }}
            </p>

            <form method="POST">
                @csrf

                <!-- Ukuran -->
                <div class="mb-3">
                    <label class="form-label">Ukuran</label>

                    <select name="ukuran_id" class="form-control" required>

                        @forelse($ukuran as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_ukuran }}
                            </option>
                        @empty
                            <option disabled>Tidak ada ukuran tersedia</option>
                        @endforelse

                    </select>
                </div>

                <!-- Warna -->
                <div class="mb-3">
                    <label class="form-label">Warna</label>

                    <select name="warna_id" class="form-control" required>

                        @forelse($warna as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_warna }}
                            </option>
                        @empty
                            <option disabled>Tidak ada warna tersedia</option>
                        @endforelse

                    </select>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           value="1"
                           min="1"
                           max="{{ $produk->stok->sum('jumlah') }}"
                           required>
                </div>

                <div class="d-flex gap-2">

                    <button type="submit"
                            formaction="{{ route('pelanggan.beliSekarang', $produk->id) }}"
                            class="btn btn-success">
                        Beli Sekarang
                    </button>

                    <button type="submit"
                            formaction="{{ route('pelanggan.tambahKeranjang', $produk->id) }}"
                            class="btn btn-primary">
                        Tambah ke Keranjang
                    </button>

                    <a href="{{ route('website.produk') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection