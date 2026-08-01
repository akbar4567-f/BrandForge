@extends('layouts.website')

@section('title', 'Produk')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Daftar Produk</h1>
        <p class="text-muted">
            Temukan koleksi fashion terbaik BrandForge
        </p>
    </div>

    <div class="row">

        @forelse($produks as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    @if($item->foto)
                        <img src="{{ asset('produk/'.$item->foto) }}"
                             class="card-img-top"
                             style="height:250px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/300x250?text=BrandForge"
                             class="card-img-top"
                             style="height:250px; object-fit:cover;">
                    @endif

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold">
                            {{ $item->nama_produk }}
                        </h5>

                        @if($item->kategori)
                            <small class="text-muted d-block">
                                <strong>Kategori :</strong>
                                {{ $item->kategori->nama_kategori }}
                            </small>
                        @endif

                        @if($item->koleksi)
                            <small class="text-muted d-block">
                                <strong>Koleksi :</strong>
                                {{ $item->koleksi->nama_koleksi }}
                            </small>
                        @endif

                        @if($item->deskripsi)
                            <p class="small text-secondary mt-2 mb-2">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 60) }}
                            </p>
                        @endif

                        <span class="badge bg-success mb-3">
                            Stok : {{ $item->stok->sum('jumlah') }}
                        </span>

                        <h5 class="text-primary fw-bold mb-3">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </h5>

                        <a href="{{ route('website.detail', $item->id) }}"
                           class="btn btn-primary mt-auto">
                            Detail Produk
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada produk yang tersedia.
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection