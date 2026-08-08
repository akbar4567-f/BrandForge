@extends('layouts.app')

@section('title','Edit Biaya Operasional')

@section('content')

<div class="container py-4">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>Edit Biaya Operasional</h4>

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

<form action="{{ route('biaya-operasional.update',$biaya->id) }}"
      method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label class="form-label">

Tanggal

</label>

<input
type="date"
name="tanggal"
class="form-control"
value="{{ old('tanggal',$biaya->tanggal) }}"
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
required>{{ old('keterangan',$biaya->keterangan) }}</textarea>

</div>

<div class="mb-3">

<label class="form-label">

Nominal

</label>

<input
type="number"
name="nominal"
class="form-control"
value="{{ old('nominal',$biaya->nominal) }}"
required>

</div>

<button class="btn btn-success">

Update

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