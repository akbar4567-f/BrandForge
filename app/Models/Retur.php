<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    protected $table = 'returs';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah',
        'alasan',
        'keterangan',
        'tanggal_retur',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'tanggal_retur' => 'date',
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}