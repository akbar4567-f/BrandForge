<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    protected $fillable = [
        'produk_id',
        'ukuran_id',
        'warna_id',
        'jumlah',
    ];

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Relasi ke Ukuran
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class);
    }

    // Relasi ke Warna
    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }
}