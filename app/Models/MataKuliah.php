<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'pelajaran', 'status'];
    protected $table = 'mata_kuliah';
    public $timestamps = false;

    function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    function uploadJawaban()
    {
        return $this->hasMany(UploadJawaban::class, 'mata_kuliah_id');
    }
}
