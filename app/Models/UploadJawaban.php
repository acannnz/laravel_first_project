<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadJawaban extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'tugas_id', 'mata_kuliah_id', 'jawaban', 'upload_file'];
    protected $table = 'upload_tugas';
    public $timestamps = false;

    function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
    function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
