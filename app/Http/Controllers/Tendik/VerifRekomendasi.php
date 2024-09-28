<?php

namespace App\Http\Controllers\Tendik;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\RekomendasiLomba;
use App\Models\RekomendasiBeasiswa;
use App\Mail\Tolak\RekomendasiBeasiswaTolak;
use App\Mail\Proses\RekomendasiBeasiswaProses;
use App\Mail\Terima\RekomendasiBeasiswaTerima;
use App\Mail\Selesai\RekomendasiBeasiswaSelesai;
use App\Mail\Tolak\RekomendasiLombaTolak;
use App\Mail\Proses\RekomendasiLombaProses;
use App\Mail\Terima\RekomendasiLombaTerima;
use App\Mail\Selesai\RekomendasiLombaSelesai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VerifRekomendasi extends Controller
{
    public function indexlomba()
    {
        $data_lomba = RekomendasiLomba::all();
        $title = 'Verifikasi Rekomendasi Lomba';
        return view('tendik.verifikasi.Rekomendasi.lomba', compact('title', 'data_lomba'));
    }

    public function showlomba($id)
    {
        $data_lomba = RekomendasiLomba::find($id);
        $title = 'Verifikasi Rekomendasi Lomba';
        return view('tendik.verifikasi.Rekomendasi.detail_lomba', compact('title', 'data_lomba'));
    }
    public function updateStatuslomba(Request $request, string $id)
    {
        $lomba = Rekomendasilomba::find($id);
        $verified = Auth::user()->nama_lengkap;

        if ($request->has('diterima')) {
            $lomba->update([
                'status' => 'sedang diterima',
                'keterangan' => 'Data sedang diverifikasi oleh' . $verified
            ]);
            $this->logActivitylomba($lomba, 'sedang diverifikasi', 'Data sedang diverifikasi oleh' . $verified);
            Mail::to($lomba->user->email)->send(new RekomendasilombaTerima($lomba));
        } elseif ($request->has('diproses')) {
            if ($lomba->status === 'diterima') {
                $lomba->update([
                    'nomor_surat' => $request->nomor_surat,
                    'status' => 'diproses',
                    'keterangan' => 'Permohonan sedang di proses oleh' . $verified
                ]);
                $this->logActivitylomba($lomba, 'diproses', 'Permohonan sedang di proses oleh' . $verified);
                Mail::to($lomba->user->email)->send(new RekomendasiLombaProses($lomba));
                $this->generateWord($id);
            } else {
                return redirect()->route('Verifbeasiswa')->with('error', 'Status permohonan harus sedang diverifikasi untuk dapat diterima.');
            }
        } elseif ($request->has('ditolak')) {
            $keterangan = $request->keterangan;
            $lomba->update([
                'status' => 'ditolak',
                'keterangan' => $keterangan
            ]);
            $this->logActivitylomba($lomba, 'ditolak', $keterangan);
            Mail::to($lomba->user->email)->send(new RekomendasiLombaTolak($lomba));
        } elseif ($request->has('selesai')) {
            $lomba->update([
                'status' => 'selesai',
                'keterangan' => 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.'
            ]);
            $this->logActivityTA($lomba, 'selesai', 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.');
            Mail::to($lomba->user->email)->send(new RekomendasiLombaSelesai($lomba));
        }

        return redirect()->route('Veriflomba')->with('success', 'Status permohonan telah diperbarui.');
    }

    public function generateWordLomba($id)
    {
        $lomba = Rekomendasilomba::findOrFail($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/Rekomendasi_Lomba.docx'));

        $templateProcessor->setValue('nomor_surat', $lomba->nomor_surat);
        $templateProcessor->setValue('tanggal_surat', now()->format('d F Y'));
        $templateProcessor->setValue('nama_lengkap', $lomba->user->nama_lengkap);
        $templateProcessor->setValue('nim', $lomba->user->nim);
        $templateProcessor->setValue('program_studi', $lomba->user->program_studi);
        $templateProcessor->setValue('semester', $lomba->user->semester);
        $templateProcessor->setValue('ipk', $lomba->user->ipk);
        $templateProcessor->setValue('nama_program', $lomba->nama_program);

        $fileName = 'RekomendasiLomba_' . $lomba->user->nim . '.docx';
        $filePath = storage_path('app/public/document/Rekomendasi_Lomba/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadWordLomba($id)
    {
        $lomba = Rekomendasilomba::findOrFail($id);
        $fileName = 'RekomendasiLomba_' . $lomba->user->nim . '.docx';
        $filePath = public_path('storage/document/Rekomendasi_Lomba/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    protected function logActivitylomba($lomba, $status, $keterangan)
    {
        ActivityLog::create([
            'user_id' => $lomba->user_id,
            'jenis_layanan' => 'Rekomendasi Lomba',
            'rekomendasi_lomba_id' => $lomba->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'timestamp' => now(),
        ]);
    }

    public function indexbeasiswa()
    {
        $data_beasiswa = RekomendasiBeasiswa::all();
        $title = 'Verifikasi Rekomendasi beasiswa';
        return view('tendik.verifikasi.Rekomendasi.beasiswa', compact('title', 'data_beasiswa'));
    }

    public function showbeasiswa($id)
    {
        $data_beasiswa = RekomendasiBeasiswa::find($id);
        $title = 'Verifikasi Rekomendasi beasiswa';

        return view('tendik.verifikasi.Rekomendasi.detail_beasiswa', compact('title', 'data_beasiswa'));
    }

    public function updateStatusbeasiswa(Request $request, string $id)
    {
        $beasiswa = RekomendasiBeasiswa::find($id);
        $verified = Auth::user()->nama_lengkap;

        if ($request->has('diterima')) {
            $beasiswa->update([
                'status' => 'diterima',
                'keterangan' => 'Data sedang diverifikasi oleh' . $verified
            ]);
            $this->logActivitybeasiswa($beasiswa, 'sedang diverifikasi', 'Data sedang diverifikasi' . $verified);
            Mail::to($beasiswa->user->email)->send(new RekomendasiBeasiswaTerima($beasiswa));
        } elseif ($request->has('diproses')) {
            if ($beasiswa->status === 'diterima') {
                $beasiswa->update([
                    'nomor_surat' => $request->nomor_surat,
                    'status' => 'diproses',
                    'keterangan' => 'Permohonan sedang diproses oleh' . $verified
                ]);
                $this->logActivitybeasiswa($beasiswa, 'diproses', 'Permohonan sedang diposes oleh' . $verified);
                Mail::to($beasiswa->user->email)->send(new RekomendasiBeasiswaProses($beasiswa));
                $this->generateWordBeasiswa($id);
            } else {
                return redirect()->route('Verifbeasiswa')->with('error', 'Status permohonan harus sedang diverifikasi untuk dapat diterima.');
            }
        } elseif ($request->has('ditolak')) {
            $keterangan = $request->keterangan;
            $beasiswa->update([
                'status' => 'ditolak',
                'keterangan' => $keterangan,
            ]);
            $this->logActivitybeasiswa($beasiswa, 'ditolak', $keterangan);
            Mail::to($beasiswa->user->email)->send(new RekomendasiBeasiswaTolak($beasiswa));
        } elseif ($request->has('selesai')) {
            $beasiswa->update([
                'status' => 'selesai',
                'keterangan' => 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.'
            ]);
            $this->logActivityTA($beasiswa, 'selesai', 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.');
            Mail::to($beasiswa->user->email)->send(new RekomendasiBeasiswaSelesai($beasiswa));
        }

        return redirect()->route('Verifbeasiswa')->with('success', 'Status permohonan telah diperbarui.');
    }

    public function generateWordBeasiswa($id)
    {
        $beasiswa = RekomendasiBeasiswa::findOrFail($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/Rekomendasi_Beasiswa.docx'));

        $templateProcessor->setValue('nomor_surat', $beasiswa->nomor_surat);
        $templateProcessor->setValue('tanggal_surat', now()->format('d F Y'));
        $templateProcessor->setValue('nama_lengkap', $beasiswa->user->nama_lengkap);
        $templateProcessor->setValue('nim', $beasiswa->user->nim);
        $templateProcessor->setValue('program_studi', $beasiswa->user->program_studi);
        $templateProcessor->setValue('semester', $beasiswa->user->semester);
        $templateProcessor->setValue('ipk', $beasiswa->user->ipk);
        $templateProcessor->setValue('nama_program', $beasiswa->nama_program);

        $fileName = 'RekomendasiBeasiswa_' . $beasiswa->user->nim . '.docx';
        $filePath = storage_path('app/public/document/Rekomendasi_Beasiswa/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadWordBeasiswa($id)
    {
        $beasiswa = RekomendasiBeasiswa::findOrFail($id);
        $fileName = 'RekomendasiBeasiswa_' . $beasiswa->user->nim . '.docx';
        $filePath = public_path('storage/document/Rekomendasi_Beasiswa/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    protected function logActivitybeasiswa($beasiswa, $status, $keterangan)
    {
        ActivityLog::create([
            'user_id' => $beasiswa->user_id,
            'jenis_layanan' => 'Permohonan Data Tugas Akhir',
            'rekomendasi_beasiswa_id' => $beasiswa->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'timestamp' => now(),
        ]);
    }
}
