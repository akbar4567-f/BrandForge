<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengiriman;
use App\Models\DetailTransaksi;
use App\Models\Stok;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    /**
     * Dashboard Kasir
     */
   public function index()
    {
        $menungguVerifikasi = Transaksi::where('status', 'Menunggu Verifikasi')->count();

        $diproses = Transaksi::where('status', 'Diproses')->count();

        $selesai = Transaksi::where('status', 'Selesai')->count();

        return view('kasir.index', compact(
            'menungguVerifikasi',
            'diproses',
            'selesai',
        ));
    }

    /**
     * Halaman Transaksi
     */
    public function transaksi()
    {
        $stoks = Stok::with(['produk', 'ukuran', 'warna'])->get();

        return view('kasir.transaksi', compact('stoks'));
    }

    /**
     * Simpan Transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'stok_id' => 'required|exists:stoks,id',
            'jumlah'  => 'required|integer|min:1',
            'bayar'   => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            $stok = Stok::with(['produk'])->findOrFail($request->stok_id);

            if ($request->jumlah > $stok->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }

            $harga = $stok->produk->harga;
            $subtotal = $harga * $request->jumlah;

            if ($request->bayar < $subtotal) {
                return back()->with('error', 'Uang pembayaran kurang.');
            }

          $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'nama_penerima' => Auth::user()->name,
            'alamat' => '-',
            'no_hp' => '-',
            'kode_transaksi' => 'TRX-'.date('YmdHis'),
            'tanggal_transaksi' => now(),
            'total_harga' => $subtotal,
            'bayar' => $request->bayar,
            'kembalian' => $request->bayar - $subtotal,
            'status' => 'Diproses',
        ]);

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'stok_id'      => $stok->id,
                'produk_id'    => $stok->produk_id,
                'jumlah'       => $request->jumlah,
                'harga'        => $harga,
                'subtotal'     => $subtotal,
            ]);

            // Kurangi stok
            $stok->jumlah -= $request->jumlah;
            $stok->save();

            DB::commit();

            return redirect()
                ->route('kasir.riwayat')
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Riwayat Transaksi
     */
    public function riwayat()
    {
        $transaksis = Transaksi::with([
            'user',
            'pembayaran',
            'pengiriman'
        ])->latest()->get();

        return view('kasir.riwayat', compact('transaksis'));
    }

    /**
     * Detail Transaksi
     */
        public function show($id)
        {
      $transaksi = Transaksi::with([
        'user',
        'pengiriman',
        'detailTransaksi.produk',
        'detailTransaksi.stok.ukuran',
        'detailTransaksi.stok.warna',
])->findOrFail($id);
        return view('kasir.detail', compact('transaksi'));
    }
       public function selesai($id)
        {
            $transaksi = Transaksi::findOrFail($id);

            $transaksi->update([
                'bayar'      => $transaksi->total_harga,
                'kembalian'  => 0,
                'status'     => 'Selesai',
            ]);

            return redirect()->route('kasir.riwayat')
                ->with('success', 'Pesanan selesai.');
        }
        public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // hapus detail transaksi
        DetailTransaksi::where('transaksi_id', $id)->delete();

        // hapus pembayaran
        Pembayaran::where('transaksi_id', $id)->delete();

        // hapus transaksi
        $transaksi->delete();

        return redirect()->route('kasir.riwayat')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
     public function verifikasi($id)
    {
        $transaksi = Transaksi::with('pembayaran')->findOrFail($id);

        $transaksi->update([
            'status' => 'Diproses',
            'bayar' => $transaksi->total_harga,
            'kembalian' => 0,
        ]);

        if ($transaksi->pembayaran) {
            $transaksi->pembayaran->update([
                'status' => 'Terverifikasi'
            ]);
        }
       $pengiriman = Pengiriman::where('transaksi_id', $transaksi->id)->first();

            if ($pengiriman) {
                $pengiriman->update([
                    'status' => 'menunggu'
                ]);
            }

        return redirect()->route('kasir.riwayat')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }
    /**
     * Cetak Struk
     */
    public function struk($id)
    {
        $transaksi = Transaksi::with([
            'user',
            'detailTransaksi.produk',
            'detailTransaksi.stok.ukuran',
            'detailTransaksi.stok.warna',
        ])->findOrFail($id);

        return view('kasir.struk', compact('transaksi'));
    }
    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'nomor_resi' => 'required',
        ]);

        $pengiriman = Pengiriman::where('transaksi_id', $id)->firstOrFail();

        $pengiriman->update([
            'nomor_resi' => $request->nomor_resi,
            'status' => 'dikirim',
        ]);

        return back()->with(
            'success',
            'Nomor resi berhasil disimpan.'
        );
    }
   public function updateStatusKirim(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:menunggu,diproses,dikemas,dikirim,selesai',
    ]);

    $pengiriman = Pengiriman::where('transaksi_id', $id)
        ->firstOrFail();

    $pengiriman->update([
        'status' => $request->status,
    ]);

    return back()->with(
        'success',
        'Status pengiriman berhasil diperbarui.'
    );
}


// Cetak Label Pengiriman
public function printLabel($id)
{
    $pengiriman = Pengiriman::with('pesanan')
        ->findOrFail($id);

    return view(
        'kasir.label',
        compact('pengiriman')
    );
}
// Bukti Pembayaran
public function buktiPembayaran($id)
{
    $transaksi = Transaksi::with('pembayaran')->findOrFail($id);

    return view('kasir.buktipembayaran', compact('transaksi'));
}


// Foto Produk
public function buktiProduk($id)
{
    $transaksi = Transaksi::with('pengiriman')->findOrFail($id);

    return view('kasir.buktiproduk', compact('transaksi'));
}

}