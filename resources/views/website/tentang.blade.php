@extends('layouts.website')

@section('title', 'Tentang')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1>Tentang BrandForge</h1>
        <p class="text-muted">
            Brand lokal dengan kualitas terbaik.
        </p>
    </div>

    <div class="row align-items-center">

        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400"
                class="img-fluid rounded shadow">
        </div>

        <div class="col-md-6">

            <h3>Siapa Kami?</h3>

            <p>
                BrandForge merupakan brand fashion lokal yang menghadirkan
                produk berkualitas dengan desain modern dan nyaman digunakan.
            </p>

            <p>
                Kami berkomitmen memberikan pelayanan terbaik dan produk
                berkualitas bagi seluruh pelanggan di Indonesia.
            </p>

            <h4>Visi</h4>

            <p>
                Menjadi brand fashion lokal terpercaya dengan kualitas premium.
            </p>

            <h4>Misi</h4>

            <ul>
                <li>Menyediakan produk berkualitas.</li>
                <li>Memberikan pelayanan terbaik.</li>
                <li>Mengembangkan brand lokal Indonesia.</li>
            </ul>

        </div>

    </div>

</div>

@endsection