<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPrediksi extends Model
{
    protected $fillable = [
        'nama_barang',
        'bulan',
        'prediksi_jumlah',
        'kategori_prediksi'
    ];
}
