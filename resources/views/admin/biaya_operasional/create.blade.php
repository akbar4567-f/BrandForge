@extends('layouts.app')

@section('title','Tambah Biaya Operasional')

@section('content')

<div class="container py-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Tambah Biaya Operasional</h4>

</div>

<div class="card-body">

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('biaya-operasional.store') }}"
      method="POST">

@csrf

<div class="mb-3">

<label class="form-label">

Tanggal

</label>

<input
type="date"
name="tanggal"
class="form-control"
value="{{ old('tanggal') }}"
required>

</div>

<div class="mb-3">

<label class="form-label">

Keterangan

</label>

<textarea
name="keterangan"
class="form-control"
rows="4"
required>{{ old('keterangan') }}</textarea>

</div>

<div class="mb-3">

<label class="form-label">

Nominal

</label>

<input
type="number"
name="nominal"
class="form-control"
value="{{ old('nominal') }}"
required>

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="{{ route('biaya-operasional.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

@endsection