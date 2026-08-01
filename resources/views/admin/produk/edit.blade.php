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

        <div class="card-header bg-warning">
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

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Kategori</label>

                        <select name="kategori_id" class="form-control" required>

                            @foreach($kategoris as $kategori)

                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>

                                    {{ $kategori->nama_kategori }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Koleksi</label>

                        <select name="koleksi_id" class="form-control">

                            <option value="">-- Tidak Ada --</option>

                            @foreach($koleksis as $koleksi)

                                <option value="{{ $koleksi->id }}"
                                    {{ old('koleksi_id', $produk->koleksi_id) == $koleksi->id ? 'selected' : '' }}>

                                    {{ $koleksi->nama_koleksi }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Nama Produk</label>

                    <input
                        type="text"
                        name="nama_produk"
                        class="form-control"
                        value="{{ old('nama_produk', $produk->nama_produk) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Harga</label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga', $produk->harga) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">

                        <label>Berat (gram)</label>

                        <input
                            type="number"
                            name="berat"
                            class="form-control"
                            value="{{ old('berat', $produk->berat) }}"
                            required>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>Panjang (cm)</label>

                        <input
                            type="number"
                            name="panjang"
                            class="form-control"
                            value="{{ old('panjang', $produk->panjang) }}"
                            required>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>Lebar (cm)</label>

                        <input
                            type="number"
                            name="lebar"
                            class="form-control"
                            value="{{ old('lebar', $produk->lebar) }}"
                            required>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>Tinggi (cm)</label>

                        <input
                            type="number"
                            name="tinggi"
                            class="form-control"
                            value="{{ old('tinggi', $produk->tinggi) }}"
                            required>

                    </div>

                </div>

                <hr>

                <h5>Foto Produk</h5>

                <div class="row">

                    @for($i=1;$i<=5;$i++)

                        @php
                            $field = $i == 1 ? 'foto' : 'foto'.$i;
                        @endphp

                        <div class="col-md-4 mb-4">

                            <label class="form-label">

                                {{ $i==1 ? 'Foto Utama' : 'Foto '.$i }}

                            </label>

                            <br>

                            @if($produk->$field)

                                <img
                                    src="{{ asset('produk/'.$produk->$field) }}"
                                    class="img-thumbnail mb-2"
                                    style="height:150px;object-fit:cover;">

                            @else

                                <div class="text-muted mb-2">
                                    Belum ada foto
                                </div>

                            @endif

                            <input
                                type="file"
                                name="{{ $field }}"
                                class="form-control">

                        </div>

                    @endfor

                </div>

                <button class="btn btn-success">
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