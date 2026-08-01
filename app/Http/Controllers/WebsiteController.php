<?php

    namespace App\Http\Controllers;

    use App\Models\Produk;
    use App\Models\Warna;
    use App\Models\Ukuran;
    use App\Models\Koleksi;

    class WebsiteController extends Controller
    {
    public function home()
        {
            $produks = Produk::with([
                'kategori',
                'koleksi',
                'stok'
            ])
            ->whereHas('stok', function ($query) {
                $query->where('jumlah', '>', 0);
            })
            ->latest()
            ->get();

            $koleksis = Koleksi::all();

            return view('website.home', compact(
                'produks',
                'koleksis'
            ));
        }

        public function tentang()
        {
            return view('website.tentang');
        }

        public function produk()
        {
            $produks = Produk::with([
                'kategori',
                'koleksi',
                'stok'
            ])
            ->whereHas('stok', function ($query) {
                $query->where('jumlah', '>', 0);
            })
            ->latest()
            ->get();

            $koleksis = Koleksi::all();

            return view('website.produk', compact(
                'produks',
                'koleksis'
            ));
        }
   public function detail($id)
    {
        $produk = Produk::with([
            'kategori',
            'koleksi',
            'stok.ukuran',
            'stok.warna'
        ])->findOrFail($id);

        // Ambil ukuran yang tersedia pada stok produk
        $ukuran = $produk->stok
            ->where('jumlah', '>', 0)
            ->pluck('ukuran')
            ->unique('id');

        // Ambil warna yang tersedia pada stok produk
        $warna = $produk->stok
            ->where('jumlah', '>', 0)
            ->pluck('warna')
            ->unique('id');

        return view('website.detail', compact(
            'produk',
            'ukuran',
            'warna'
        ));
    }

        public function kontak()
        {
            return view('website.kontak');
        }
    }