<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

<<<<<<< HEAD
/**
 * @OA\Schema(
 *     schema="Anggaran",
 *     type="object",
 *     required={"jumlah_anggaran", "periode"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="kategori_id", type="integer", example=2),
 *     @OA\Property(property="jumlah_anggaran", type="integer", example=5000000),
 *     @OA\Property(property="periode", type="string", example="2025-05")
 * )
 */

=======
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
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