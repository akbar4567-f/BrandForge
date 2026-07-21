@extends('layouts.app')

@section('title','Riwayat Pesanan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Riwayat Pesanan</h2>
    
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
        ← Kembali ke Dashboard
    </a>
</div>

<table class="table table-bordered">

<thead>
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Kurir</th>
    <th>Layanan</th>
    <th>Resi</th>
    <th>Status Pengiriman</th>
    <th>Status Pesanan</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($transaksis as $transaksi)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $transaksi->kode_transaksi }}</td>

<td>{{ $transaksi->tanggal_transaksi }}</td>

<td>Rp {{ number_format($transaksi->total_harga) }}</td>

<td>
    @if($transaksi->pengiriman)
        {{ $transaksi->pengiriman->kurir }}
    @else
        -
    @endif
</td>


<td>
    @if($transaksi->pengiriman)
        {{ $transaksi->pengiriman->layanan }}
    @else
        -
    @endif
</td>


<td>
    @if($transaksi->pengiriman && $transaksi->pengiriman->nomor_resi)

        {{ $transaksi->pengiriman->nomor_resi }}

    @else

        Belum tersedia

    @endif
</td>


<td>

@if($transaksi->pengiriman)

    @if($transaksi->pengiriman->status == 'Menunggu Pembayaran')

        <span class="badge bg-warning">
            Menunggu Pembayaran
        </span>

    @elseif($transaksi->pengiriman->status == 'Diproses')

        <span class="badge bg-info">
            Diproses
        </span>

    @elseif($transaksi->pengiriman->status == 'Dikemas')

        <span class="badge bg-primary">
            Dikemas
        </span>

    @elseif($transaksi->pengiriman->status == 'Dikirim')

        <span class="badge bg-success">
            Dikirim
        </span>

    @elseif($transaksi->pengiriman->status == 'Selesai')

        <span class="badge bg-success">
            Selesai
        </span>

    @endif

@else

    -

@endif

</td>

<td>


@if($transaksi->status == 'Menunggu Pembayaran')

    <span class="badge bg-warning">
        Menunggu Pembayaran
    </span>

@elseif($transaksi->status == 'Menunggu Verifikasi')

    <span class="badge bg-secondary">
        Menunggu Verifikasi
    </span>

@elseif($transaksi->status == 'Diproses')

    <span class="badge bg-info">
        Diproses
    </span>

    @elseif($transaksi->status == 'Dikirim')

    <span class="badge bg-success">
        Dikirim
    </span>

@elseif($transaksi->status == 'Selesai')

    <span class="badge bg-success">
        Selesai
    </span>

@endif

</td>
<td>
    <form action="{{ route('pelanggan.destroyTransaksi', $transaksi->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm">
            Hapus
        </button>

    </form>
</td>
</tr>

@empty

<tr>

<td colspan="10" class="text-center">
    Belum ada transaksi
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection