<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background:#f2f2f2;
            text-align:center;
            padding:8px;
        }

        td{
            padding:6px;
        }
    </style>
</head>
<body>

    <h2>LAPORAN TRANSAKSI</h2>

    <h2 style="text-align:center;">Laporan Transaksi</h2>

    <p>
        <strong>Total Pendapatan :</strong>
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </p>

<hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
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
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->tanggal_transaksi }}</td>
                    <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->bayar,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->kembalian,0,',','.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">
                        Tidak ada data transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>