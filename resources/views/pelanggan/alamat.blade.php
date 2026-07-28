@extends('layouts.app')

@section('title','Alamat Pengiriman')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    📍 Alamat Pengiriman
                </div>

                <div class="card-body">
                        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('pelanggan.simpanAlamat', $transaksi->id) }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Penerima
                            </label>

                            <input type="text"
                                   name="nama_penerima"
                                   class="form-control"
                                   placeholder="Masukkan nama penerima"
                                   value="{{ old('nama_penerima') }}"
                                   required>
                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Alamat Lengkap
                            </label>

                            <textarea name="alamat"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Contoh: Jalan, Kecamatan, Kota Bandung"
                                      required>{{ old('alamat') }}</textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                No WhatsApp
                            </label>

                            <input type="text"
                                   name="no_hp"
                                   class="form-control"
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('no_hp') }}"
                                   required>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Pilih Kurir
                            </label>

                            <select name="kurir"
                                    class="form-control"
                                    required>

                                <option value="">
                                    -- Pilih Kurir --
                                </option>

                                <option value="JNE">
                                    JNE
                                </option>

                                <option value="J&T">
                                    J&T
                                </option>

                                <option value="SiCepat">
                                    SiCepat
                                </option>

                                <option value="AnterAja">
                                    AnterAja
                                </option>

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Pilih Layanan
                            </label>

                            <select name="layanan"
                                    class="form-control"
                                    required>

                                <option value="">
                                    -- Pilih Layanan --
                                </option>

                                <option value="REG">
                                    REG
                                </option>

                                <option value="YES">
                                    YES
                                </option>

                                <option value="Express">
                                    Express
                                </option>

                            </select>

                        </div>


                        <div class="d-flex justify-content-between">

                            <a href="{{ route('pelanggan.belanja') }}"
                               class="btn btn-secondary">

                                ← Kembali

                            </a>


                            <button type="submit"
                                    class="btn btn-success">

                                Lanjut Pembayaran →

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection