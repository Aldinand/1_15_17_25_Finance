<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\LaporanKeuangan
 *
 * @property int $id
 * @property int $user_id
 * @property string $periode
 * @property int $total_pemasukan
 * @property int $total_pengeluaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
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

    protected $casts = [
        'periode' => 'date:Y-m', // contoh: "2025-06"
        'total_pemasukan' => 'integer',
        'total_pengeluaran' => 'integer',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
