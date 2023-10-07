<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'admin_keuangan.kategori';
    protected $primaryKey = 'kategori_id';
    public $timestamps = false;
    protected $guarded = [];
}
