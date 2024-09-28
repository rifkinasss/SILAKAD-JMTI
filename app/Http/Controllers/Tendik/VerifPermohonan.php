<?php

namespace App\Http\Controllers\Tendik;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\DataMataKuliah;
use App\Models\DataTugasAkhir;
use App\Mail\Tolak\DataTATolak;
use App\Mail\Proses\DataTAProses;
use App\Mail\Terima\DataTATerima;
use App\Mail\Selesai\DataTASelesai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Tolak\DataMatkulTolak;
use App\Mail\Proses\DataMatkulProses;
use App\Mail\Terima\DataMatkulTerima;
use App\Mail\Selesai\DataMatkulSelesai;

class VerifPermohonan extends Controller
{
    public function indexDataTugasAkhir()
    {
        $dataTA = DataTugasAkhir::all();
        $title = 'Verifikasi Permohonan Data Tugas Akhir';
        return view('tendik.verifikasi.permohonan.data_tugas_akhir', compact('title', 'dataTA'));
    }

    public function showDataTugasAkhir($id)
    {
        $dataTA = DataTugasAkhir::find($id);
        $title = 'Verifikasi Permohonan Data Tugas Akhir';
        return view('tendik.verifikasi.permohonan.detail_data_tugas_akhir', compact('title', 'dataTA'));
    }

