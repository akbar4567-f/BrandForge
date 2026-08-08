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
        'koleksi_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'modal_produk',
        'stok',
        'foto',
        'berat',
        'panjang',
        'lebar',
        'tinggi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'modal_produk' => 'decimal:2',
        'berat' => 'integer',
        'panjang' => 'integer',
        'lebar' => 'integer',
        'tinggi' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function koleksi()
    {
        return $this->belongsTo(Koleksi::class);
    }

    public function fotos()
    {
        return $this->hasMany(ProdukFoto::class, 'produk_id');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}