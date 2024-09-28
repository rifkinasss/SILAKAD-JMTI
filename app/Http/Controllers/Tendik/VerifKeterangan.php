<?php

namespace App\Http\Controllers\Tendik;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\KetTelahTugasAkhir;
use App\Mail\Tolak\KetTelahTATolak;
use App\Mail\Proses\KetTelahTAProses;
use App\Mail\Terima\KetTelahTATerima;
use App\Mail\Selesai\KetTelahTASelesai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifKeterangan extends Controller
{
    public function indexTelahTugasAkhir()
    {
        $telahTA = KetTelahTugasAkhir::all();
        $title = 'Verifikasi Keterangan Data Tugas Akhir';
        return view('tendik.verifikasi.keterangan.telah_tugas_akhir', compact('title', 'telahTA'));
    }

    public function showTelahTugasAkhir($id)
    {
        $telahTA = KetTelahTugasAkhir::find($id);
        $title = 'Verifikasi Keterangan Data Tugas Akhir';
        return view('tendik.verifikasi.keterangan.detail_telah_TA', compact('title', 'telahTA'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $telahTA = KetTelahTugasAkhir::find($id);
        $verified = Auth::user()->nama_lengkap;

        if ($request->has('diterima')) {
            $telahTA->update([
                'status' => 'diterima',
                'keterangan' => 'Data sedang diverifikasi oleh ' . $verified
            ]);
            $this->logActivityTelahTA($telahTA, 'diterima', 'Data sedang diverifikasi' . $verified);
            Mail::to($telahTA->user->email)->send(new KetTelahTATerima($telahTA));
        } elseif ($request->has('diproses')) {
            if ($telahTA->status === 'status') {
                $telahTA->update([
                    'nomor_surat' => $request->nomor_surat,
                    'status' => 'diterima',
                    'keterangan' => 'Permohonan diterima'
                ]);
                $this->logActivityTelahTA($telahTA, 'diproses', 'Permohonan sedang di proses');
                Mail::to($telahTA->user->email)->send(new KetTelahTAProses($telahTA));
                $this->generateWord($id);
            } else {
                return redirect()->route('VeriftelahTA')->with('error', 'Status permohonan harus sedang diverifikasi untuk dapat diterima.');
            }
        } elseif ($request->has('ditolak')) {
            $keterangan = $request->keterangan;
            $telahTA->update([
                'status' => 'ditolak',
                'keterangan' => $keterangan
            ]);
            $this->logActivityTelahTA($telahTA, 'ditolak', $keterangan);
            Mail::to($telahTA->user->email)->send(new KetTelahTATolak($telahTA));
        } elseif ($request->has('selesai')) {
            $telahTA->update([
                'status' => 'selesai',
                'keterangan' => 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.'
            ]);
            $this->logActivityTelahTA($telahTA, 'selesai', 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.');
            Mail::to($telahTA->user->email)->send(new KetTelahTASelesai($telahTA));
        }

        return redirect()->route('VeriftelahTA')->with('success', 'Status permohonan telah diperbarui.');
    }

    public function generateWordTelahTA($id)
    {
        $telahTA = KetTelahTugasAkhir::findOrFail($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/Ket_Telah_TA.docx'));

        $templateProcessor->setValue('nomor_surat', $telahTA->nomor_surat);
        $templateProcessor->setValue('nama_lengkap', $telahTA->user->nama_lengkap);
        $templateProcessor->setValue('nim', $telahTA->user->nim);
        $templateProcessor->setValue('semester', $telahTA->user->semester);
        $templateProcessor->setValue('program_studi', $telahTA->user->program_studi);
        $templateProcessor->setValue('judul_tugas_akhir', $telahTA->judul_tugas_akhir);
        $templateProcessor->setValue('dosen_pembimbing_utama', $telahTA->dosen_pembimbing_utama);
        $templateProcessor->setValue('dosen_pembimbing_pendamping', $telahTA->dosen_pembimbing_pendamping);

        $fileName = 'telahTA_' . $telahTA->user->nim . '.docx';
        $filePath = storage_path('app/public/document/Keterangan_Telah_TA/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadWordTelahTA($id)
    {
        $telahTA = KetTelahTugasAkhir::findOrFail($id);
        $fileName = 'telahTA_' . $telahTA->user->nim . '.docx';
        $filePath = public_path('storage/document/Keterangan_Telah_TA/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    protected function logActivityTelahTA($telahTA, $status, $keterangan)
    {
        ActivityLog::create([
            'user_id' => $telahTA->user_id,
            'jenis_layanan' => 'Keterangan Telah Tugas Akhir',
            'ket_telah_tugas_akhir_id' => $telahTA->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'timestamp' => now(),
        ]);
    }
}
