<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $file = fopen(database_path('data/barang.csv'), 'r');

        fgetcsv($file); // skip header

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            Barang::create([
                'nama_barang' => $data[0],
                'kategori' => $data[1],
                'stok' => $data[2],
            ]);
        }

        fclose($file);
    }
}
