@extends('layouts.app')

@section('title', 'Tambah Retur')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            Tambah Retur
        </h3>

        <p class="text-muted mb-0">
            Catat barang yang diretur.
        </p>
    </div>

    <a href="{{ route('retur.index') }}"
       class="btn btn-secondary">
        ← Kembali
    </a>

</div>

@if($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form action="{{ route('retur.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Produk
                </label>

                <select name="produk_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Produk --
                    </option>

                    @foreach($produks as $produk)

                        <option value="{{ $produk->id }}">

                            {{ $produk->nama_produk }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Ukuran
                    </label>

                    <select name="ukuran_id"
                            class="form-select">

                        <option value="">
                            -- Pilih Ukuran --
                        </option>

                        @foreach($ukurans as $ukuran)

                            <option value="{{ $ukuran->id }}">
                                {{ $ukuran->nama_ukuran }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Warna
                    </label>

                    <select name="warna_id"
                            class="form-select">

                        <option value="">
                            -- Pilih Warna --
                        </option>

                        @foreach($warnas as $warna)

                            <option value="{{ $warna->id }}">
                                {{ $warna->nama_warna }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Jumlah
                    </label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           value="{{ old('jumlah', 1) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Tanggal Retur
                    </label>

                    <input type="date"
                           name="tanggal_retur"
                           class="form-control"
                           value="{{ old('tanggal_retur', date('Y-m-d')) }}"
                           required>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Jenis Retur
                </label>

                <select name="jenis"
                        class="form-select"
                        required>

                    <option value="keluar">
                        Retur Keluar
                    </option>

                    <option value="masuk">
                        Retur Masuk
                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Alasan Retur
                </label>

                <textarea name="alasan"
                          rows="4"
                          class="form-control"
                          placeholder="Contoh: Barang rusak / salah ukuran">{{ old('alasan') }}</textarea>

            </div>

            <div class="d-flex justify-content-end">

                <a href="{{ route('retur.index') }}"
                   class="btn btn-secondary me-2">
                    Batal
                </a>

                <button type="submit"
                        class="btn btn-success">
                    Simpan Retur
                </button>

            </div>

        </form>

    </div>

</div>

@endsection