<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/anggarans",
     *     summary="List semua anggaran",
     *     tags={"Anggaran"},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar anggaran",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Anggaran"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Anggaran::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/anggarans",
     *     summary="Tambah anggaran baru",
     *     tags={"Anggaran"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "kategori_id", "jumlah_anggaran", "periode"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="jumlah_anggaran", type="integer", example=1000000),
     *             @OA\Property(property="periode", type="string", example="2025-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berhasil menyimpan anggaran",
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah_anggaran' => 'required|integer',
            'periode' => 'required|string',
        ]);

        $anggaran = Anggaran::create($request->all());
        return response()->json($anggaran, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/anggarans/{id}",
     *     summary="Detail anggaran",
     *     tags={"Anggaran"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data anggaran ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $anggaran = Anggaran::find($id);
        if (!$anggaran) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($anggaran, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/anggarans/{id}",
     *     summary="Update anggaran",
     *     tags={"Anggaran"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="jumlah_anggaran", type="integer", example=1000000),
     *             @OA\Property(property="periode", type="string", example="2025-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil update anggaran",
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::find($id);
        if (!$anggaran) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'kategori_id' => 'sometimes|exists:kategori,id',
            'jumlah_anggaran' => 'sometimes|integer',
            'periode' => 'sometimes|string',
        ]);

        $anggaran->update($request->all());
        return response()->json($anggaran, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/anggarans/{id}",
     *     summary="Hapus anggaran",
     *     tags={"Anggaran"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Berhasil hapus anggaran"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $anggaran = Anggaran::find($id);
        if (!$anggaran) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $anggaran->delete();
        return response()->json(null, 204);
    }
}

/**
 * @OA\Schema(
 *     schema="Anggaran",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="kategori_id", type="integer", example=2),
 *     @OA\Property(property="jumlah_anggaran", type="integer", example=1000000),
 *     @OA\Property(property="periode", type="string", example="2025-01"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-26T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-26T12:34:56Z")
 * )
 */
