<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pelajaranLabel = MataKuliah::pluck('pelajaran')->toArray();

        // Ambil jumlah tugas untuk setiap mata kuliah
        $jumlahTugas = [];
        foreach ($pelajaranLabel as $pelajaran) {
            $jumlahTugas[] = Tugas::whereHas('mataKuliah', function ($query) use ($pelajaran) {
                $query->where('pelajaran', $pelajaran);
            })->count();
        }

        $jumlahMataKuliah = MataKuliah::count();
        $daftarTugas = Tugas::count();
        $jumlahUser = User::count();
        return view('home', [
            'jumlahMataKuliah' => $jumlahMataKuliah,
            'daftarTugas' => $daftarTugas,
            'jumlahUser' => $jumlahUser,
            'pelajaran' => $pelajaranLabel,
            'jumlahTugas' => $jumlahTugas
        ]);
    }
}
