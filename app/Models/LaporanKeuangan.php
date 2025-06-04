<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanKeuangan extends Model
{
    use HasFactory;
    
    protected $table = 'laporan_keuangan';
    
    protected $fillable = [
        'user_id',
        'periode',
        'total_pemasukan',
        'total_pengeluaran',
    ];
}
