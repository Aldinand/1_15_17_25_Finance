<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return Transaksi::all();
    }

    /**
     * @OA\Post(
     *     path="/api/transaksi",
     *     tags={"Transaksi"},
     *     summary="Buat transaksi baru",
     *     operationId="storeTransaksi",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal","jumlah","tipe"},
     *             @OA\Property(property="user_id", type="integer", example=1, description="Opsional, ID user yang valid"),
     *             @OA\Property(property="kategori_id", type="integer", example=2, description="Opsional, ID kategori yang valid"),
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
     *             @OA\Property(property="data", type="object")
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

        return response()->json($transaksi, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/transaksi/{id}",
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
     *             @OA\Property(property="data", type="object")
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
        return Transaksi::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/transaksi/{id}",
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
     *             @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}, example="Pemasukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi berhasil diperbarui",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object")
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
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());
        return response()->json($transaksi, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/transaksi/{id}",
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
