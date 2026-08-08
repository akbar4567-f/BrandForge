<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index()
    {
        $returs = Retur::with(['produk', 'transaksi'])
            ->latest()
            ->get();

        return view('admin.retur.index', compact('returs'));
    }

   public function create()
    {
        $produks = Produk::all();
        $transaksis = Transaksi::orderBy('created_at', 'desc')->get();
        $ukurans = Ukuran::all();
        $warnas = Warna::all();

        return view('admin.retur.create', compact(
            'produks',
            'transaksis',
            'ukurans',
            'warnas'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal_retur' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            Retur::create([
                'transaksi_id' => $request->transaksi_id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'alasan' => $request->alasan,
                'keterangan' => $request->keterangan,
                'tanggal_retur' => $request->tanggal_retur,
            ]);

            // Barang retur dikembalikan ke stok
            $stok = Stok::where('produk_id', $request->produk_id)
                ->whereNull('ukuran_id')
                ->whereNull('warna_id')
                ->first();

            if ($stok) {
                $stok->increment('jumlah', $request->jumlah);
            } else {
                Stok::create([
                    'produk_id' => $request->produk_id,
                    'ukuran_id' => null,
                    'warna_id' => null,
                    'jumlah' => $request->jumlah,
                ]);
            }
        });

        return redirect()
            ->route('retur.index')
            ->with('success', 'Retur barang berhasil disimpan dan stok telah dikembalikan.');
    }

    public function show(Retur $retur)
    {
        $retur->load(['produk', 'transaksi']);

        return view('admin.retur.show', compact('retur'));
    }

    public function destroy(Retur $retur)
    {
        DB::transaction(function () use ($retur) {

            $stok = Stok::where('produk_id', $retur->produk_id)
                ->whereNull('ukuran_id')
                ->whereNull('warna_id')
                ->first();

            if ($stok) {
                $stok->decrement('jumlah', $retur->jumlah);
            }

            $retur->delete();
        });

        return redirect()
            ->route('retur.index')
            ->with('success', 'Data retur berhasil dihapus.');
    }
}