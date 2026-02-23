<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\HasilPrediksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Total semua transaksi
        $totalTransaksi = Transaksi::count();

        // Total seluruh jumlah barang disewa
        $totalBarang = Transaksi::sum('jumlah');

        // Data prediksi untuk grafik
        $query = HasilPrediksi::query();

        if(request('bulan')) {
            $query->where('bulan', request('bulan'));
        }

        $prediksi = $query->orderBy('bulan')->get();


        $totalTransaksi = \App\Models\Transaksi::count();
        $totalBarang = \App\Models\Transaksi::sum('jumlah');
        $prediksi = \App\Models\HasilPrediksi::all();

        return view('dashboard', compact(
            'totalTransaksi',
            'totalBarang',
            'prediksi'
        ));

    }
}
