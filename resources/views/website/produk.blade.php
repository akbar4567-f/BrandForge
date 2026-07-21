@extends('layouts.website')

@section('title', 'Produk')

@section('content')

<div class="container py-5">

    <h1 class="text-center mb-5">
        Daftar Produk
    </h1>

    <div class="row">

        @forelse($produks as $item)

        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow">

               @if($item->foto)
                     <img src="{{ asset('produk/'.$item->foto) }}"
                        class="card-img-top"
                        style="height:250px;object-fit:cover;">
             @else
                        <img src="https://via.placeholder.com/300x250"
                            class="card-img-top"
                            style="height:250px;object-fit:cover;">
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

</div>

@endsection