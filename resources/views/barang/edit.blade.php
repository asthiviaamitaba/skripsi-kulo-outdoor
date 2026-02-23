@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Data Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang"
                   class="form-control"
                   value="{{ $barang->nama_barang }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori"
                   class="form-control"
                   value="{{ $barang->kategori }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok"
                   class="form-control"
                   value="{{ $barang->stok }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('barang.index') }}"
           class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection