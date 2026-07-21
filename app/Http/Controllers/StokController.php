<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Warna;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Tampilkan semua data stok.
     */
    public function index()
    {
        $stoks = Stok::with(['produk', 'ukuran', 'warna'])->get();

        return view('admin.stok.index', compact('stoks'));
    }

    /**
     * Form tambah stok.
     */
    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();
        $ukurans = Ukuran::orderBy('nama_ukuran')->get();
        $warnas  = Warna::orderBy('nama_warna')->get();

        return view('admin.stok.create', compact(
            'produks',
            'ukurans',
            'warnas'
        ));
    }

    /**
     * Simpan data stok.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'ukuran_id' => 'required|exists:ukurans,id',
            'warna_id'  => 'required|exists:warnas,id',
            'jumlah'    => 'required|integer|min:0',
        ]);

        Stok::create([
            'produk_id' => $request->produk_id,
            'ukuran_id' => $request->ukuran_id,
            'warna_id'  => $request->warna_id,
            'jumlah'    => $request->jumlah,
        ]);

        return redirect()
            ->route('stok.index')
            ->with('success', 'Data stok berhasil ditambahkan.');
    }

    /**
     * Detail stok.
     */
    public function show(Stok $stok)
    {
        return redirect()->route('stok.index');
    }

    /**
     * Form edit stok.
     */
    public function edit(Stok $stok)
    {
        $produks = Produk::orderBy('nama_produk')->get();
        $ukurans = Ukuran::orderBy('nama_ukuran')->get();
        $warnas  = Warna::orderBy('nama_warna')->get();

        return view('admin.stok.edit', compact(
            'stok',
            'produks',
            'ukurans',
            'warnas'
        ));
    }

    /**
     * Update data stok.
     */
    public function update(Request $request, Stok $stok)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'ukuran_id' => 'required|exists:ukurans,id',
            'warna_id'  => 'required|exists:warnas,id',
            'jumlah'    => 'required|integer|min:0',
        ]);

        $stok->update([
            'produk_id' => $request->produk_id,
            'ukuran_id' => $request->ukuran_id,
            'warna_id'  => $request->warna_id,
            'jumlah'    => $request->jumlah,
        ]);

        return redirect()
            ->route('stok.index')
            ->with('success', 'Data stok berhasil diperbarui.');
    }

    /**
     * Hapus data stok.
     */
    public function destroy(Stok $stok)
    {
        $stok->delete();

        return redirect()
            ->route('stok.index')
            ->with('success', 'Data stok berhasil dihapus.');
    }
}