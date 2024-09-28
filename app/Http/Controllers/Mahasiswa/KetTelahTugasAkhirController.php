<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\ActivityLog;
use App\Mail\MailKetTelahTA;
use App\Mail\Pesan\Otomatis;
use Illuminate\Http\Request;
use App\Models\KetTelahTugasAkhir;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class KetTelahTugasAkhirController extends Controller
{
    public function index()
    {
        $title = 'Keterangan Telah Tugas Akhir';
        return view('mahasiswa.keterangan.telah_tugas_akhir', compact('title'));
    }

    public function store(Request $request)
    {
        try {

            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->update([
                'semester' => $request->semester,
            ]);

            $KetTelahTA = KetTelahTugasAkhir::create([
                'user_id' => Auth::id(),
                'judul_tugas_akhir' => $request->judul_tugas_akhir,
                'nama_pembimbing_utama' => $request->nama_pembimbing_utama,
                'nama_pembimbing_pendamping' => $request->nama_pembimbing_pendamping,
            ]);

            $data_id = $KetTelahTA->id;

            ActivityLog::create([
                'user_id' => $user_id,
                'jenis_layanan' => 'Keterangan Telah Tugas Akhir',
                'ket_telah_tugas_akhir_id' => $data_id,
                'status' => 'pending',
                'keterangan' => 'Keterangan Telah Tugas Akhir diajukan',
            ]);

            $tendik = User::where('role', 'tendik')->get();

            foreach ($tendik as $user) {
                Mail::to($user->email)->send(new MailKetTelahTA($KetTelahTA));
            }

            return redirect()->route('mahasiswa')->with('success', 'Pembuatan Surat Keterangan Telah Tugas Akhir dengan lama proses pembuatan surat maksimal 2x24 jam di hari kerja.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa')->with('error', 'Gagal membuat Pembuatan Surat Keterangan Telah Tugas Akhir: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $ketTelahTA = KetTelahTugasAkhir::findOrFail($id);
        $ketTelahTA->status = $request->status;
        $ketTelahTA->keterangan = $request->keterangan;
        $ketTelahTA->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
