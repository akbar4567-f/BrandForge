<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Data Kategori</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2>Master Data Kategori</h2>

<a href="/admin" class="btn btn-secondary mb-3">
Dashboard Admin
</a>
<a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">
+ Tambah Kategori
</a>

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif

<table class="table table-bordered table-striped">

<tr>

<th>No</th>

<th>Nama Kategori</th>

<th width="220">Aksi</th>

</tr>

@foreach($kategoris as $kategori)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $kategori->nama_kategori }}</td>

<td>

<a href="{{ route('kategori.edit',$kategori->id) }}" class="btn btn-warning">
Edit
</a>

<form action="{{ route('kategori.destroy',$kategori->id) }}" method="POST" style="display:inline;">

@csrf

@method('DELETE')

<button class="btn btn-danger">

Hapus

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

</body>

</html>