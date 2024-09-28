<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTugasAkhir extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_tugas_akhirs';
    protected $fillable = [
        'user_id',
        'nomor_surat',
        'jenis_layanan',
        'nama_mitra',
        'alamat_mitra',
        'tgl_mulai',
        'tgl_akhir',
        'judul_tugas_akhir',
        'dosen_pembimbing',
        'data_yang_dibutuhkan',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ActivityLog()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
