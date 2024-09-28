<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\DataMataKuliah;
use App\Mail\MailDataMataKuliah;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DataMataKuliahController extends Controller
{
    public function index()
    {
        $title = 'Permohonan Data Mata Kuliah';
        return view('mahasiswa.permohonan_data.mata_kuliah', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->update([
                'no_hp' => $request->no_hp,
            ]);

            $dataMataKuliah = DataMataKuliah::create([
                'user_id' => Auth::id(),
                'nama_anggota_1' => $request->nama1,
                'nama_anggota_2' => $request->nama2,
                'nama_anggota_3' => $request->nama3,
                'nama_anggota_4' => $request->nama4,
                'nim_anggota_1' => $request->nim1,
                'nim_anggota_2' => $request->nim2,
                'nim_anggota_3' => $request->nim3,
                'nim_anggota_4' => $request->nim4,
                'nama_mitra' => $request->nama_mitra,
                'alamat_mitra' => $request->alamat_mitra,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
                'nama_matkul' => $request->nama_matkul,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'data_yang_dibutuhkan' => $request->data_yang_dibutuhkan,
            ]);

            $data_id = $dataMataKuliah->id;

            ActivityLog::create([
                'user_id' => $user_id,
                'jenis_layanan' => 'Permohonan Data Mata Kuliah',
                'data_mata_kuliah_id' => $data_id,
                'status' => 'pending',
                'keterangan' => 'Permohonan Data Mata Kuliah diajukan',
            ]);

            $tendik = User::where('role', 'tendik')->get();

            foreach ($tendik as $user) {
                Mail::to($user->email)->send(new MailDataMataKuliah($dataMataKuliah));
            }

            return redirect()->route('mahasiswa')->with('success', 'Permohonan Data Mata Kuliah dengan lama proses pembuatan surat maksimal 2x24 jam di hari kerja.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa')->with('error', 'Gagal membuat Permohonan Data Mata Kuliah: ' . $e->getMessage());
        }
    }
    public function updateStatus(Request $request, $id)
    {
        $dataMataKuliah = DataMataKuliah::findOrFail($id);
        $dataMataKuliah->status = $request->status;
        $dataMataKuliah->keterangan = $request->keterangan;
        $dataMataKuliah->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
