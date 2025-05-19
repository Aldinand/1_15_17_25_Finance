<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    
    protected $table = 'transaksi';
    protected $fillable = [
        'user_id',
        'kategori_id',
        'tanggal',
        'jumlah',
        'tipe'
    ];
}
