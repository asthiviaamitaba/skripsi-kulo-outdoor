@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Ringkasan & Prediksi Stok (Naive Bayes)</h2>

    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Kategori Prediksi</th>
                <th>Kategori Asli</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['nama_barang'] }}</td>
                <td>{{ $item['stok'] }}</td>
                <td>
                    @if($item['prediksi'] == 'Rendah')
                        <span class="badge bg-danger">Rendah</span>
                    @elseif($item['prediksi'] == 'Tinggi')
                        <span class="badge bg-success">Tinggi</span>
                    @else
                        <span class="badge bg-warning text-dark">Sedang</span>
                    @endif
                </td>
                <td>{{ $item['kategori_asli'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card mt-4 shadow-sm">
        <div class="card-body text-center">
            <h5 class="mb-2">Akurasi Naive Bayes</h5>
            <h3 class="text-primary">{{ number_format($akurasi,2) }}%</h3>
        </div>
    </div>

</div>
@endsection

@extends('layouts.dashboard')


@section('content')
    isi halaman barang
@endsection
