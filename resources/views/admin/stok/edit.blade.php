<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Stok</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .container{
            margin-top:40px;
            max-width:700px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .btn{
            border-radius:8px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header bg-warning">
            <h4 class="mb-0">✏️ Edit Stok</h4>
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

            <form action="{{ route('stok.update', $stok->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <select name="produk_id" class="form-select" required>
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}"
                                {{ old('produk_id', $stok->produk_id) == $produk->id ? 'selected' : '' }}>
                                {{ $produk->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ukuran</label>
                    <select name="ukuran_id" class="form-select" required>
                        @foreach($ukurans as $ukuran)
                            <option value="{{ $ukuran->id }}"
                                {{ old('ukuran_id', $stok->ukuran_id) == $ukuran->id ? 'selected' : '' }}>
                                {{ $ukuran->nama_ukuran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <select name="warna_id" class="form-select" required>
                        @foreach($warnas as $warna)
                            <option value="{{ $warna->id }}"
                                {{ old('warna_id', $stok->warna_id) == $warna->id ? 'selected' : '' }}>
                                {{ $warna->nama_warna }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Stok</label>
                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        value="{{ old('jumlah', $stok->jumlah) }}"
                        min="0"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('stok.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>