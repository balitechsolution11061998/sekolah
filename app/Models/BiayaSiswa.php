<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BiayaSiswa extends Model
{
    use HasFactory, LogsActivity;

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

    protected static $logAttributes = [
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

    protected static $logName = 'biaya_siswa';

    public function getActivitylogOptions(): LogOptions
    {
        return (new LogOptions())
            ->logOnly(static::$logAttributes) // Use static::$logAttributes
            ->useLogName(static::$logName); // Correctly use useLogName()
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'biaya_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'siswa_id');
    }
}
