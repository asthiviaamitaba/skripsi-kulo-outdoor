<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PrediksiController extends Controller
{
    public function index()
    {
        $data = Barang::whereNotNull('kategori_asli')->get();

        $kelas = ['Rendah', 'Sedang', 'Tinggi'];
        $model = [];

        // =========================
        // TRAINING NAIVE BAYES
        // =========================
        foreach ($kelas as $k) {

            $subset = $data->where('kategori_asli', $k);

            $mean = $subset->avg('stok');
            $std = sqrt($subset->map(fn($x) => pow($x->stok - $mean, 2))->avg());

            $prior = count($subset) > 0 ? count($subset) / count($data) : 0;

            $model[$k] = [
                'mean' => $mean,
                'std' => $std == 0 ? 1 : $std,
                'prior' => $prior
            ];
        }

        $hasil = [];
        $benar = 0;

        // =========================
        // PREDIKSI NAIVE BAYES
        // =========================
        foreach ($data as $item) {

            $probabilitas = [];

            foreach ($kelas as $k) {

                $mean = $model[$k]['mean'];
                $std = $model[$k]['std'];
                $prior = $model[$k]['prior'];

                $likelihood = (1 / (sqrt(2 * pi()) * $std)) *
                    exp(-pow($item->stok - $mean, 2) / (2 * pow($std, 2)));

                $probabilitas[$k] = $likelihood * $prior;
            }

            arsort($probabilitas);
            $prediksi = array_key_first($probabilitas);

            if ($prediksi == $item->kategori_asli) {
                $benar++;
            }

            $hasil[] = [
                'nama_barang' => $item->nama_barang,
                'stok' => $item->stok,
                'prediksi' => $prediksi,
                'kategori_asli' => $item->kategori_asli
            ];
        }

        $total = count($data);
        $akurasi = $total > 0 ? ($benar / $total) * 100 : 0;

        return view('prediksi.index', compact(
            'hasil',
            'akurasi'
        ));
    }
}