<?php

    namespace App\Http\Controllers;

    use App\Models\Produk;
    use App\Models\Keranjang;
    use App\Models\Transaksi;
    use App\Models\DetailTransaksi;
    use App\Models\Pembayaran;
    use App\Models\Pengiriman;
    use App\Models\Stok;
    use App\Models\Warna;
    use App\Models\Ukuran;
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class PelangganController extends Controller
    {
                // DASHBOARD BELANJA
                public function dashboardBelanja()
                {
                    $jumlahKeranjang = Keranjang::where('user_id', Auth::id())->count();

                    return view('pelanggan.dashboard_belanja', compact('jumlahKeranjang'));
                }

                // DAFTAR PRODUK
                public function belanja()
                {
                    $produks = Produk::with('stok')->get();

                    return view('pelanggan.belanja', compact('produks'));
                }

                // DETAIL PRODUK
                public function detailProduk($id)
                {
                    $produk = Produk::with(['kategori', 'stok'])->findOrFail($id);
                    $warna = Warna::all();
                    $ukuran = Ukuran::all();

                    return view('pelanggan.detail_produk', compact(
                        'produk',
                        'warna',
                        'ukuran'
                    ));
                }
            // Beli Sekarang
                public function beliSekarang(Request $request, $id)
                {
                    $request->validate([
                        'ukuran_id' => 'required',
                        'warna_id'  => 'required',
                        'jumlah'    => 'required|integer|min:1',
                    ]);

                    $produk = Produk::findOrFail($id);

                    $stok = Stok::where('produk_id', $produk->id)
                        ->where('ukuran_id', $request->ukuran_id)
                        ->where('warna_id', $request->warna_id)
                        ->first();

                    if (!$stok) {
                        return back()->with('error','Varian produk tidak ditemukan.');
                    }


                    if ($stok->jumlah < $request->jumlah) {
                        return back()->with('error','Stok tidak mencukupi.');
                    }


            $subtotal = $produk->harga * $request->jumlah;

            $ongkir = 10000;

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'kode_transaksi' => 'TRX'.strtoupper(Str::random(10)),
                'tanggal_transaksi' => now(),

                'nama_penerima' => '-',
                'alamat' => '-',
                'no_hp' => '-',

                'total_harga' => $subtotal, // <-- BUKAN $total
                'ongkir' => $ongkir,

                'bayar' => 0,
                'kembalian' => 0,
                'status' => 'Belum Bayar',
            ]);



                    DetailTransaksi::create([

                        'transaksi_id'=>$transaksi->id,

                        'stok_id'=>$stok->id,

                        'produk_id'=>$produk->id,

                        'warna_id'=>$request->warna_id,

                        'ukuran_id'=>$request->ukuran_id,

                        'jumlah'=>$request->jumlah,

                        'harga'=>$produk->harga,

                        'subtotal'=>$subtotal,

                    ]);



                    $stok->decrement('jumlah',$request->jumlah);
              Pengiriman::create([
                'transaksi_id' => $transaksi->id,
                'ongkir' => $ongkir,
                'status' => 'menunggu',
            ]);



                    return redirect()
                        ->route('pelanggan.alamat',$transaksi->id);
                }

                // TAMBAH KE KERANJANG
                public function tambahKeranjang(Request $request, $id)
                {
                    $request->validate([
                        'ukuran_id' => 'required',
                        'warna_id'  => 'required',
                        'jumlah'    => 'required|integer|min:1',
                    ]);

                    Keranjang::create([
                        'user_id'   => Auth::id(),
                        'produk_id' => $id,
                        'ukuran_id' => $request->ukuran_id,
                        'warna_id'  => $request->warna_id,
                        'jumlah'    => $request->jumlah,
                    ]);

                    return redirect()
                        ->route('pelanggan.keranjang')
                        ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
                }

                // KERANJANG
                public function keranjang()
                    {
                        $keranjangs = Keranjang::with([
                        'produk',
                        'ukuran',
                        'warna'
                ])
                        ->where('user_id', Auth::id())
                        ->get();

                    return view('pelanggan.keranjang', compact('keranjangs'));
                }

                // HAPUS PRODUK DARI KERANJANG
                    public function destroy($id)
                    {
                        $keranjang = Keranjang::findOrFail($id);

                        // Pastikan hanya pemilik keranjang yang bisa menghapus
                        if ($keranjang->user_id != Auth::id()) {
                            abort(403);
                        }

                        $keranjang->delete();

                        return redirect()
                            ->route('pelanggan.keranjang')
                            ->with('success', 'Produk berhasil dihapus dari keranjang.');
                    }

                // CHECKOUT
                public function checkout()
                {
                    $keranjangs = Keranjang::with([
                        'produk',
                        'ukuran',
                        'warna'
                    ])
                    ->where('user_id', Auth::id())
                    ->get();

                    $total = 0;

                    foreach ($keranjangs as $item) {
                        $total += $item->produk->harga * $item->jumlah;
                    }

                    return view('pelanggan.checkout', compact('keranjangs', 'total'));
                }
                // PROSES CHECKOUT
                public function prosesCheckout(Request $request)
                {
                        $keranjang = Keranjang::with([
                        'produk',
                        'ukuran',
                        'warna'
                    ])
                    ->where('user_id', Auth::id())
                    ->get();

                    if ($keranjang->count() == 0) {
                        return back()->with('error', 'Keranjang masih kosong.');
                    }
                        $totalProduk = 0;

                        foreach ($keranjang as $item) {
                            $totalProduk += $item->produk->harga * $item->jumlah;
                        }


                    // Ongkir dipilih setelah alamat
                        $ongkir = 10000;


                        // Total sementara
                        $total = $totalProduk + $ongkir;
                        $transaksi = Transaksi::create([
                        'user_id' => Auth::id(),
                        'kode_transaksi' => 'TRX'.strtoupper(Str::random(10)),
                        'tanggal_transaksi' => now(),

                        'nama_penerima' => '-',
                        'alamat' => '-',
                        'no_hp' => '-',

                        'total_harga' => $totalProduk,
                        'ongkir' => $ongkir,
                        'bayar' => 0,
                        'kembalian' => 0,   
                        'status' => 'Belum Bayar',
                    ]);

               Pengiriman::create([
                    'transaksi_id' => $transaksi->id,
                    'ongkir' => $ongkir,
                    'nomor_resi' => null,
                    'status' => 'menunggu',
                ]);
                                foreach ($keranjang as $item) {

                    $stok = Stok::where('produk_id', $item->produk_id)
                    ->where('ukuran_id', $item->ukuran_id)
                    ->where('warna_id', $item->warna_id)
                    ->first();

                    if (!$stok) {
                        return back()->with('error', 'Stok produk tidak ditemukan.');
                    }

                    if ($stok->jumlah < $item->jumlah) {
                        return back()->with('error', 'Stok produk tidak mencukupi.');
                    }

                        DetailTransaksi::create([
                        'transaksi_id' => $transaksi->id,
                        'stok_id'      => $stok->id,
                        'produk_id'    => $item->produk_id,
                        'warna_id'     => $item->warna_id,
                        'ukuran_id'    => $item->ukuran_id,
                        'jumlah'       => $item->jumlah,
                        'harga'        => $item->produk->harga,
                        'subtotal'     => $item->produk->harga * $item->jumlah,
                    ]);
                    $stok->decrement('jumlah', $item->jumlah);
                }

                    Keranjang::where('user_id', Auth::id())->delete();

                    return redirect()->route('pelanggan.alamat', $transaksi->id);
                }

                //Alamat
            public function alamat($id)
                {
                    $transaksi = Transaksi::where('user_id', Auth::id())
                                    ->findOrFail($id);

                    return view('pelanggan.alamat', compact('transaksi'));
                }



                // SIMPAN ALAMAT

                public function simpanAlamat(Request $request, $id)
        {
            $request->validate([
                'nama_penerima' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'kurir' => 'required',
                'layanan' => 'required',
            ]);

        $transaksi = Transaksi::where('user_id', Auth::id())
                        ->with('detailTransaksi')
                        ->findOrFail($id);

            $hargaProduk = $transaksi->detailTransaksi->sum(function($item){
            return $item->harga * $item->jumlah;
        });


        $ongkir = 10000; // sementara ongkir manual

        $total = $hargaProduk + $ongkir;


    $transaksi->update([
        'nama_penerima' => $request->nama_penerima,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'ongkir' => 10000,
        'total_harga' => $hargaProduk,
    ]);

    $transaksi->refresh();

    //dd($transaksi->ongkir);

            Pengiriman::updateOrCreate(
                [
                    'transaksi_id'=>$transaksi->id
                ],
            [
                'kurir'=>$request->kurir,
                'layanan'=>$request->layanan,
                'ongkir' => $ongkir,
                'nomor_resi'=>null,
                'status'=>'menunggu',
            ]
            );
        session([
            'ongkir' => $ongkir,
            'kurir' => $request->kurir,
            'layanan' => $request->layanan
        ]);


            return redirect()
                ->route('pelanggan.pembayaran',$transaksi->id);
        }
                // HALAMAN PEMBAYARAN
                    public function pembayaran($id)
                    {
                        $transaksi = Transaksi::where('user_id', Auth::id())
                            ->with('detailTransaksi.produk')
                            ->findOrFail($id);
                        $hargaProduk = 0;

                        foreach ($transaksi->detailTransaksi as $detail) {
                            $hargaProduk += $detail->harga * $detail->jumlah;
                        }

                        $ongkir = $transaksi->ongkir;

                        $totalPembayaran = $hargaProduk + $ongkir;

                    return view('pelanggan.pembayaran', compact(
                            'transaksi',
                            'hargaProduk',
                            'ongkir',
                            'totalPembayaran'
                        ));
                    }


                // UPLOAD BUKTI
                public function upload(Request $request, $id)
                {
                    $request->validate([
                        'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                    ]);

                    $namaFile = time().'.'.$request->bukti->extension();
                    $request->bukti->move(public_path('bukti'), $namaFile);

                    $transaksi = Transaksi::where('user_id', Auth::id())
                        ->findOrFail($id);

                    Pembayaran::create([
                        'transaksi_id' => $id,
                        'bukti' => $namaFile,
                        'status' => 'Menunggu Verifikasi',
                    ]);

                   $transaksi->update([
                    'bayar' => $transaksi->total_harga,
                    'kembalian' => 0,
                    'status' => 'Diproses',
                ]);

                    return redirect()->route('pelanggan.dashboardBelanja')
                        ->with('success', 'Bukti pembayaran berhasil diupload.');
                }

                public function uploadFotoProduk(Request $request, $id)
                {
                    $request->validate([
                        'foto_produk' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                    ]);

                    $pengiriman = Pengiriman::where('transaksi_id', $id)->firstOrFail();

                    $namaFile = time() . '_' . $request->file('foto_produk')->getClientOriginalName();

                    $request->file('foto_produk')->move(
                        public_path('foto_produk'),
                        $namaFile
                    );

                    $pengiriman->update([
                        'foto_produk' => $namaFile,
                    ]);

    return back()->with('success', 'Foto produk berhasil diupload.');
}
                // DASHBOARD STATUS
                public function index()
                {
                    $totalPesanan = Transaksi::where(
                        'user_id',
                        Auth::id()
                    )->count();

                   $belumBayar = Transaksi::where('user_id', Auth::id())
                        ->where('status', 'Belum Bayar')
                        ->count();
                    
                    $menungguVerifikasi = Transaksi::where('user_id', Auth::id())
                        ->where('status', 'Menunggu Verifikasi')
                        ->count();

                    $diproses = Transaksi::where('user_id', Auth::id())
                        ->where('status', 'Diproses')
                        ->count();

                    $selesai = Transaksi::where('user_id', Auth::id())
                        ->where('status', 'Selesai')
                        ->count();

                        $dikirim = Transaksi::where('user_id',Auth::id())
                        ->whereHas('pengiriman',function($q){
                            $q->where('status','dikirim');
                        })
                        ->count();

                    return view('pelanggan.dashboard', compact(
                        'totalPesanan',
                        'belumBayar',
                        'menungguVerifikasi',
                        'diproses',
                        'selesai',
                        'dikirim'
                    ));
                }   

                // RIWAYAT PESANAN
            public function riwayat()
            {
                $transaksis = Transaksi::with([
                    'pengiriman',
                    'pembayaran',
                    'detailTransaksi.produk'
                ])

                ->where('user_id',Auth::id())
                ->latest()
                ->get();


                return view(
                    'pelanggan.riwayat',
                    compact('transaksis')
                );
            }
                    public function destroyTransaksi($id)
                {
                    $transaksi = Transaksi::where('user_id', Auth::id())
                                    ->findOrFail($id);
                        DetailTransaksi::where('transaksi_id', $id)->delete();

                        Pembayaran::where('transaksi_id', $id)->delete();

                        Pengiriman::where('transaksi_id', $id)->delete();

                        $transaksi->delete();

                    return back()->with('success', 'Pesanan berhasil dihapus.');
                }
            }