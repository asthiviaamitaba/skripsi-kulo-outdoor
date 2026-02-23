<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\HasilPrediksi;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {

    $bulan = $request->bulan;

    $totalTransaksi = Transaksi::count();
    $totalBarang = Transaksi::sum('jumlah');

    // HAPUS SEMUA DATA LAMA
//HasilPrediksi::truncate();

// AMBIL TOTAL TRANSAKSI PER BARANG PER BULAN
$data = Transaksi::selectRaw('nama_barang, MONTH(tanggal) as bulan, SUM(jumlah) as total')
    ->groupBy('nama_barang', 'bulan')
    ->get();


    $query = HasilPrediksi::query();

    if ($bulan) {
        $bulanFormat = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $query->where('bulan', $bulanFormat);
    }

    $prediksi = $query->get();

    $grafikQuery = Transaksi::selectRaw('nama_barang, SUM(jumlah) as total')
                ->groupBy('nama_barang')
                ->orderByDesc('total');

if ($bulan) {
    $grafikQuery->whereMonth('tanggal', $bulan);
}

$grafik = $grafikQuery->limit(5)->get();

    return view('dashboard', compact(
        'totalTransaksi',
        'totalBarang',
        'prediksi',
        'grafik'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('barang', BarangController::class);

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');

})->name('logout');

require __DIR__.'/auth.php';