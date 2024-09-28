<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\DataTugasAkhir;
use App\Mail\MailDataTugasAkhir;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class DataTugasAkhirController extends Controller
{
    public function index()
    {
        $title = 'Permohonan Data Tugas Akhir';
        return view('mahasiswa.permohonan_data.tugas_akhir', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->update([
                'no_hp' => $request->no_hp,
            ]);

            $dataTugasAkhir = DataTugasAkhir::create([
                'user_id' => $user_id,
                'nama_mitra' => $request->nama_mitra,
                'alamat_mitra' => $request->alamat_mitra,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
                'judul_tugas_akhir' => $request->judul_tugas_akhir,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'data_yang_dibutuhkan' => $request->data_yang_dibutuhkan,
            ]);

            $data_id = $dataTugasAkhir->id;

            ActivityLog::create([
                'user_id' => $user_id,
                'jenis_layanan' => 'Permohonan Data Tugas Akhir',
                'data_tugas_akhir_id' => $data_id,
                'status' => 'pending',
                'keterangan' => 'Permohonan Data Tugas Akhir diajukan',
            ]);

            $tendik = User::where('role', 'tendik')->get();

            foreach ($tendik as $user) {
                Mail::to($user->email)->send(new MailDataTugasAkhir($dataTugasAkhir));
            }

            return redirect()->route('mahasiswa')->with('success', 'Permohonan Data Tugas Akhir telah diajukan. Mohon menunggu dengan lama proses pembuatan surat maksimal 2x24 jam di hari kerja.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa')->with('error', 'Gagal membuat Permohonan Data Tugas Akhir: ' . $e->getMessage());
        }
    }
}
