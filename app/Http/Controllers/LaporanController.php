<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
class LaporanController extends Controller
{
    public function index()
{
    $transaksi = Transaksi::with('user')->latest()->get();

    $totalPendapatan = $transaksi->sum('total_harga');

    $pendapatanHarian = Transaksi::whereDate('tanggal_transaksi', Carbon::today())
        ->sum('total_harga');

    $pendapatanBulanan = Transaksi::whereMonth('tanggal_transaksi', Carbon::now()->month)
        ->whereYear('tanggal_transaksi', Carbon::now()->year)
        ->sum('total_harga');

    $pendapatanTahunan = Transaksi::whereYear('tanggal_transaksi', Carbon::now()->year)
        ->sum('total_harga');

    return view('laporan.index', compact(
        'transaksi',
        'totalPendapatan',
        'pendapatanHarian',
        'pendapatanBulanan',
        'pendapatanTahunan'
    ));
}

    public function pdf()
    {
        $transaksi = Transaksi::with('user')->latest()->get();

        $totalPendapatan = $transaksi->sum('total_harga');

        $pdf = Pdf::loadView('laporan.pdf', compact('transaksi', 'totalPendapatan'));

        return $pdf->download('laporan-transaksi.pdf');
    }
}