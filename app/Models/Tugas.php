<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'mata_kuliah_id', 'user_id', 'judul', 'deskripsi', 'status'];
    protected $table = 'tugas';
    public $timestamps = false;

    function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
    function uploadJawaban()
    {
        return $this->hasMany(UploadJawaban::class);
    }
}
