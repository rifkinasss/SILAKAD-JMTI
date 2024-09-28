<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\ActivityLog;
use App\Models\DataMataKuliah;
use App\Models\DataTugasAkhir;
use App\Models\RekomendasiLomba;
use App\Models\KetTelahTugasAkhir;
use App\Models\RekomendasiBeasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        // Pending
        $pending_matkul = DataMataKuliah::where('status', 'pending')->where('user_id', $user)->count();
        $pending_ta = DataTugasAkhir::where('status', 'pending')->where('user_id', $user)->count();
        $pending_ketta = KetTelahTugasAkhir::where('status', 'pending')->where('user_id', $user)->count();
        $pending_rekombe = RekomendasiBeasiswa::where('status', 'pending')->where('user_id', $user)->count();
        $pending_rekomlo = RekomendasiLomba::where('status', 'pending')->where('user_id', $user)->count();
        $total_pending = $pending_matkul + $pending_ta + $pending_ketta + $pending_rekombe + $pending_rekomlo;

        // Di terima
        $diproses_matkul = DataMataKuliah::where('status', 'sedang diverifikasi')->where('user_id', $user)->count();
        $diproses_ta = DataTugasAkhir::where('status', 'sedang diverifikasi')->where('user_id', $user)->count();
        $diproses_ketta = KetTelahTugasAkhir::where('status', 'sedang diverifikasi')->where('user_id', $user)->count();
        $diproses_rekombe = RekomendasiBeasiswa::where('status', 'sedang diverifikasi')->where('user_id', $user)->count();
        $diproses_rekomlo = RekomendasiLomba::where('status', 'sedang diverifikasi')->where('user_id', $user)->count();
        $total_diproses = $diproses_matkul + $diproses_ta + $diproses_ketta + $diproses_rekombe + $diproses_rekomlo;

        // Di terima
        $diterima_matkul = DataMataKuliah::where('status', 'diterima')->where('user_id', $user)->count();
        $diterima_ta = DataTugasAkhir::where('status', 'diterima')->where('user_id', $user)->count();
        $diterima_ketta = KetTelahTugasAkhir::where('status', 'diterima')->where('user_id', $user)->count();
        $diterima_rekombe = RekomendasiBeasiswa::where('status', 'diterima')->where('user_id', $user)->count();
        $diterima_rekomlo = RekomendasiLomba::where('status', 'diterima')->where('user_id', $user)->count();
        $total_diterima = $diterima_matkul + $diterima_ta + $diterima_ketta + $diterima_rekombe + $diterima_rekomlo;

        //Ditolak
        $ditolak_matkul = DataMataKuliah::where('status', 'ditolak')->where('user_id', $user)->count();
        $ditolak_ta = DataTugasAkhir::where('status', 'ditolak')->where('user_id', $user)->count();
        $ditolak_ketta = KetTelahTugasAkhir::where('status', 'ditolak')->where('user_id', $user)->count();
        $ditolak_rekombe = RekomendasiBeasiswa::where('status', 'ditolak')->where('user_id', $user)->count();
        $ditolak_rekomlo = RekomendasiLomba::where('status', 'ditolak')->where('user_id', $user)->count();
        $total_ditolak = $ditolak_matkul + $ditolak_ta + $ditolak_ketta + $ditolak_rekombe + $ditolak_rekomlo;

        $total_selesai = $total_diterima + $total_ditolak;

        $riwayat_datamatkul = DataMataKuliah::where('user_id', $user)->get();
        $riwayat_dataTA = DataTugasAkhir::where('user_id', $user)->get();
        $riwayat_telahTA = KetTelahTugasAkhir::where('user_id', $user)->get();
        $riwayat_rekombe = RekomendasiBeasiswa::where('user_id', $user)->get();
        $riwayat_rekomlo = RekomendasiLomba::where('user_id', $user)->get();

        $all_riwayat = $riwayat_datamatkul
            ->concat($riwayat_dataTA)
            ->concat($riwayat_telahTA)
            ->concat($riwayat_rekombe)
            ->concat($riwayat_rekomlo);

        // $defaultRiwayat = $all_riwayat->first();
        // $defaultId = $defaultRiwayat->id ?? 1;
        // $defaultJenisLayanan = $defaultRiwayat->jenis_layanan ?? 'Data Mata Kuliah';

        // $activityLogs = ActivityLog::where('jenis_layanan', $defaultJenisLayanan)
        //     ->where('data_mata_kuliah_id', $defaultId)
        //     ->get();

        $logs = ActivityLog::all();
        $latestLog = $logs->last();
        $latestLogKey = $latestLog ? $latestLog->getKey() : null;

        // $latestLog = $activityLogs->sortBy('created_at');

        $title = 'Dashboard Mahasiswa';

        return view('mahasiswa.dashboard', compact('title', 'total_pending', 'total_diproses', 'total_diterima', 'total_ditolak', 'total_selesai', 'logs', 'latestLogKey', 'all_riwayat'));
    }

    public function filterActivityLogs(Request $request)
    {
        $jenis_layanan = $request->input('jenis_layanan');
        $id = $request->input('id');

        $activityLogs = ActivityLog::where(function ($query) use ($jenis_layanan, $id) {
            $query->where('jenis_layanan', $jenis_layanan)
                ->where('data_mata_kuliah_id', $id)
                ->orWhere('data_tugas_akhir_id', $id)
                ->orWhere('ket_telah_tugas_akhir_id', $id)
                ->orWhere('rekomendasi_beasiswa_id', $id)
                ->orWhere('rekomendasi_lomba_id', $id);
        })->get();

        return response()->json($activityLogs);
    }
}
