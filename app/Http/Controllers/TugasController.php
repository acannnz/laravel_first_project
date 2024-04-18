<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use App\Models\UploadJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;

        if (strlen($katakunci)) {
            $data = MataKuliah::where('id', 'like', "%$katakunci%")
                ->orWhere('pelajaran ', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = MataKuliah::orderBy('id', 'desc')->withCount('tugas')->paginate($jumlahbaris);
        }
        return view('classroom.dashboard', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('pelajaran', $request->pelajaran);

        $request->validate([
            'pelajaran' => 'required',
        ], [
            'pelajaran.required' => 'Form Wajib diisi',
        ]);
        $data = [
            'pelajaran' => $request->pelajaran,
            'status' => 'status'
        ];
        MataKuliah::create($data);
        return redirect()->to('classroom')->with('success', 'Berhasil menambahkan Mata Kuliah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tugas::where('id', $id)->first();
        return view('classroom.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ], [
            'judul.required' => 'Form Wajib diisi',
            'deskripsi.required' => 'Form Wajib diisi',
        ]);
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];
        Tugas::where('id', $id)->update($data);
        return redirect('classroom/' . $id . '/detailTugas')->with('success', 'Berhasil Mengupdate Tugas Kuliah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function tambahTugasForm(string $id)
    {
        $data = MataKuliah::where('id', $id)->first();
        return view('classroom/tambahTugas')->with('data', $data);
    }
    function fungsitambahTugas(Request $request, string $id)
    {
        // dd($id);
        Session::flash('judul', $request->judul);
        Session::flash('deskripsi', $request->deskripsi);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ], [
            'judul.required' => 'Form Wajib diisi',
            'deskripsi.required' => 'Form Wajib diisi',
        ]);
        $data = [
            'judul' => $request->judul,
            'mata_kuliah_id' => $id,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->id(),
            'status' => '11'
        ];
        Tugas::create($data);
        return redirect()->to('classroom')->with('success', 'Berhasil Menambahkan Tugas Kuliah');
    }
    function daftarTugas(Request $request, string $id)
    {
        $row = $request->input('row', 10);
        $data = Tugas::with("mataKuliah")->where("mata_kuliah_id", $id)->paginate($row);
        return view('classroom.detailTugas', ['data' => $data, "id" => $id]);
    }
    function daftarJawaban(Request $request, string $id)
    {
        $data = UploadJawaban::with('user')->where('tugas_id', $id)->get();
        return view('classroom.tampilanJawaban', ['data' => $data]);
    }
    function cekFile(string $id)
    {
        $data = UploadJawaban::where('id', $id)->get();
        foreach ($data as $jawabanFile) {
            $filePath = storage_path($jawabanFile->upload_file);
            if (UploadJawaban::exists($filePath)) {
                return response()->file($filePath);
            }
        }
        return view('classroom.tampilanJawabanFile', ['data' => $data]);
    }
}