    public function updateStatusDataTA(Request $request, string $id)
    {
        $dataTugasAkhir = DataTugasAkhir::find($id);
        $verified = Auth::user()->nama_lengkap;

        if ($request->has('diterima')) {
            $dataTugasAkhir->update([
                'status' => 'diterima',
                'keterangan' => 'Data sedang diverifikasi' . $verified
            ]);
            $this->logActivityTA($dataTugasAkhir, 'diterima', 'Data sedang diverifikasi ' . $verified);
            Mail::to($dataTugasAkhir->user->email)->send(new DataTATerima($dataTugasAkhir));
        } elseif ($request->has('diproses')) {
            if ($dataTugasAkhir->status === 'diterima') {
                $dataTugasAkhir->update([
                    'nomor_surat' => $request->nomor_surat,
                    'status' => 'diproses',
                    'keterangan' => 'Permohonan sedang di proses'
                ]);
                $this->logActivityTA($dataTugasAkhir, 'diproses', 'Permohonan sedang di proses');
                Mail::to($dataTugasAkhir->user->email)->send(new DataTAProses($dataTugasAkhir));
                $this->generateWordTA($id);
            } else {
                return redirect()->route('VerifdataTA')->with('error', 'Status permohonan harus diterima untuk dapat diproses.');
            }
        } elseif ($request->has('ditolak')) {
            $keterangan = $request->keterangan;
            $dataTugasAkhir->update([
                'status' => 'ditolak',
                'keterangan' => $keterangan
            ]);
            $this->logActivityTA($dataTugasAkhir, 'ditolak', $keterangan);
            Mail::to($dataTugasAkhir->user->email)->send(new DataTATolak($dataTugasAkhir));
        } elseif ($request->has('selesai')) {
            $dataTugasAkhir->update([
                'status' => 'selesai',
                'keterangan' => 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.'
            ]);
            $this->logActivityTA($dataTugasAkhir, 'selesai', 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.');
            Mail::to($dataTugasAkhir->user->email)->send(new DataTASelesai($dataTugasAkhir));
        }


        return redirect()->route('VerifdataTA')->with('success', 'Status permohonan telah diperbarui.');
    }

    public function generateWordTA($id)
    {
        $dataTugasAkhir = DataTugasAkhir::findOrFail($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/Data_Tugas_Akhir.docx'));

        $templateProcessor->setValue('nomor_surat', $dataTugasAkhir->nomor_surat);
        $templateProcessor->setValue('tanggal_surat', now()->format('d F Y'));
        $templateProcessor->setValue('nama_mitra', $dataTugasAkhir->nama_mitra);
        $templateProcessor->setValue('alamat_mitra', $dataTugasAkhir->alamat_mitra);
        $templateProcessor->setValue('nama_lengkap', $dataTugasAkhir->user->nama_lengkap);
        $templateProcessor->setValue('nim', $dataTugasAkhir->user->nim);
        $templateProcessor->setValue('program_studi', $dataTugasAkhir->user->program_studi);
        $templateProcessor->setValue('no_hp', $dataTugasAkhir->user->no_hp);
        $templateProcessor->setValue('tanggal_mulai', $dataTugasAkhir->tgl_mulai);
        $templateProcessor->setValue('tanggal_selesai', $dataTugasAkhir->tgl_akhir);
        $templateProcessor->setValue('data_yang_dibutuhkan', $dataTugasAkhir->data_yang_dibutuhkan);

        $fileName = 'DataTugasAkhir_' . $dataTugasAkhir->user->nim . '.docx';
        $filePath = storage_path('app/public/document/Data_Tugas_Akhir/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadWordTA($id)
    {
        $dataTugasAkhir = DataTugasAkhir::findOrFail($id);
        $fileName = 'DataTugasAkhir_' . $dataTugasAkhir->user->nim . '.docx';
        $filePath = public_path('storage/document/Data_Tugas_Akhir/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    protected function logActivityTA($dataTugasAkhir, $status, $keterangan)
    {
        ActivityLog::create([
            'user_id' => $dataTugasAkhir->user_id,
            'jenis_layanan' => 'Permohonan Data Tugas Akhir',
            'data_tugas_akhir_id' => $dataTugasAkhir->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'timestamp' => now(),
        ]);
    }

    public function indexDataMataKuliah()
    {
        $dataMatkul = DataMataKuliah::all();
        $title = 'Verifikasi Permohonan Data Tugas Akhir';
        return view('tendik.verifikasi.permohonan.data_mata_kuliah', compact('title', 'dataMatkul'));
    }

    public function showDataMataKuliah($id)
    {
        $dataMatkul = DataMataKuliah::find($id);
        $title = 'Verifikasi Permohonan Data Tugas Akhir';
        return view('tendik.verifikasi.permohonan.detail_data_mata_kuliah', compact('title', 'dataMatkul'));
    }
    public function updateStatusDataMatkul(Request $request, string $id)
    {
        $dataMataKuliah = DataMataKuliah::find($id);
        $verified = Auth::user()->nama_lengkap;

        if ($request->has('diterima')) {
            $dataMataKuliah->update([
                'status' => 'diterima',
                'keterangan' => 'Data sedang diverifikasi' . $verified
            ]);
            $this->logActivityMatkul($dataMataKuliah, 'sedang diverifikasi', 'Data sedang diverifikasi' . $verified);
            Mail::to($dataMataKuliah->user->email)->send(new DataMatkulTerima($dataMataKuliah));
        } elseif ($request->has('diproses')) {
            if ($dataMataKuliah->status === 'diterima') {
                $dataMataKuliah->update([
                    'nomor_surat' => $request->nomor_surat,
                    'status' => 'diproses',
                    'keterangan' => 'Permohonan diposes'
                ]);
                $this->logActivityMatkul($dataMataKuliah, 'diproses', 'Permohonan Sedang diposes');
                Mail::to($dataMataKuliah->user->email)->send(new DataMatkulProses($dataMataKuliah));
                $this->generateWord($id);
            } else {
                return redirect()->route('VerifdataTA')->with('error', 'Status permohonan harus sedang diterima untuk dapat diterima.');
            }
        } elseif ($request->has('ditolak')) {
            $keterangan = $request->keterangan;
            $dataMataKuliah->update([
                'status' => 'ditolak',
                'keterangan' => $keterangan
            ]);
            $this->logActivityMatkul($dataMataKuliah, 'ditolak', $keterangan);
            Mail::to($dataMataKuliah->user->email)->send(new DataMatkulTolak($dataMataKuliah));
        } elseif ($request->has('selesai')) {
            $dataMataKuliah->update([
                'status' => 'selesai',
                'keterangan' => 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.'
            ]);
            $this->logActivityMatkul($dataMataKuliah, 'selesai', 'Permohonan Telah Selesai. Silakan mengambil dokumen di ruang jurusan B205.');
            Mail::to($dataMataKuliah->user->email)->send(new DataMatkulSelesai($dataMataKuliah));
        }

        return redirect()->route('VerifdataMatkul')->with('success', 'Status permohonan telah diperbarui.');
    }

    public function generateWordMatkul($id)
    {
        $dataTugasAkhir = DataTugasAkhir::findOrFail($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/templates/Data_Mata_Kuliah.docx'));

        $templateProcessor->setValue('nomor_surat', $dataTugasAkhir->nomor_surat);
        $templateProcessor->setValue('tanggal_surat', now()->format('d F Y'));
        $templateProcessor->setValue('nama_mitra', $dataTugasAkhir->nama_mitra);
        $templateProcessor->setValue('alamat_mitra', $dataTugasAkhir->alamat_mitra);
        $templateProcessor->setValue('nama_ketua', $dataTugasAkhir->user->nama_lengkap);
        $templateProcessor->setValue('nim_ketua', $dataTugasAkhir->user->nim);
        $templateProcessor->setValue('email_ketua', $dataTugasAkhir->user->email);
        $templateProcessor->setValue('nama_anggota_1', $dataTugasAkhir->nama_anggota_1);
        $templateProcessor->setValue('nama_anggota_2', $dataTugasAkhir->nama_anggota_2);
        $templateProcessor->setValue('nama_anggota_3', $dataTugasAkhir->nama_anggota_3);
        $templateProcessor->setValue('nama_anggota_4', $dataTugasAkhir->nama_anggota_4);
        $templateProcessor->setValue('nim_2', $dataTugasAkhir->nim_anggota_2);
        $templateProcessor->setValue('nim_3', $dataTugasAkhir->nim_anggota_3);
        $templateProcessor->setValue('nim_4', $dataTugasAkhir->nim_anggota_4);
        $templateProcessor->setValue('program_studi', $dataTugasAkhir->user->program_studi);
        $templateProcessor->setValue('no_hp', $dataTugasAkhir->user->no_hp);
        $templateProcessor->setValue('tanggal_mulai', $dataTugasAkhir->tgl_mulai);
        $templateProcessor->setValue('tanggal_selesai', $dataTugasAkhir->tgl_akhir);
        $templateProcessor->setValue('data_yang_dibutuhkan', $dataTugasAkhir->data_yang_dibutuhkan);

        $fileName = 'DataTugasAkhir_' . $dataTugasAkhir->user->nim . '.docx';
        $filePath = storage_path('app/public/document/Data_Tugas_Akhir/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadWordMatkul($id)
    {
        $dataTugasAkhir = DataTugasAkhir::findOrFail($id);
        $fileName = 'DataTugasAkhir_' . $dataTugasAkhir->user->nim . '.docx';
        $filePath = public_path('storage/document/Data_Mata_Kuliah/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    protected function logActivityMatkul($dataMataKuliah, $status, $keterangan)
    {
        ActivityLog::create([
            'user_id' => $dataMataKuliah->user_id,
            'jenis_layanan' => 'Permohonan Data Mata Kuliah',
            'data_mata_kuliah_id' => $dataMataKuliah->id,
            'status' => $status,
            'keterangan' => $keterangan,
            'timestamp' => now(),
        ]);
    }
}
