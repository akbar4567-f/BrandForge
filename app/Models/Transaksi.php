<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\DetailTransaksi;

    class Transaksi extends Model
    {
        use HasFactory;

        protected $table = 'transaksis';

        protected $fillable = [
        'user_id',
        'nama_penerima',
        'alamat',
        'no_hp',
        'kode_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'ongkir',
        'bayar',
        'kembalian',
        'status',
    ];

        // Relasi ke user
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        // Relasi ke detail transaksi
        public function detailTransaksi()
        {
            return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
        }

        // Relasi ke pembayaran
        public function pembayaran()
        {
            return $this->hasOne(Pembayaran::class);
        }

        // Relasi ke pengiriman
        public function pengiriman()
        {
            return $this->hasOne(Pengiriman::class, 'transaksi_id');
        }
    }