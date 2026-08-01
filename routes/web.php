<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ShippingController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\OwnerController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\KasirController;
    use App\Http\Controllers\PelangganController;
    use App\Http\Controllers\KategoriController;
    use App\Http\Controllers\ProdukController;
    use App\Http\Controllers\UkuranController;
    use App\Http\Controllers\WarnaController;
    use App\Http\Controllers\StokController;
    use App\Http\Controllers\WebsiteController;
    use App\Http\Controllers\LaporanController;
    use App\Http\Controllers\KoleksiController;

    // Halaman Awal

    Route::get('/', function () {
        return redirect('/login');
    });

    // Route untuk tes
    Route::get('/tes', function () {
        return 'Laravel OK';
    });

    // Login khusus setiap role
    Route::get('/login/{role}', function ($role) {
        if (!in_array($role, ['owner', 'admin', 'kasir', 'pelanggan'])) {
            abort(404);
        }

            return view('auth.login', compact('role'));
        })->middleware('guest');
    // Dashboard Setelah Login

    Route::get('/dashboard', function () {

        if (auth()->user()->role == 'owner') {
            return redirect()->route('owner.index');
        }

        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.index');
        }

        if (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.index');
        }

        // Pelanggan masuk ke Dashboard Belanja (Tahap 10)
        if (auth()->user()->role == 'pelanggan') {
            return redirect()->route('pelanggan.dashboardBelanja');
        }

    })->middleware(['auth', 'verified'])->name('dashboard');
    // Semua Route Login

    Route::middleware('auth')->group(function () {

        // Profile

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // OWNER

        Route::middleware('role:owner')->group(function () {

            Route::get('/owner', [OwnerController::class, 'index'])
                ->name('owner.index');

            Route::get('/owner/laporan', [LaporanController::class, 'index'])
                ->name('laporan.index');

            Route::get('/owner/laporan/pdf', [LaporanController::class, 'pdf'])
                ->name('laporan.pdf');

        });

        // ADMIN

        Route::middleware('role:owner,admin')->group(function () {

            Route::get('/admin', [AdminController::class, 'index'])
                ->name('admin.index');

            Route::resource('admin/kategori', KategoriController::class)
                ->names('kategori');

            Route::resource('admin/produk', ProdukController::class)
                ->names('produk');

            Route::resource('admin/ukuran', UkuranController::class)
                ->names('ukuran');

            Route::resource('admin/warna', WarnaController::class)
                ->names('warna');

            Route::resource('admin/stok', StokController::class)
                ->names('stok');

            Route::resource('admin/koleksi', KoleksiController::class)
                ->names('koleksi');
            
            // Pengiriman Admin

            Route::get('/admin/pengiriman', [ShippingController::class, 'index'])
              ->name('admin.pengiriman.index');

            Route::get('/admin/pengiriman/{id}/edit', [ShippingController::class, 'edit'])
              ->name('admin.pengiriman.edit');


            Route::post('/admin/pengiriman/store', [ShippingController::class, 'store'])
               ->name('admin.pengiriman.store');


            Route::put('/admin/pengiriman/{id}/status', [ShippingController::class, 'updateStatus'])
              ->name('admin.pengiriman.status');


            Route::put('/admin/pengiriman/{id}/resi', [ShippingController::class, 'updateResi'])
               ->name('admin.pengiriman.resi');

            Route::get('/admin/pengiriman/{id}/label', [ShippingController::class, 'printLabel'])
               ->name('admin.pengiriman.label');

            });

        // KASIR

        Route::middleware('role:owner,kasir')->group(function () {

            Route::get('/kasir', [KasirController::class, 'index'])
                ->name('kasir.index');

            Route::get('/kasir/transaksi', [KasirController::class, 'transaksi'])
                ->name('kasir.transaksi');

            Route::post('/kasir/transaksi', [KasirController::class, 'store'])
                ->name('kasir.store');

            Route::get('/kasir/riwayat', [KasirController::class, 'riwayat'])
                ->name('kasir.riwayat');

            Route::get('/kasir/detail/{id}', [KasirController::class, 'show'])
                ->name('kasir.detail');

            Route::get('/kasir/struk/{id}', [KasirController::class, 'struk'])
                ->name('kasir.struk');

            Route::put('/kasir/transaksi/{id}/verifikasi', [KasirController::class, 'verifikasi'])
                ->name('kasir.verifikasi');

            Route::put('/kasir/transaksi/{id}/selesai', [KasirController::class, 'selesai'])
                ->name('kasir.selesai');

            Route::delete('/kasir/transaksi/{id}', [KasirController::class, 'destroy'])
                ->name('kasir.destroy');

            Route::put('/kasir/pengiriman/{id}/resi', [ KasirController::class,'updateResi'   ])
               ->name('kasir.pengiriman.resi');

            Route::put('/kasir/pengiriman/{id}/status', [  KasirController::class,'updateStatusKirim'  ])
               ->name('kasir.pengiriman.status');

            Route::get('/kasir/pengiriman/{id}/label',[KasirController::class, 'printLabel'])
               ->name('kasir.pengiriman.label');

         Route::get('/kasir/transaksi/{id}/bukti', [KasirController::class, 'buktiPembayaran'])
            ->name('kasir.buktiPembayaran');

        Route::get('/kasir/transaksi/{id}/produk', [KasirController::class, 'buktiProduk'])
            ->name('kasir.buktiProduk');
        });


        });

        // PELANGGAN

        Route::middleware('role:owner,pelanggan')->group(function () {

            // Dashboard Belanja
            Route::get('/pelanggan', [PelangganController::class, 'dashboardBelanja'])
                ->name('pelanggan.dashboardBelanja');

            // Daftar Produk
            Route::get('/pelanggan/belanja', [PelangganController::class, 'belanja'])
                ->name('pelanggan.belanja');

            // Detail Produk
            Route::get('/pelanggan/detail/{id}', [PelangganController::class, 'detailProduk'])
                ->name('pelanggan.detailProduk');
            // Beli Sekarang
            Route::post('/pelanggan/beli-sekarang/{id}', [PelangganController::class, 'beliSekarang'])
                ->name('pelanggan.beliSekarang');

            // Keranjang
            Route::get('/pelanggan/keranjang', [PelangganController::class, 'keranjang'])
                ->name('pelanggan.keranjang');

            // Tambah ke Keranjang
            Route::post('/pelanggan/keranjang/tambah/{id}', [PelangganController::class, 'tambahKeranjang'])
                ->name('pelanggan.tambahKeranjang');
            // Hapus produk dari kerajang
            Route::delete('/pelanggan/keranjang/{id}', [PelangganController::class, 'destroy'])
                ->name('keranjang.destroy');

            // Checkout dari Keranjang
            Route::get('/pelanggan/checkout', [PelangganController::class, 'checkout'])
                ->name('pelanggan.checkout');

            // Proses Checkout
            Route::post('/pelanggan/checkout', [PelangganController::class, 'prosesCheckout'])
                ->name('pelanggan.prosesCheckout');

            // Alamat
            Route::get('/pelanggan/alamat/{id}', [PelangganController::class, 'alamat'])
                ->name('pelanggan.alamat');

            Route::post('/pelanggan/alamat/{id}', [PelangganController::class, 'simpanAlamat'])
                ->name('pelanggan.simpanAlamat');
            
        // Pembayaran
            Route::get('/pelanggan/pembayaran/{id}', [PelangganController::class, 'pembayaran'])
                ->name('pelanggan.pembayaran');

            // Upload Bukti
            Route::post('/pelanggan/upload/{id}', [PelangganController::class, 'upload'])
                ->name('pelanggan.upload');

            // Dashboard Status Pesanan
            Route::get('/pelanggan/dashboard-status', [PelangganController::class, 'index'])
                ->name('pelanggan.index');

            Route::get('/pelanggan/riwayat', [PelangganController::class, 'riwayat'])
                ->name('pelanggan.riwayat');

            // Tracking Pengiriman
           Route::get('/pelanggan/pesanan/{id}/tracking', [ShippingController::class,'tracking'])
                 ->name('pelanggan.tracking');

            Route::delete('/pelanggan/transaksi/{id}', [PelangganController::class, 'destroyTransaksi'])
                  ->name('pelanggan.destroyTransaksi');

            // Upload Foto Produk Setelah Barang Diterima
            Route::post('/pelanggan/upload-foto-produk/{id}', [PelangganController::class,'uploadFotoProduk'])
                ->name('pelanggan.uploadFotoProduk');

        });


        // WEBSITE 

        Route::get('/website', [WebsiteController::class, 'home'])
            ->name('website.home');

        Route::get('/website/tentang', [WebsiteController::class, 'tentang'])
            ->name('website.tentang');

        Route::get('/website/produk', [WebsiteController::class, 'produk'])
            ->name('website.produk');

        Route::get('/website/produk/{id}', [WebsiteController::class, 'detail'])
            ->name('website.detail');

        Route::get('/website/kontak', [WebsiteController::class, 'kontak'])
            ->name('website.kontak');

    require __DIR__.'/auth.php';