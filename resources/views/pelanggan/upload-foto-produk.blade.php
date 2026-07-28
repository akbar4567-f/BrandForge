@extends('layouts.app')

@section('title','Upload Foto Produk')

@section('content')

<div class="container mt-4">

    <h3>Upload Foto Produk</h3>

    <form action="{{ route('pelanggan.uploadFotoProduk',$transaksi->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">

            <label>Foto Produk</label>

            <input type="file"
                   name="foto_produk"
                   class="form-control"
                   required>

        </div>

        <button class="btn btn-primary">
            Upload
        </button>

        <a href="{{ route('pelanggan.dashboardBelanja') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection