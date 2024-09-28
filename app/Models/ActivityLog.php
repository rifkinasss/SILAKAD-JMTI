<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'data_tugas_akhir_id',
        'data_mata_kuliah_id',
        'ket_telah_tugas_akhir_id',
        'rekomendasi_lomba_id',
        'rekomendasi_beasiswa_id',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataTugasAkhir()
    {
        return $this->belongsTo(DataTugasAkhir::class, 'data_tugas_akhir_id');
    }

    public function dataMataKuliah()
    {
        return $this->belongsTo(DataMataKuliah::class, 'data_mata_kuliah_id');
    }

    public function ketTelahTugasAkhir()
    {
        return $this->belongsTo(KetTelahTugasAkhir::class, 'ket_telah_tugas_akhir_id');
    }

    public function rekomendasiLomba()
    {
        return $this->belongsTo(RekomendasiLomba::class, 'rekomendasi_lomba_id');
    }

    public function rekomendasiBeasiswa()
    {
        return $this->belongsTo(RekomendasiBeasiswa::class, 'rekomendasi_beasiswa_id');
    }
}
