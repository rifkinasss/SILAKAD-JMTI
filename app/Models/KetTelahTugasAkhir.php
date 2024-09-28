<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetTelahTugasAkhir extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'nomor_surat',
        'user_id',
        'judul_tugas_akhir',
        'nama_pembimbing_utama',
        'nama_pembimbing_pendamping',
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
