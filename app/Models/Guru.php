<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurus';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'nuptk',
        'status_kepegawaian',
        'jenis_kelamin',
        'tugas',
        'penempatan',
        'tanggal_lahir',
        'nomor_handphone',
        'email',
        'email_madrasah',
        'password_awal',
        'foto_profile',
    ];
}
