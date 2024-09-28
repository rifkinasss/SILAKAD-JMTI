<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectToLogin;
use App\Http\Controllers\Tendik\VerifKeterangan;
use App\Http\Controllers\Tendik\VerifPermohonan;
use App\Http\Controllers\Tendik\VerifRekomendasi;
use App\Http\Controllers\Mahasiswa\DataMataKuliahController;
use App\Http\Controllers\Mahasiswa\DataTugasAkhirController;
use App\Http\Controllers\Mahasiswa\RekomendasiLombaController;
use App\Http\Controllers\Mahasiswa\KetTelahTugasAkhirController;
use App\Http\Controllers\Mahasiswa\RekomendasiBeasiswaController;
use App\Http\Controllers\Admin\DashController as AdminDashController;
use App\Http\Controllers\Mahasiswa\DashController as MhsDashController;
use App\Http\Controllers\Tendik\DashController as TendikDashController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([RedirectToLogin::class])->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard-admin', [AdminDashController::class, 'index'])->name('admin');
    Route::get('dashboard-admin/mahasiswa', [AdminDashController::class, 'indexMahasiswa'])->name('indexMahasiswa');
    Route::post('dashboard-admin/mahasiswa/tambah', [AdminDashController::class, 'storeMahasiswa'])->name('StoreMahasiswa');
    Route::post('dashboard-admin/mahasiswa/{id}/update', [AdminDashController::class, 'updateMahasiswa'])->name('UpdateMahasiswa');
    Route::delete('dashboard-admin/mahasiswa/delete/{id}', [AdminDashController::class, 'deleteMahasiswa'])->name('DeleteMahasiswa');
    Route::get('dashboard-admin/tenaga-kependidikan', [AdminDashController::class, 'indexTendik'])->name('indexTendik');
    Route::post('dashboard-admin/tenaga-kependidikan/tambah', [AdminDashController::class, 'storeTendik'])->name('StoreTendik');
    Route::put('dashboard-admin/tenaga-kependidikan/{id}/update', [AdminDashController::class, 'updateTendik'])->name('UpdateTendik');
    Route::delete('dashboard-admin/tenaga-kependidikan/delete/{id}', [AdminDashController::class, 'deleteTendik'])->name('DeleteTendik');
    Route::post('dashboard-superadmin/user-management/mhsimport', [AdminDashController::class, 'Mhsimport'])->name('mhsimport');
    Route::post('dashboard-superadmin/user-management/tendikimport', [AdminDashController::class, 'Tendikimport'])->name('tendikimport');
});

