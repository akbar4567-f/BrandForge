<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    /**
     * Menampilkan daftar pengiriman (Admin)
     */
    public function index()
    {
        $pengiriman = Pengiriman::with('pesanan')
            ->latest()
            ->get();

        return view('admin.pengiriman.index', compact('pengiriman'));
    }


    /**
     * Form tambah / edit pengiriman
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pengiriman = Pengiriman::where('pesanan_id', $id)
            ->first();

        return view(
            'admin.pengiriman.edit',
            compact('pesanan', 'pengiriman')
        );
    }


    /**
     * Simpan data pengiriman
     */
    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required',
            'kurir' => 'required',
            'layanan' => 'required',
            'ongkir' => 'required|numeric',
            'status' => 'required',
        ]);


        Pengiriman::updateOrCreate(
            [
                'pesanan_id' => $request->pesanan_id
            ],
            [
                'kurir' => $request->kurir,
                'layanan' => $request->layanan,
                'ongkir' => $request->ongkir,
                'nomor_resi' => $request->nomor_resi,
                'status' => $request->status,
                'catatan' => $request->catatan,
            ]
        );


        return redirect()
            ->route('admin.pengiriman.index')
            ->with('success', 'Data pengiriman berhasil disimpan');
    }


    /**
     * Update status pengiriman
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);


        $pengiriman = Pengiriman::findOrFail($id);

        $pengiriman->update([
            'status' => $request->status
        ]);


        return back()
            ->with('success', 'Status pengiriman diperbarui');
    }


    /**
     * Input nomor resi
     */
    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'nomor_resi' => 'required'
        ]);


        $pengiriman = Pengiriman::findOrFail($id);

        $pengiriman->update([
            'nomor_resi' => $request->nomor_resi,
            'status' => 'dikirim'
        ]);


        return back()
            ->with('success', 'Nomor resi berhasil ditambahkan');
    }


    /**
     * Halaman tracking pelanggan
     */
    public function tracking($id)
    {
        $pengiriman = Pengiriman::where('pesanan_id', $id)
            ->with('pesanan')
            ->firstOrFail();


        return view(
            'pelanggan.tracking',
            compact('pengiriman')
        );
    }
}