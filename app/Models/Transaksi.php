<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaksi
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $kategori_id
 * @property string $tanggal
 * @property int $jumlah
 * @property string $tipe
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Kategori|null $kategori
 *
 * @mixin \Eloquent
 */
class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'tanggal',
        'jumlah',
        'tipe',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
