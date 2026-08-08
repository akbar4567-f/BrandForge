```blade
@extends('layouts.website')

@section('title', 'Home')

@section('content')

<style>

/* ================================
   HERO SECTION
================================ */

.bf-hero {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background:
        linear-gradient(
            135deg,
            rgba(15, 23, 42, .96),
            rgba(30, 58, 138, .92)
        );
}

.bf-hero::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: rgba(59, 130, 246, .18);
    right: -150px;
    top: -180px;
}

.bf-hero::after {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    border-radius: 50%;
    background: rgba(96, 165, 250, .12);
    left: -150px;
    bottom: -180px;
}

.bf-hero-content {
    position: relative;
    z-index: 2;
    color: white;
    max-width: 700px;
}

.bf-hero-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 50px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
}

.bf-hero h1 {
    font-size: clamp(36px, 5vw, 64px);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 20px;
}

.bf-hero h1 span {
    color: #60a5fa;
}

.bf-hero p {
    color: #dbeafe;
    font-size: 18px;
    line-height: 1.7;
    max-width: 600px;
}

.bf-hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 20px;
    padding: 13px 25px;
    border-radius: 10px;
    background: white;
    color: #1d4ed8;
    text-decoration: none;
    font-weight: 700;
    transition: .25s;
}

.bf-hero-btn:hover {
    transform: translateY(-3px);
    color: #1d4ed8;
    box-shadow: 0 10px 25px rgba(0,0,0,.2);
}


/* ================================
   SECTION
================================ */

.bf-section {
    padding: 70px 0;
}

.bf-section-header {
    text-align: center;
    margin-bottom: 40px;
}

.bf-section-header .small-title {
    color: #2563eb;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 8px;
}

.bf-section-header h2 {
    font-size: 34px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 10px;
}

.bf-section-header p {
    color: #64748b;
}


/* ================================
   PRODUCT CARD
================================ */

.bf-product-card {
    height: 100%;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(15,23,42,.07);
    transition: .3s ease;
}

.bf-product-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 18px 40px rgba(15,23,42,.14);
    border-color: #bfdbfe;
}


/* ================================
   PRODUCT IMAGE
================================ */

.bf-product-image {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: #f8fafc;
}

.bf-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: .4s ease;
}

.bf-product-card:hover .bf-product-image img {
    transform: scale(1.06);
}


/* ================================
   NO IMAGE
================================ */

.bf-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(
        135deg,
        #eff6ff,
        #dbeafe
    );
    color: #2563eb;
}

.bf-no-image i {
    font-size: 45px;
    margin-bottom: 8px;
}

.bf-no-image span {
    font-weight: 700;
}


/* ================================
   BADGE
================================ */

.bf-product-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: #2563eb;
    color: white;
    padding: 6px 11px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .5px;
}


/* ================================
   PRODUCT BODY
================================ */

.bf-product-body {
    padding: 20px;
}

.bf-product-name {
    color: #0f172a;
    font-size: 17px;
    font-weight: 700;
    line-height: 1.4;
    min-height: 48px;
}

.bf-product-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 10px;
    min-height: 28px;
}

.bf-meta {
    display: inline-block;
    padding: 4px 9px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #64748b;
    font-size: 11px;
}

.bf-product-price {
    color: #2563eb;
    font-size: 19px;
    font-weight: 800;
    margin: 16px 0;
}

.bf-detail-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 11px;
    border-radius: 9px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: .25s;
}

.bf-detail-btn:hover {
    background: #1d4ed8;
    color: white;
}


/* ================================
   EMPTY
================================ */

.bf-empty {
    text-align: center;
    padding: 60px 20px;
    border: 1px dashed #cbd5e1;
    border-radius: 16px;
    color: #64748b;
}


/* ================================
   FEATURES
================================ */

.bf-features {
    background: #f8fafc;
    padding: 65px 0;
}

.bf-feature {
    text-align: center;
    padding: 25px;
}

.bf-feature-icon {
    width: 70px;
    height: 70px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 18px;
    background: #dbeafe;
    color: #2563eb;
    font-size: 30px;
}

.bf-feature h4 {
    margin-top: 18px;
    font-weight: 700;
    color: #0f172a;
}

.bf-feature p {
    color: #64748b;
    line-height: 1.6;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 768px) {

    .bf-hero {
        min-height: 430px;
    }

    .bf-hero h1 {
        font-size: 38px;
    }

    .bf-hero p {
        font-size: 15px;
    }

    .bf-section {
        padding: 50px 0;
    }

    .bf-section-header h2 {
        font-size: 28px;
    }

    .bf-product-image {
        height: 250px;
    }

}

</style>


{{-- ==========================================
     HERO
========================================== --}}

<section class="bf-hero">

    <div class="container">

        <div class="bf-hero-content">

            <div class="bf-hero-badge">
                ✦ BRAND FORGE FASHION
            </div>

            <h1>
                Temukan Gaya
                <span>Terbaikmu.</span>
            </h1>

            <p>
                Temukan koleksi fashion pilihan BrandForge
                dengan desain modern, kualitas premium,
                dan gaya yang cocok untukmu.
            </p>

            <a
                href="{{ route('website.produk') }}"
                class="bf-hero-btn"
            >
                <i class="bi bi-bag"></i>
                Lihat Koleksi
            </a>

        </div>

    </div>

</section>


{{-- ==========================================
     PRODUK TERBARU
========================================== --}}

<section class="bf-section">

    <div class="container">

        <div class="bf-section-header">

            <div class="small-title">
                Koleksi Terbaru
            </div>

            <h2>
                Produk Terbaru
            </h2>

            <p>
                Temukan produk terbaru dari BrandForge.
            </p>

        </div>


        <div class="row g-4">

            @forelse($produks as $item)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="bf-product-card">

                        {{-- FOTO PRODUK --}}

                        <div class="bf-product-image">

                            @if($item->foto)

                                <img
                                    src="{{ asset('produk/' . $item->foto) }}"
                                    alt="{{ $item->nama_produk }}"
                                >

                            @else

                                <div class="bf-no-image">

                                    <i class="bi bi-image"></i>

                                    <span>
                                        BrandForge
                                    </span>

                                </div>

                            @endif

                            <div class="bf-product-badge">
                                NEW
                            </div>

                        </div>


                        {{-- DETAIL PRODUK --}}

                        <div class="bf-product-body">

                            <div class="bf-product-name">
                                {{ $item->nama_produk }}
                            </div>


                            <div class="bf-product-meta">

                                @if($item->kategori)

                                    <span class="bf-meta">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>

                                @endif


                                @if($item->koleksi)

                                    <span class="bf-meta">
                                        {{ $item->koleksi->nama_koleksi }}
                                    </span>

                                @endif

                            </div>


                            <div class="bf-product-price">

                                Rp {{ number_format($item->harga, 0, ',', '.') }}

                            </div>


                            <a
                                href="{{ route('website.detail', $item->id) }}"
                                class="bf-detail-btn"
                            >

                                <i class="bi bi-eye"></i>

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="bf-empty">

                        <i class="bi bi-box-seam fs-1"></i>

                        <h5 class="mt-3">
                            Belum Ada Produk
                        </h5>

                        <p class="mb-0">
                            Produk BrandForge akan muncul di sini.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        <div class="text-center mt-5">

            <a
                href="{{ route('website.produk') }}"
                class="btn btn-outline-primary px-4 py-2"
            >

                Lihat Semua Produk

                <i class="bi bi-arrow-right ms-1"></i>

            </a>

        </div>

    </div>

</section>


{{-- ==========================================
     KEUNGGULAN
========================================== --}}

<section class="bf-features">

    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <div class="bf-feature">

                    <div class="bf-feature-icon">
                        <i class="bi bi-award"></i>
                    </div>

                    <h4>
                        Kualitas Premium
                    </h4>

                    <p>
                        Produk dibuat dari bahan pilihan
                        dengan kualitas terbaik.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="bf-feature">

                    <div class="bf-feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>

                    <h4>
                        Pengiriman Cepat
                    </h4>

                    <p>
                        Pesanan diproses dan dikirim
                        secepat mungkin.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="bf-feature">

                    <div class="bf-feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h4>
                        Belanja Aman
                    </h4>

                    <p>
                        Transaksi aman dan data pelanggan
                        terlindungi.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
```
