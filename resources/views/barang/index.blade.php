@extends('layouts.dashboard')

@section('content')
<div class="container-fluid mt-4">

    <h2 class="mb-3">Data Barang</h2>

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
        Tambah Barang
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-success">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th width="10%">Stok</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategori }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang->id) }}"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <form action="{{ route('barang.destroy', $barang->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection