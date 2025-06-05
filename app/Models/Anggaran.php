<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Anggaran",
 *     type="object",
 *     title="Anggaran",
 *     required={"user_id", "kategori_id", "jumlah_anggaran", "periode"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=2),
 *     @OA\Property(property="kategori_id", type="integer", example=3),
 *     @OA\Property(property="jumlah_anggaran", type="integer", example=1000000),
 *     @OA\Property(property="periode", type="string", example="2025-01"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-19T08:30:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-19T08:30:00Z")
 * )
 */
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

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'kategori_id' => 'integer',
        'jumlah_anggaran' => 'integer',
        'periode' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
