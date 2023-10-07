<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'admin_keuangan.pengeluaran';
    protected $primaryKey = 'pengeluaran_id';
    public $timestamps = false;
    protected $guarded = [];
}