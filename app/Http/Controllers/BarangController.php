<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'kategori' => 'required'
        ]);

        Barang::create($request->only('nama_barang','stok','kategori'));

        return redirect()->route('barang.index')
                         ->with('success','Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'kategori' => 'required'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->only('nama_barang','stok','kategori'));

        return redirect()->route('barang.index')
                         ->with('success','Data berhasil diubah');
    }

    public function destroy($id)
    {
        Barang::destroy($id);

        return redirect()->route('barang.index')
                         ->with('success','Data berhasil dihapus');
    }
}
