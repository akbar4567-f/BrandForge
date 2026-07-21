<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Stok</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .container{
            margin-top:40px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .btn{
            border-radius:8px;
        }

        table{
            vertical-align:middle;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">📦 Data Stok</h4>

            <a href="{{ route('stok.create') }}" class="btn btn-light">
                + Tambah Stok
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Jumlah</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($stoks as $stok)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $stok->produk->nama_produk }}</td>

                        <td>{{ $stok->ukuran->nama_ukuran }}</td>

                        <td>{{ $stok->warna->nama_warna }}</td>

                        <td>{{ $stok->jumlah }}</td>

                        <td>

                            <a href="{{ route('stok.edit',$stok->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('stok.destroy',$stok->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data stok ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data stok.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

            <a href="/admin" class="btn btn-secondary">
                ← Kembali ke Dashboard Admin
            </a>

        </div>

    </div>

</div>

</body>
</html>