<?php

namespace App\Http\Middleware;

use App\Models\UploadJawaban;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = auth()->id();
        $fileId = $request->route('id');
        $file = UploadJawaban::find($fileId);
        if ($file && $file->user_id == $userId) {
            return $next($request);
        }
        return response()->json(['Anda Tidak Di Ijinkan Mengakses File ini']);
    }
}
