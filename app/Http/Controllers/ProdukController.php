<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
       $produks = Produk::with(['kategori','koleksi'])->latest()->get();
        return view('admin.produk.index', compact('produks'));
    }

   public function create()
    {
        $kategoris = Kategori::all();
        $koleksis = Koleksi::all();

        return view('admin.produk.create', compact('kategoris', 'koleksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'koleksi_id' => 'nullable|exists:koleksis,id',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto5' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

            $namaFoto2 = null;
            $namaFoto3 = null;
            $namaFoto4 = null;
            $namaFoto5 = null;

            if ($request->hasFile('foto2')) {
                $namaFoto2 = time().'_2.'.$request->foto2->extension();
                $request->foto2->move(public_path('produk'), $namaFoto2);
            }

            if ($request->hasFile('foto3')) {
                $namaFoto3 = time().'_3.'.$request->foto3->extension();
                $request->foto3->move(public_path('produk'), $namaFoto3);
            }

            if ($request->hasFile('foto4')) {
                $namaFoto4 = time().'_4.'.$request->foto4->extension();
                $request->foto4->move(public_path('produk'), $namaFoto4);
            }

            if ($request->hasFile('foto5')) {
                $namaFoto5 = time().'_5.'.$request->foto5->extension();
                $request->foto5->move(public_path('produk'), $namaFoto5);
            }

      Produk::create([
        'kategori_id' => $request->kategori_id,
        'koleksi_id' => $request->koleksi_id,

        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,

        'foto'  => $namaFoto,
        'foto2' => $namaFoto2,
        'foto3' => $namaFoto3,
        'foto4' => $namaFoto4,
        'foto5' => $namaFoto5,

        'berat' => $request->berat,
        'panjang' => $request->panjang,
        'lebar' => $request->lebar,
        'tinggi' => $request->tinggi,
    ]);
        return redirect()->route('produk.index')
            ->with('success','Produk berhasil ditambahkan.');
    }
    public function show(Produk $produk)
    {   
       //
    }   

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        $koleksis = Koleksi::all();

        return view('admin.produk.edit', compact(
            'produk',
            'kategoris',
            'koleksis'
        ));
    }

    public function update(Request $request, Produk $produk)
    {
       $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'koleksi_id' => 'nullable|exists:koleksis,id',
        'nama_produk' => 'required',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto5' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

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

        $namaFoto2 = $produk->foto2;
        $namaFoto3 = $produk->foto3;
        $namaFoto4 = $produk->foto4;
        $namaFoto5 = $produk->foto5;

        if ($request->hasFile('foto2')) {
            $namaFoto2 = time().'_2.'.$request->foto2->extension();
            $request->foto2->move(public_path('produk'), $namaFoto2);
        }

        if ($request->hasFile('foto3')) {
            $namaFoto3 = time().'_3.'.$request->foto3->extension();
            $request->foto3->move(public_path('produk'), $namaFoto3);
        }

        if ($request->hasFile('foto4')) {
            $namaFoto4 = time().'_4.'.$request->foto4->extension();
            $request->foto4->move(public_path('produk'), $namaFoto4);
        }

        if ($request->hasFile('foto5')) {
            $namaFoto5 = time().'_5.'.$request->foto5->extension();
            $request->foto5->move(public_path('produk'), $namaFoto5);
        }


        $produk->update([
            'kategori_id'=>$request->kategori_id,
            'koleksi_id' => $request->koleksi_id,
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$namaFoto,
            'foto2' => $namaFoto2,
            'foto3' => $namaFoto3,
            'foto4' => $namaFoto4,
            'foto5' => $namaFoto5,
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
        // Hapus foto utama
        if ($produk->foto && file_exists(public_path('produk/' . $produk->foto))) {
            unlink(public_path('produk/' . $produk->foto));
        }

        // Hapus foto2
        if ($produk->foto2 && file_exists(public_path('produk/' . $produk->foto2))) {
            unlink(public_path('produk/' . $produk->foto2));
        }

        // Hapus foto3
        if ($produk->foto3 && file_exists(public_path('produk/' . $produk->foto3))) {
            unlink(public_path('produk/' . $produk->foto3));
        }

        // Hapus foto4
        if ($produk->foto4 && file_exists(public_path('produk/' . $produk->foto4))) {
            unlink(public_path('produk/' . $produk->foto4));
        }

        // Hapus foto5
        if ($produk->foto5 && file_exists(public_path('produk/' . $produk->foto5))) {
            unlink(public_path('produk/' . $produk->foto5));
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}