<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiffCostPo extends Model
{
    use HasFactory;
    protected $table = 'diff_cost_po';
    public $guarded = [];
}
