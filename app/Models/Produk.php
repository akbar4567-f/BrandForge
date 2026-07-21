<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto',
        'berat',
        'panjang',
        'lebar',
        'tinggi',
    ];

        protected $casts = [
        'berat' => 'integer',
        'panjang' => 'integer',
        'lebar' => 'integer',
        'tinggi' => 'integer',
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke stok
    public function stok()
    {
        return $this->hasMany(Stok::class);
    }

    // Relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    // Relasi ke keranjang
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}