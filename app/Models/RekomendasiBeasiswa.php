<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekomendasiBeasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'nomor_surat',
        'user_id',
        'nama_program',
        'nama_perusahaan',
        'alamat_perusahaan',
        'screenshot',
        'transkrip_nilai',
        'format_khusus',
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
