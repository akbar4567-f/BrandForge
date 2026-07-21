@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Laporan Transaksi</h2>

    <div class="card mb-3 border-success">
    <div class="card-body">
        <h5>Total Pendapatan</h5>
        <h3 class="text-success">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </h3>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Pendapatan Harian</h6>
                <h4 class="text-primary">
                    Rp {{ number_format($pendapatanHarian, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-warning shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Pendapatan Bulanan</h6>
                <h4 class="text-warning">
                    Rp {{ number_format($pendapatanBulanan, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-info shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Pendapatan Tahunan</h6>
                <h4 class="text-info">
                    Rp {{ number_format($pendapatanTahunan, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>
</div>

    <a href="{{ route('laporan.pdf') }}" class="btn btn-danger mb-3">
        Download PDF
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->tanggal_transaksi }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->bayar, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Belum ada data transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection