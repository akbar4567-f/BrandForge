<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>📦 Data Produk</h2>

        <div>

            <a href="/admin" class="btn btn-secondary">
                Dashboard
            </a>

            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                + Tambah Produk
            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

        <tr>

            <th>No</th>

            <th>Foto</th>

            <th>Nama</th>

            <th>Kategori</th>

            <th>Harga</th>

            <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        @forelse($produks as $produk)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>

                @if($produk->foto)

                    <img src="{{ asset('produk/'.$produk->foto) }}"
                         width="80">

                @endif

            </td>

            <td>{{ $produk->nama_produk }}</td>

            <td>{{ $produk->kategori->nama_kategori }}</td>

            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
            <td>

                <a href="{{ route('produk.edit',$produk->id) }}"
                   class="btn btn-warning btn-sm">

                    Edit

                </a>

                <form action="{{ route('produk.destroy',$produk->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus produk?')"
                        class="btn btn-danger btn-sm">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6" class="text-center">

                Belum ada produk.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>