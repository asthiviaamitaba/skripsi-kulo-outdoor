@php
\Carbon\Carbon::setLocale('id');
@endphp

@extends('layouts.dashboard')

@section('content')

<h3 class="mb-4">Dashboard</h3>

{{-- CARD STATISTIK --}}
<div class="row mb-4">

    <div class="col-md-6">
        <div class="card shadow p-3">
            <h6>Total Transaksi</h6>
            <h2>{{ $totalTransaksi }}</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-3">
            <h6>Total Barang Disewa</h6>
            <h2>{{ $totalBarang }}</h2>
        </div>
    </div>

</div>

{{-- GRAFIK --}}
<div class="card shadow p-4 mb-4">
    <h5>Grafik Prediksi Kebutuhan Stok</h5>
    <div style="height:400px;">
        <canvas id="prediksiChart"></canvas>
    </div>
</div>

{{-- TABEL --}}
<div id="hasil-prediksi" class="card shadow p-4">
    <h5>Hasil Prediksi</h5>

    {{-- FILTER BULAN (INI DI VIEW) --}}
    <form method="GET" action="{{ route('dashboard') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="bulan" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Bulan --</option>
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}"
                            {{ request('bulan') == $i ? 'selected' : '' }}>
                            Bulan {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">

            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Bulan</th>
                    <th>Prediksi</th>
                    <th>Kategori</th>
                </tr>
            </thead>

            <tbody>
                @foreach($prediksi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>
                        {{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}
                    </td>
                    <td>{{ $item->prediksi_jumlah }}</td>
                    <td>{{ $item->kategori_prediksi }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('prediksiChart').getContext('2d');

    if (!ctx) return;

    const labels = {!! json_encode($grafik->pluck('nama_barang')) !!};
const data = {!! json_encode($grafik->pluck('total')) !!};

    console.log("Labels:", labels);
    console.log("Data:", data);
    
    if (labels.length === 0) {
        console.log("Data prediksi kosong");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Prediksi',
                data: data,
                borderWidth: 2,
                tension: 0.3
            }]
        }
    });

});
</script>


@endsection
