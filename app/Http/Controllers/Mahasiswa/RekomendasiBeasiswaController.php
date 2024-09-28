<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\RekomendasiBeasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRekomendasiBeasiswa;

class RekomendasiBeasiswaController extends Controller
{
    public function index()
    {
        $title = 'Rekomendasi Beasiswa';
        return view('mahasiswa.rekomendasi.beasiswa', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            // Ambil user yang sedang login
            $user_id = Auth::id();
            $user = User::find($user_id);
            $nim = Auth::user()->nim;

            // Update informasi user
            $user->update([
                'semester' => $request->semester,
                'ipk' => $request->ipk,
                'sks_tempuh' => $request->sks_tempuh,
            ]);

            // Variabel untuk menyimpan path file
            $screenshotPath = null;
            $transkripNilaiPath = null;
            $formatKhususPath = null;

            // Simpan file screenshot
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');
                $filename = $nim . '_' . time() . '_' . $file->getClientOriginalName();
                $screenshotPath = $file->storeAs('beasiswa/screenshot', $filename, 'public');
            }

            // Simpan file transkrip nilai
            if ($request->hasFile('transkrip_nilai')) {
                $file = $request->file('transkrip_nilai');
                $filename = $nim . '_'  . time() . '_' . $file->getClientOriginalName();
                $transkripNilaiPath = $file->storeAs('beasiswa/transkrip_nilai', $filename, 'public');
            }

            // Simpan file format khusus
            if ($request->hasFile('format_khusus')) {
                $file = $request->file('format_khusus');
                $filename = $nim . '_'  . time() . '_' . $file->getClientOriginalName();
                $formatKhususPath = $file->storeAs('beasiswa/format_khusus', $filename, 'public');
            }

            // Buat data RekomendasiBeasiswa
            $rekomendasibeasiswa = RekomendasiBeasiswa::create([
                'user_id' => $user_id,
                'nama_program' => $request->nama_program,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'screenshot' => $screenshotPath ? '/storage/' . $screenshotPath : null,
                'transkrip_nilai' => $transkripNilaiPath ? '/storage/' . $transkripNilaiPath : null,
                'format_khusus' => $formatKhususPath ? '/storage/' . $formatKhususPath : null,
            ]);

            // Buat data ActivityLog
            ActivityLog::create([
                'user_id' => $user_id,
                'jenis_layanan' => 'Rekomendasi Beasiswa',
                'rekomendasi_beasiswa_id' => $rekomendasibeasiswa->id,
                'status' => 'pending',
                'keterangan' => 'Rekomendasi Beasiswa diajukan',
            ]);

            // Kirim email ke semua pengguna dengan role tendik
            $tendik = User::where('role', 'tendik')->get();

            foreach ($tendik as $user) {
                Mail::to($user->email)->send(new MailRekomendasiBeasiswa($rekomendasibeasiswa));
            }

            // Redirect dengan pesan sukses
            return redirect()->route('mahasiswa')->with('success', 'Pembuatan Surat Keterangan Telah Tugas Akhir dengan lama proses pembuatan surat maksimal 2x24 jam di hari kerja.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika ada kesalahan
            return redirect()->route('mahasiswa')->with('error', 'Gagal membuat Pembuatan Surat Keterangan Telah Tugas Akhir: ' . $e->getMessage());
        }
    }


    public function updateStatus(Request $request, $id)
    {
        $rekomendasiBeasiswa = RekomendasiBeasiswa::findOrFail($id);
        $rekomendasiBeasiswa->status = $request->status;
        $rekomendasiBeasiswa->keterangan = $request->keterangan;
        $rekomendasiBeasiswa->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
