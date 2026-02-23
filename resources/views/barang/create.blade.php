@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
