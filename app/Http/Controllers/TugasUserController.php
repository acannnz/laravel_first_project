<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use App\Models\UploadJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TugasUserController extends Controller
{
    function tampilanUserClassroom(Request $request)
    {
        $row = $request->input('row', 10);
        $data = Tugas::with('mataKuliah', 'uploadJawaban')->paginate($row);
        return view('userClassroom.dashboard', ['data' => $data]);
    }

    function tampilanJawabClassroom(string $id)
    {
        $data = Tugas::where('id', $id)->first();
        return view('userClassroom.formJawaban', ['data' => $data]);
    }
    function fungsiJawabClassroom(Request $request, string $id)
    {
        $request->validate([
            'jawaban' => 'required|string|max:225',
            'matkul' => 'required',
            'upload_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5140',
        ], [
            'jawaban.required' => 'Form Wajib diisi',
            'upload_file.required' => 'File Wajib diisi',
            'upload_file.max' => 'Ukuran file tidak boleh lebih dari 5MB',
        ]);
        if ($request->hasFile('upload_file') && $request->file('upload_file')->isValid()) {
            $file = $request->file('upload_file');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $path = 'uploads/file/';
            $file->move(storage_path($path), $filename);
            $filePath = $path . $filename;
        } else {
            $filePath = null;
        }
        $data = [
            'user_id' => auth()->id(),
            'mata_kuliah_id' => $request->matkul,
            'tugas_id' => $id,
            'jawaban' => $request->jawaban,
            'upload_file' => $filePath,
        ];

        UploadJawaban::create($data);
        return redirect('userClassroom')->with('success', 'Berhasil Upload Tugas Kuliah');
    }

    function cekJawaban()
    {
        $data = UploadJawaban::get();

        return view('userClassroom.tampilanJawaban', ['data' => $data]);
    }

    function cekFile(string $id)
    {
        $data = UploadJawaban::where('id', $id)->get();
        dd($data);
        foreach ($data as $jawabanFile) {
            $filePath = storage_path($jawabanFile->upload_file);
            if (UploadJawaban::exists($filePath)) {
                return response()->file($filePath);
            }
        }
        return view('userClassroom.tampilanJawabanFile', ['data' => $data]);
    }
}
