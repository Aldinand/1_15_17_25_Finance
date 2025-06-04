<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     required={"id", "nama", "email"},
 *     @OA\Property(property="id", type="integer", readOnly=true),
 *     @OA\Property(property="nama", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="password", type="string", format="password", writeOnly=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true),
 * )
 *
 * @OA\Schema(
 *     schema="UserCreateRequest",
 *     type="object",
 *     required={"nama", "email", "password"},
 *     @OA\Property(property="nama", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="password", type="string", format="password"),
 * )
 *
 * @OA\Schema(
 *     schema="UserUpdateRequest",
 *     type="object",
 *     @OA\Property(property="nama", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="password", type="string", format="password"),
 * )
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',    
        'email',
        'password',
    ];
}