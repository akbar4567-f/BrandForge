<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">
            <h3>✏️ Edit Produk</h3>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kategori</label>

                    <select name="kategori_id" class="form-control">

                        @foreach($kategoris as $kategori)

                            <option value="{{ $kategori->id }}"
                                {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>

                                {{ $kategori->nama_kategori }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">

                    <label class="form-label">Nama Produk</label>

                    <input
                        type="text"
                        name="nama_produk"
                        class="form-control"
                        value="{{ old('nama_produk', $produk->nama_produk) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Harga</label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga', $produk->harga) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                </div>

                <div class="row">

                <div class="col-md-3 mb-3">
                    <label class="form-label">Berat (gram)</label>
                    <input
                        type="number"
                        name="berat"
                        class="form-control"
                        value="{{ old('berat', $produk->berat) }}"
                        min="0"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Panjang (cm)</label>
                    <input
                        type="number"
                        name="panjang"
                        class="form-control"
                        value="{{ old('panjang', $produk->panjang) }}"
                        min="0"
                        required>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Lebar (cm)</label>
                    <input
                        type="number"
                        name="lebar"
                        class="form-control"
                        value="{{ old('lebar', $produk->lebar) }}"
                        min="0"
                        required>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Tinggi (cm)</label>
                    <input
                        type="number"
                        name="tinggi"
                        class="form-control"
                        value="{{ old('tinggi', $produk->tinggi) }}"
                        min="0"
                        required>
                </div>

            </div>

                <div class="mb-3">

                    <label class="form-label">Foto Lama</label>

                    <br>

                    @if($produk->foto)

                        <img src="{{ asset('produk/'.$produk->foto) }}"
                             width="150"
                             class="img-thumbnail mb-2">

                    @else

                        <p class="text-muted">Belum ada foto.</p>

                    @endif

                </div>

                <div class="mb-3">

                    <label class="form-label">Ganti Foto (Opsional)</label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control">

                </div>

                <button type="submit" class="btn btn-success">
                    💾 Update Produk
                </button>

                <a href="{{ route('produk.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>