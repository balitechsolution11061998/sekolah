<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = "mapel";
    public $guarded = [];
    // Define the relationship with Tapel
    public function tapel()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tapel_id');
    }
}
