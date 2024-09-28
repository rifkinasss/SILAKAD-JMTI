<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'nim',
        'nama_lengkap',
        'email',
        'program_studi',
        'jurusan',
        'status',
        'semester',
        'ipk',
        'sks_tempuh',
        'no_hp',
        'role',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=mp';
    }

    public function DataMataKuliah()
    {
        return $this->hasMany(DataMataKuliah::class);
    }
    public function DataTugasAkhir()
    {
        return $this->hasMany(DataTugasAkhir::class);
    }
    public function KetTelahTugasAkhir()
    {
        return $this->hasMany(KetTelahTugasAkhir::class);
    }
    public function RekomendasiBeasiswa()
    {
        return $this->hasMany(RekomendasiBeasiswa::class);
    }
    public function RekomendasiLomba()
    {
        return $this->hasMany(RekomendasiLomba::class);
    }
}
