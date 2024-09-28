<?php

namespace App\Http\Controllers\Tendik;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\DataMataKuliah;
use App\Models\DataTugasAkhir;
use App\Models\RekomendasiLomba;
use App\Models\KetTelahTugasAkhir;
use App\Models\RekomendasiBeasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {
        $total_user = user::count();
        // Pending
        $pending_matkul = DataMataKuliah::where('status', 'pending')->count();
        $pending_ta = DataTugasAkhir::where('status', 'pending')->count();
        $pending_ketta = KetTelahTugasAkhir::where('status', 'pending')->count();
        $pending_rekombe = RekomendasiBeasiswa::where('status', 'pending')->count();
        $pending_rekomlo = RekomendasiLomba::where('status', 'pending')->count();
        $total_pending = $pending_matkul + $pending_ta + $pending_ketta + $pending_rekombe + $pending_rekomlo;

        // Di terima
        $diproses_matkul = DataMataKuliah::where('status', 'diproses')->count();
        $diproses_ta = DataTugasAkhir::where('status', 'diproses')->count();
        $diproses_ketta = KetTelahTugasAkhir::where('status', 'diproses')->count();
        $diproses_rekombe = RekomendasiBeasiswa::where('status', 'diproses')->count();
        $diproses_rekomlo = RekomendasiLomba::where('status', 'diproses')->count();
        $total_diproses = $diproses_matkul + $diproses_ta + $diproses_ketta + $diproses_rekombe + $diproses_rekomlo;

        // Di terima
        $diterima_matkul = DataMataKuliah::where('status', 'diterima')->count();
        $diterima_ta = DataTugasAkhir::where('status', 'diterima')->count();
        $diterima_ketta = KetTelahTugasAkhir::where('status', 'diterima')->count();
        $diterima_rekombe = RekomendasiBeasiswa::where('status', 'diterima')->count();
        $diterima_rekomlo = RekomendasiLomba::where('status', 'diterima')->count();
        $total_diterima = $diterima_matkul + $diterima_ta + $diterima_ketta + $diterima_rekombe + $diterima_rekomlo;

        //Ditolak
        $ditolak_matkul = DataMataKuliah::where('status', 'ditolak')->count();
        $ditolak_ta = DataTugasAkhir::where('status', 'ditolak')->count();
        $ditolak_ketta = KetTelahTugasAkhir::where('status', 'ditolak')->count();
        $ditolak_rekombe = RekomendasiBeasiswa::where('status', 'ditolak')->count();
        $ditolak_rekomlo = RekomendasiLomba::where('status', 'ditolak')->count();
        $total_ditolak = $ditolak_matkul + $ditolak_ta + $ditolak_ketta + $ditolak_rekombe + $ditolak_rekomlo;

        $selesai_matkul = DataMataKuliah::where('status', 'selesai')->count();
        $selesai_ta = DataTugasAkhir::where('status', 'selesai')->count();
        $selesai_ketta = KetTelahTugasAkhir::where('status', 'selesai')->count();
        $selesai_rekombe = RekomendasiBeasiswa::where('status', 'selesai')->count();
        $selesai_rekomlo = RekomendasiLomba::where('status', 'selesai')->count();
        $total_selesai = $selesai_matkul + $selesai_ta + $selesai_ketta + $selesai_rekombe + $selesai_rekomlo;

        $title = 'Dashboard Tendik';
        return view('tendik.dashboard', compact('title', 'total_pending', 'total_diproses', 'total_diterima', 'total_ditolak', 'total_selesai', 'total_user'));
    }
}
