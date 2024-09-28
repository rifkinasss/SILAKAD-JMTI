<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\ActivityLog;
use App\Mail\Pesan\Otomatis;
use Illuminate\Http\Request;
use App\Models\RekomendasiLomba;
use App\Mail\MailRekomendasiLomba;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RekomendasiLombaController extends Controller
{
    public function index()
    {
        $title = 'Rekomendasi Lomba';
        return view('mahasiswa.rekomendasi.lomba', compact('title'));
    }

    public function store(Request $request)
    {
        try {

            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->update([
                'semester' => $request->semester,
                'ipk' => $request->ipk,
                'sks_tempuh' => $request->sks_tempuh,
            ]);

            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');
                $id = Auth::user()->id;
                $filename = $id . time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('lomba/screenshot', $filename, 'public');
            }
            if ($request->hasFile('transkrip_nilai')) {
                $file = $request->file('transkrip_nilai');
                $id = Auth::user()->id;
                $filename = $id . time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('lomba/transkrip_nilai', $filename, 'public');
            }
            if ($request->hasFile('format_khusus')) {
                $file = $request->file('format_khusus');
                $id = Auth::user()->id;
                $filename = $id . time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('lomba/format_khusus', $filename, 'public');
            }

            $rekomendasilomba = RekomendasiLomba::create([
                'user_id' => Auth::id(),
                'nama_program' => $request->nama_program,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'screenshot' => '/storage/' . $filePath,
                'transkrip_nilai' => '/storage/' . $filePath,
                'format_khusus' => '/storage/' . $filePath,
            ]);

            ActivityLog::create([
                'user_id' => $user_id,
                'jenis_layanan' => 'Rekomendasi Lomba',
                'layanan_id' => $rekomendasilomba->id,
                'status' => 'pending',
                'keterangan' => 'Rekomendasi Lomba diajukan',
            ]);

            $tendik = User::where('role', 'tendik')->get();

            foreach ($tendik as $user) {
                Mail::to($user->email)->send(new MailRekomendasiLomba($rekomendasilomba));
            }

            return redirect()->route('mahasiswa')->with('success', 'Pembuatan Surat Keterangan Telah Tugas Akhir dengan lama proses pembuatan surat maksimal 2x24 jam di hari kerja.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa')->with('error', 'Gagal membuat Pembuatan Surat Keterangan Telah Tugas Akhir: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $rekomendasiLomba = RekomendasiLomba::findOrFail($id);
        $rekomendasiLomba->status = $request->status;
        $rekomendasiLomba->keterangan = $request->keterangan;
        $rekomendasiLomba->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
