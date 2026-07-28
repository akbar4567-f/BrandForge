<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Tambah Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">

<h3>Tambah Produk</h3>

</div>

<div class="card-body">

<form action="{{ route('produk.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori_id"
class="form-control">

@foreach($kategoris as $kategori)

<option value="{{ $kategori->id }}">

{{ $kategori->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Nama Produk</label>

<input
    type="text"
    name="nama_produk"
    class="form-control"
    value="{{ old('nama_produk') }}"
    required>
</div>

<div class="mb-3">

<label>Harga</label>

<input
    type="number"
    name="harga"
    class="form-control"
    value="{{ old('harga') }}"
    required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
    name="deskripsi"
    class="form-control">{{ old('deskripsi') }}</textarea>

</div>
<div class="row">

    <div class="col-md-3 mb-3">
        <label>Berat (gram)</label>
       <input
            type="number"
            name="berat"
            class="form-control"
            value="{{ old('berat',0) }}"
            min="0"
            required>
    </div>

    <div class="col-md-3 mb-3">
        <label>Panjang (cm)</label>
       <input
            type="number"
            name="panjang"
            class="form-control"
            value="{{ old('panjang',0) }}"
            min="0"
            required>
    </div>

    <div class="col-md-2 mb-3">
        <label>Lebar (cm)</label>
       <input
            type="number"
            name="lebar"
            class="form-control"
            value="{{ old('lebar',0) }}"
            min="0"
            required>
    </div>

    <div class="col-md-2 mb-3">
        <label>Tinggi (cm)</label>
       <input
            type="number"
            name="tinggi"
            class="form-control"
            value="{{ old('tinggi',0) }}"
            min="0"
            required>
    </div>

</div>

<div class="mb-3">

<label>Foto</label>

<input
type="file"
name="foto"
class="form-control">

</div>

<button class="btn btn-success">

Simpan

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