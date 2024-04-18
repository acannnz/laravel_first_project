<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\UploadJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function show($category, $filename)
    {
        $data = UploadJawaban::where('user_id', 'upload_file');
        $filePath = resource_path("uploads/$category/$filename");
        if (File::exists($filePath)) {
            return response()->file($filePath);
        }
        return view('classroom/{id}/uploads/{category}/{filename}', ['filePath' => $filePath, 'data' => $data]);
    }
}
