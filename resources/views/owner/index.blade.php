<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial, Helvetica, sans-serif;
    }

    body{
        background:linear-gradient(135deg,#16213E,#2563EB);
        min-height:100vh;
    }

    .container{
        width:90%;
        margin:auto;
        padding:30px 0;
    }

    .header{
        background:#fff;
        border-radius:15px;
        padding:25px;
        margin-bottom:25px;
        box-shadow:0 5px 15px rgba(0,0,0,.2);
    }

    .header h1{
        color:#2563EB;
        margin-bottom:10px;
    }

    .header p{
        font-size:18px;
    }

    .logout{
        margin-top:15px;
    }

    .logout button{
        background:red;
        color:white;
        border:none;
        padding:10px 20px;
        border-radius:8px;
        cursor:pointer;
        font-weight:bold;
    }

    .menu{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:20px;
    }

    .card{
        background:white;
        border-radius:15px;
        padding:25px;
        text-align:center;
        box-shadow:0 5px 15px rgba(0,0,0,.2);
        transition:.3s;
    }

    .card:hover{
        transform:translateY(-8px);
    }

    .card h2{
        color:#2563EB;
        margin-bottom:10px;
    }

    .card p{
        margin-bottom:15px;
        color:#555;
    }

    .btn{
        display:inline-block;
        background:#2563EB;
        color:white;
        text-decoration:none;
        padding:10px 25px;
        border-radius:8px;
        font-weight:bold;
    }

    .btn:hover{
        background:#1D4ED8;
    }

    .hakakses{
        background:white;
        margin-top:30px;
        border-radius:15px;
        padding:25px;
        box-shadow:0 5px 15px rgba(0,0,0,.2);
    }

    .hakakses h2{
        color:#2563EB;
        margin-bottom:15px;
    }

    .hakakses ul{
        margin-left:20px;
        line-height:35px;
        font-size:17px;
    }

    </style>

</head>

<body>

<div class="container">

<div class="header">

<h1>👑 Dashboard Owner</h1>
<a href="{{ route('website.home') }}" class="btn btn-primary">
    <i class="bi bi-globe"></i> Website
</a>
<form class="logout" method="POST" action="{{ route('logout') }}">
@csrf
<button>Logout</button>
</form>
</div>

<div class="menu">
<div class="card">
<h2>🛠 Admin</h2>
<p>Kelola Produk & Kategori.</p>
<a href="/admin" class="btn">Buka Admin</a>
</div>

<div class="card">
<h2>💰 Kasir</h2>
<p>Transaksi Penjualan.</p>
<a href="/kasir" class="btn">Buka Kasir</a>
</div>

<div class="card">
<h2>🛒 Pelanggan</h2>
<p>Lihat Halaman Pelanggan.</p>
<a href="/pelanggan" class="btn">Buka Pelanggan</a>
</div>

<div class="card">
<h2>📊 Laporan</h2>
<p>Laporan Penjualan.</p>
<a href="{{ route('laporan.index') }}" class="btn">Lihat</a>
</div>

</div>
</div>

</body>
</html>