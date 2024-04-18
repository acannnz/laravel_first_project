<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{

    use HasFactory;
    protected $fillable = ['id', 'nama', 'umur', 'alamat', 'pekerjaan', 'bio', 'skill', 'user_id'];
    protected $table = 'data_users';
    public $timestamps = false;

    function  user()
    {
        return $this->belongsTo(User::class);
    }
}
