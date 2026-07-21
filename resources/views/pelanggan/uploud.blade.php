@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">
        📤 Upload Bukti Pembayaran
    </h2>

    <div class="card shadow">

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('upload.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Upload Bukti Transfer
                    </label>

                    <input
                        type="file"
                        name="bukti"
                        class="form-control"
                        accept="image/*"
                        required>

                    <small class="text-muted">
                        Format: JPG, JPEG, PNG
                    </small>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Catatan 
                    </label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="3"
                        placeholder="Contoh: Sudah transfer melalui DANA"></textarea>

                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('pembayaran.index') }}"
                       class="btn btn-secondary">

                        ← Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        📤 Upload Bukti

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="mt-4">

        <a href="{{ route('dashboard.belanja') }}"
           class="btn btn-success">

            🛍️ Kembali ke Dashboard Belanja

        </a>

        <a href="{{ route('pelanggan.index') }}"
           class="btn btn-warning">

            📊 Dashboard Status

        </a>

    </div>

</div>

@endsection