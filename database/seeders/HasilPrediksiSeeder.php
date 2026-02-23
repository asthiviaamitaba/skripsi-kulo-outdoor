<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\HasilPrediksi;
use Illuminate\Support\Facades\DB;

class HasilPrediksiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil total jumlah per barang per bulan
        $data = Transaksi::select(
                'nama_barang',
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total_jumlah')
            )
            ->groupBy('nama_barang', 'bulan')
            ->get();

        $allJumlah = $data->pluck('total_jumlah');

        $mean = $allJumlah->avg();
        $std = sqrt($allJumlah->map(fn($x) => pow($x - $mean, 2))->avg());

        foreach ($data as $item) {

            $jumlah = $item->total_jumlah;

            if ($jumlah < ($mean - $std)) {
                $kategori = 'Rendah';
            } elseif ($jumlah > ($mean + $std)) {
                $kategori = 'Tinggi';
            } else {
                $kategori = 'Sedang';
            }

            HasilPrediksi::create([
                'nama_barang' => $item->nama_barang,
                'bulan' => $item->bulan,
                'prediksi_jumlah' => $jumlah,
                'kategori_prediksi' => $kategori,
            ]);
        }

    }
}
