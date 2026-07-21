@extends('layouts.website')

@section('title', 'Kontak')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">

        <h1>Hubungi Kami</h1>

        <p class="text-muted">
            Kami siap membantu Anda.
        </p>

    </div>

    <div class="row">

        <div class="col-md-6">

            <h4>Informasi Kontak</h4>

            <p>
                <strong>Brand :</strong> BrandForge
            </p>

            <p>
                <strong>Email :</strong>
                brandforge@gmail.com
            </p>

            <p>
                <strong>WhatsApp :</strong>
                085185912967
            </p>

            <p>
                <strong>Alamat :</strong>
                Bandung
            </p>

        </div>

        <div class="col-md-6">

            <form>

                <div class="mb-3">

                    <label>Nama</label>

                    <input type="text"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Pesan</label>

                    <textarea class="form-control"
                        rows="5"></textarea>

                </div>

                <button class="btn btn-primary">

                    Kirim Pesan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection