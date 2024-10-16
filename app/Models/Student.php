<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $table = 'students';

    public function biayaSiswa()
    {
        return $this->hasMany(BiayaSiswa::class, 'siswa_id');
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'tingkat_rombel'); // Adjust 'kelas_id' to your actual foreign key
    }

}