Route::middleware(['tendik'])->group(function () {
    Route::get('dashboard-tendik', [TendikDashController::class, 'index'])->name('tendik');
    Route::get('dashboard-tendik/permohonan/data-tugas-akhir', [VerifPermohonan::class, 'indexDataTugasAkhir'])->name('VerifdataTA');
    Route::get('dashboard-tendik/generate-word-tugas-akhir/{id}', [VerifPermohonan::class, 'generateWordTA'])->name('generateWordTA');
    Route::get('dashboard-tendik/download-tugas-akhir/{id}', [VerifPermohonan::class, 'downloadWordTA'])->name('downloadWordTA');
    Route::get('dashboard-tendik/permohonan/data-tugas-akhir/{id}/detail', [VerifPermohonan::class, 'showDataTugasAkhir'])->name('detaildataTA');
    Route::post('dashboard-tendik/permohonan/data-tugas-akhir/{id}/detail', [VerifPermohonan::class, 'updateStatusDataTA'])->name('StatusdataTA');
    Route::get('dashboard-tendik/permohonan/data-mata-kuliah', [VerifPermohonan::class, 'indexDataMataKuliah'])->name('VerifdataMatkul');
    Route::get('dashboard-tendik/permohonan/data-mata-kuliah/{id}/detail', [VerifPermohonan::class, 'showDataMataKuliah'])->name('detailDataMatkul');
    Route::get('dashboard-tendik/generate-word-mata-kuliah/{id}', [VerifPermohonan::class, 'generateWordMatkul'])->name('generateWordMatkul');
    Route::get('dashboard-tendik/download-mata-kuliah/{id}', [VerifPermohonan::class, 'downloadWordMatkul'])->name('downloadWordMatkul');
    Route::post('dashboard-tendik/permohonan/data-mata-kuliah/{id}/detail', [VerifPermohonan::class, 'updateStatusDataMatkul'])->name('StatusDataMatkul');
    Route::get('dashboard-tendik/keterangan/telah-tugas-akhir', [VerifKeterangan::class, 'indexTelahTugasAkhir'])->name('VeriftelahTA');
    Route::get('dashboard-tendik/generate-word-telah-tugas-akhir/{id}', [VerifKeterangan::class, 'generateWordTelahTA'])->name('generateWordTelahTA');
    Route::get('dashboard-tendik/download-telah-tugas-akhir/{id}', [VerifKeterangan::class, 'downloadWordTelahTA'])->name('downloadWordTelahTA');
    Route::get('dashboard-tendik/keterangan/telah-tugas-akhir/{id}/detail', [VerifKeterangan::class, 'showTelahTugasAkhir'])->name('detailtelahTA');
    Route::post('dashboard-tendik/keterangan/telah-tugas-akhir/{id}/detail', [VerifKeterangan::class, 'UpdateStatus'])->name('StatusTelahTA');
    Route::get('dashboard-tendik/rekomendasi/lomba', [VerifRekomendasi::class, 'indexlomba'])->name('Veriflomba');
    Route::get('dashboard-tendik/generate-word-lomba/{id}', [VerifRekomendasi::class, 'generateWordLomba'])->name('generateWordLomba');
    Route::get('dashboard-tendik/download-lomba/{id}', [VerifRekomendasi::class, 'downloadWordLomba'])->name('downloadWordLomba');
    Route::get('dashboard-tendik/rekomendasi/lomba/{id}/detail', [VerifRekomendasi::class, 'showlomba'])->name('detaillomba');
    Route::post('dashboard-tendik/rekomendasi/lomba/{id}/detail', [VerifRekomendasi::class, 'updateStatuslomba'])->name('Statuslomba');
    Route::get('dashboard-tendik/rekomendasi/beasiswa', [VerifRekomendasi::class, 'indexbeasiswa'])->name('Verifbeasiswa');
    Route::get('dashboard-tendik/generate-word-beasiswa/{id}', [VerifRekomendasi::class, 'generateWordBeasiswa'])->name('generateWordBeasiswa');
    Route::get('dashboard-tendik/download-beasiswa/{id}', [VerifRekomendasi::class, 'downloadWordBeasiswa'])->name('downloadWordBeasiswa');
    Route::get('dashboard-tendik/rekomendasi/beasiswa/{id}/detail', [VerifRekomendasi::class, 'showbeasiswa'])->name('detailbeasiswa');
    Route::post('dashboard-tendik/rekomendasi/beasiswa/{id}/detail', [VerifRekomendasi::class, 'updateStatusbeasiswa'])->name('Statusbeasiswa');
});

Route::middleware(['mahasiswa'])->group(function () {
    Route::get('dashboard', [MhsDashController::class, 'index'])->name('mahasiswa');
    Route::get('filter-activity-logs', [MhsDashController::class, 'filterActivityLogs'])->name('filter-activity-logs');
    Route::get('permohonan/data-tugas-akhir', [DataTugasAkhirController::class, 'index'])->name('dataTA');
    Route::post('permohonan/data-tugas-akhir', [DataTugasAkhirController::class, 'store'])->name('StoreDataTugasAkhir');
    Route::get('permohonan/data-mata-kuliah', [DataMataKuliahController::class, 'index'])->name('dataMatkul');
    Route::post('permohonan/store-data-mata-kuliah', [DataMataKuliahController::class, 'store'])->name('StoreDataMataKuliah');
    Route::get('keterangan/telah-tugas-akhir', [KetTelahTugasAkhirController::class, 'index'])->name('TelahTA');
    Route::post('keterangan/telah-tugas-akhir', [KetTelahTugasAkhirController::class, 'store'])->name('StoreTelahTA');
    Route::get('rekomendasi/beasiswa', [RekomendasiBeasiswaController::class, 'index'])->name('rekomendasi_beasiswa');
    Route::post('rekomendasi/beasiswa', [RekomendasiBeasiswaController::class, 'store'])->name('StoreRekBeasiswa');
    Route::get('rekomendasi/lomba', [RekomendasiLombaController::class, 'index'])->name('rekomendasi_lomba');
    Route::post('rekomendasi/lomba', [RekomendasiLombaController::class, 'store'])->name('StoreRekLomba');
});

Route::get('/404', function () {
    return view('404');
});
Route::get('/500', function () {
    return view('500');
});

Route::get('/cek-email', function () {
    return view('emails.status.diterima.data_mata_kuliah');
});
