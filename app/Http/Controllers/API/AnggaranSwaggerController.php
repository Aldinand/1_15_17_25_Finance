<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Anggaran",
 *     description="Manajemen data anggaran"
 * )
 */
class AnggaranSwaggerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/anggaran",
     *     operationId="getAnggaranList",
     *     tags={"Anggaran"},
     *     summary="Ambil semua data anggaran",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil ambil data anggaran",
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
     *     path="/anggaran",
     *     operationId="createAnggaran",
     *     tags={"Anggaran"},
     *     summary="Tambah data anggaran",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berhasil tambah data anggaran",
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
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
     *     path="/anggaran/{id}",
     *     operationId="getAnggaranById",
     *     tags={"Anggaran"},
     *     summary="Tampilkan detail anggaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil ambil data",
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
     *     path="/anggaran/{id}",
     *     operationId="updateAnggaran",
     *     tags={"Anggaran"},
     *     summary="Update data anggaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Anggaran")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil update data",
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
     *     path="/anggaran/{id}",
     *     operationId="deleteAnggaran",
     *     tags={"Anggaran"},
     *     summary="Hapus data anggaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Berhasil hapus"
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
