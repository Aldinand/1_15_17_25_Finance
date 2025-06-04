<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Transaksi",
 *     type="object",
 *     required={"tanggal", "jumlah", "tipe"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", nullable=true, example=1),
 *     @OA\Property(property="kategori_id", type="integer", nullable=true, example=2),
 *     @OA\Property(property="tanggal", type="string", format="date", example="2024-05-05"),
 *     @OA\Property(property="jumlah", type="integer", example=100000),
 *     @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}, example="Pemasukan"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-05-05T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-06T10:00:00Z")
 * )
 */
class TransaksiSwaggerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transaksi",
     *     tags={"Transaksi"},
     *     summary="Menampilkan semua transaksi",
     *     operationId="indexTransaksi",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar transaksi berhasil diambil",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Transaksi")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Transaksi::all()
        ]);
    }

    /**
     * @OA\Post(
     *     path="/transaksi",
     *     tags={"Transaksi"},
     *     summary="Buat transaksi baru",
     *     operationId="storeTransaksi",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal","jumlah","tipe"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-05-05"),
     *             @OA\Property(property="jumlah", type="integer", example=100000),
     *             @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}, example="Pemasukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaksi berhasil dibuat",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Transaksi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'kategori_id' => 'sometimes|exists:kategori,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'tipe' => 'required|string|in:Pemasukan,Pengeluaran',
        ]);

        $transaksi = Transaksi::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $transaksi
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/transaksi/{id}",
     *     tags={"Transaksi"},
     *     summary="Menampilkan detail transaksi",
     *     operationId="showTransaksi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID dari transaksi yang ingin ditampilkan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail transaksi berhasil ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Transaksi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transaksi tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $transaksi
        ]);
    }

    /**
     * @OA\Put(
     *     path="/transaksi/{id}",
     *     tags={"Transaksi"},
     *     summary="Mengupdate transaksi yang ada",
     *     operationId="updateTransaksi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID transaksi yang akan diupdate",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal","jumlah","tipe"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-05-05"),
     *             @OA\Property(property="jumlah", type="integer", example=100000),
     *             @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}, example="Pengeluaran")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi berhasil diperbarui",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Transaksi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transaksi tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'kategori_id' => 'sometimes|exists:kategori,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'tipe' => 'required|string|in:Pemasukan,Pengeluaran',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $transaksi
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/transaksi/{id}",
     *     tags={"Transaksi"},
     *     summary="Menghapus transaksi",
     *     operationId="deleteTransaksi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID transaksi yang akan dihapus",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Transaksi berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transaksi tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(null, 204);
    }
}
