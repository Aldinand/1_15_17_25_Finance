<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggaran extends Model
{
    use HasFactory;
    
    protected $table = 'anggaran';
    
    protected $fillable = [
        'user_id',
        'kategori_id',
        'jumlah_anggaran',
        'periode',
    ];
}