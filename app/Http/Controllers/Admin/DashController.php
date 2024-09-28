<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Imports\MhsImport;
use Illuminate\Http\Request;
use App\Imports\TendikImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DashController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $mahasiswa = User::where('role', 'mahasiswa')->count();
        $tendik = User::where('role', 'tendik')->count();
        return view('admin.dashboard', compact('mahasiswa', 'tendik', 'title'));
    }

    // Controller Mahasiswa
    public function indexMahasiswa()
    {
        $title = 'Mahasiswa';
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas', 'title'));
    }

    public function storeMahasiswa(Request $request)
    {
        try {
            User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nim' => $request->nim,
                'email' => $request->email,
                'role' => 'mahasiswa',
                'program_studi' => $request->program_studi,
                'password' => bcrypt($request->password)
            ]);

            return redirect()->route('indexMahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('indexMahasiswa')->with('error', 'Gagal menambahkan data mahasiswa: ' . $e->getMessage());
        }
    }

    public function updateMahasiswa(Request $request, $id)
    {
        try {
            $mahasiswa = User::find($id);
            $mahasiswa->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nim' => $request->nim,
                'email' => $request->email,
                'semester' => $request->semester,
                'prodi' => $request->prodi,
                'jurusan' => $request->jurusan,
                'role' => 'mahasiswa',
                'nohp' => $request->no_hp,
                'password' => bcrypt($request->password),
                'status' => $request->status
            ]);

            return redirect()->route('IndexMahasiswa')->with('success', 'Data mahasiswa berhasil diedit!');
        } catch (\Exception $e) {
            return redirect()->route('IndexMahasiswa')->with('error', 'Gagal mengedit data mahasiswa: ' . $e->getMessage());
        }
    }

    public function deleteMahasiswa($id)
    {
        $mahasiswa = User::find($id);
        if ($mahasiswa) {
            $mahasiswa->delete();
            return redirect()->route('indexMahasiswa')->with('success', 'Mahasiswa deleted successfully');
        } else {
            return redirect()->route('indexMahasiswa')->with('error', 'Mahasiswa not found');
        }
    }


    // Controller Tenaga Kependidikan
    public function indexTendik()
    {
        $title = 'Tenaga Kependidikan';
        $tendiks = User::where('role', 'tendik')->get();
        return view('admin.tendik.index', compact('tendiks', 'title'));
    }

    public function storeTendik(Request $request)
    {
        try {
            User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'email' => $request->email,
                'role' => 'tendik',
                'password' => bcrypt($request->password)
            ]);

            return redirect()->route('indexTendik')->with('success', 'Data Tendik berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('indexTendik')->with('error', 'Gagal menambahkan data Tendik: ' . $e->getMessage());
        }
    }

    public function updateTendik(Request $request, $id)
    {
        try {
            $tendik = User::findOrFail($id);
            $tendik->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return redirect()->route('indexTendik')->with('success', 'Data Tendik berhasil diedit!');
        } catch (\Exception $e) {
            return redirect()->route('indexTendik')->with('error', 'Gagal memperbarui data Tendik: ' . $e->getMessage());
        }
    }

    public function deleteTendik($id)
    {
        $tendik = User::find($id);

        if ($tendik) {
            $tendik->delete();
            return redirect()->route('indexTendik')->with('success', 'Tendik deleted successfully');
        } else {
            return redirect()->route('indexTendik')->with('error', 'Tendik not found');
        }
    }

    public function Mhsimport(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new MhsImport, $file);

        return back()->with('success', 'Upload Mahasiswa Berhasil.');
    }
    public function Tendikimport(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new TendikImport, $file);

        return back()->with('success', 'Users imported successfully.');
    }
}
