<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Warna;
use App\Models\Ukuran;

class WebsiteController extends Controller
{
        public function home()
{
        $produks = Produk::all();

        return view('website.home', compact('produks'));
    }
    public function tentang()
    {
        return view('website.tentang');
    }

    public function produk()
    {
        $produks = Produk::all();

        return view('website.produk', compact('produks'));
    }

   public function detail($id)
    {
        $produk = Produk::with(['kategori', 'stok'])->findOrFail($id);
        $warna = Warna::all();
        $ukuran = Ukuran::all();

        return view('website.detail', compact(
            'produk',
            'warna',
            'ukuran'
        ));
    }

    public function kontak()
    {
        return view('website.kontak');
    }
}