<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaSiswa extends Model
{
    protected $table = 'biaya_siswa';
    protected $fillable = [
        'biaya_id',
        'siswa_id',
        'periode',
        'jumlah',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
        'is_angsur',
        'jumlah_angsur',
        'jumlah_angsuran_total',
        'angsuran_terbayar',
    ];
    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'biaya_id');
    }

    // Relationship to Siswa
    public function siswa()
    {
        return $this->belongsTo(Student::class, 'siswa_id');
    }
}
