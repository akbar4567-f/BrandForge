<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Warna;
use Illuminate\Http\Request;


class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with('supplier')
            ->latest()
            ->get();

        return view('admin.pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        $produks = Produk::orderBy('nama_produk')->get();

        $ukurans = Ukuran::orderBy('nama_ukuran')->get();

        $warnas = Warna::orderBy('nama_warna')->get();

        return view('admin.pembelian.create', compact(
            'suppliers',
            'produks',
            'ukurans',
            'warnas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal_pembelian' => 'required|date',
            'keterangan' => 'nullable|string',

            'produk_id' => 'required|array',
            'produk_id.*' => 'required|exists:produks,id',

            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',

            'harga_modal' => 'required|array',
            'harga_modal.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $totalHarga = 0;

            foreach ($request->produk_id as $index => $produkId) {
                $jumlah = $request->jumlah[$index];
                $hargaModal = $request->harga_modal[$index];

                $totalHarga += $jumlah * $hargaModal;
            }

            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier_id,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'total_harga' => $totalHarga,
                'keterangan' => $request->keterangan,
            ]);

            foreach ($request->produk_id as $index => $produkId) {

                $jumlah = $request->jumlah[$index];
                $hargaModal = $request->harga_modal[$index];

                PembelianDetail::create([
                    'pembelian_id' => $pembelian->id,
                    'produk_id' => $produkId,
                    'jumlah' => $jumlah,
                    'harga_modal' => $hargaModal,
                    'subtotal' => $jumlah * $hargaModal,
                ]);

                $stok = Stok::where('produk_id', $produkId)
                    ->whereNull('ukuran_id')
                    ->whereNull('warna_id')
                    ->first();

                if ($stok) {
                    $stok->increment('jumlah', $jumlah);
                } else {
                    Stok::create([
                        'produk_id' => $produkId,
                        'ukuran_id' => null,
                        'warna_id' => null,
                        'jumlah' => $jumlah,
                    ]);
                }
            }
        });

        return redirect()
            ->route('pembelian.index')
            ->with('success', 'Pembelian berhasil disimpan dan stok berhasil ditambahkan.');
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load([
            'supplier',
            'details.produk'
        ]);

        return view('admin.pembelian.show', compact('pembelian'));
    }

    public function destroy(Pembelian $pembelian)
    {
        DB::transaction(function () use ($pembelian) {

            $pembelian->load('details');

            foreach ($pembelian->details as $detail) {

                $stok = Stok::where('produk_id', $detail->produk_id)
                    ->whereNull('ukuran_id')
                    ->whereNull('warna_id')
                    ->first();

                if ($stok) {
                    $stok->decrement('jumlah', $detail->jumlah);
                }
            }

            $pembelian->details()->delete();
            $pembelian->delete();
        });

        return redirect()
            ->route('pembelian.index')
            ->with('success', 'Pembelian berhasil dihapus.');
    }
}