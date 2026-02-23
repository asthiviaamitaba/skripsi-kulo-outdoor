<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('data/hasil_prediksi_sistem.csv'), 'r');

        fgetcsv($file); // skip header

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {

            // Lewati baris kalau jumlah kosong atau bukan angka
            if (!isset($data[2]) || !is_numeric($data[2])) {
                continue;
            }

            Transaksi::create([
                'tanggal' => date('Y-m-d', strtotime($data[0])),
                'nama_barang' => $data[1],
                'jumlah' => (int) $data[2],
                'total' => 0
            ]);
        }


        fclose($file);
    }
}
