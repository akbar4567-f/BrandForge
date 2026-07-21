<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'berat' => 'required|integer',
            'panjang' => 'required|integer',
            'lebar' => 'required|integer',
            'tinggi' => 'required|integer',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $namaFoto = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('produk'), $namaFoto);
        }

        Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('produk.index')
            ->with('success','Produk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();

        return view('admin.produk.edit', compact('produk','kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
       $request->validate([
        'kategori_id' => 'required',
        'nama_produk' => 'required',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'berat' => 'required|integer|min:0',
        'panjang' => 'required|integer|min:0',
        'lebar' => 'required|integer|min:0',
        'tinggi' => 'required|integer|min:0',
    ]);

        $namaFoto = $produk->foto;

        if($request->hasFile('foto'))
        {
            $namaFoto = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('produk'),$namaFoto);
        }

        $produk->update([
            'kategori_id'=>$request->kategori_id,
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$namaFoto,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('produk.index')
            ->with('success','Produk berhasil diubah.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success','Produk berhasil dihapus.');
    }
}