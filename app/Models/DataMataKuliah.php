<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataMataKuliah extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'nama_anggota_1',
        'nama_anggota_2',
        'nama_anggota_3',
        'nama_anggota_4',
        'nim_anggota_1',
        'nim_anggota_2',
        'nim_anggota_3',
        'nim_anggota_4',
        'nama_mitra',
        'alamat_mitra',
        'tgl_mulai',
        'tgl_akhir',
        'nama_matkul',
        'data_yang_dibutuhkan',
        'dosen_pembimbing',
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
