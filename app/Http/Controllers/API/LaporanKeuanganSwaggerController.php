<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganSwaggerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/laporan-keuangans",
     *     summary="Get all financial reports",
     *     tags={"Laporan Keuangan"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        return LaporanKeuangan::all();
    }

    /**
     * @OA\Post(
     *     path="/laporan-keuangans",
     *     summary="Create a new financial report",
     *     tags={"Laporan Keuangan"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"periode","total_pemasukan","total_pengeluaran"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="periode", type="string", example="2025-01"),
     *             @OA\Property(property="total_pemasukan", type="integer", example=5000000),
     *             @OA\Property(property="total_pengeluaran", type="integer", example=3000000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'periode' => 'required|string',
            'total_pemasukan' => 'required|integer',
            'total_pengeluaran' => 'required|integer',
        ]);

        $laporanKeuangan = LaporanKeuangan::create($request->all());
        return response()->json($laporanKeuangan, 201);
    }

    /**
     * @OA\Get(
     *     path="/laporan-keuangans/{id}",
     *     summary="Get a financial report by ID",
     *     tags={"Laporan Keuangan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the report",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        return LaporanKeuangan::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/laporan-keuangans/{id}",
     *     summary="Update a financial report",
     *     tags={"Laporan Keuangan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the report to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="periode", type="string", example="2025-01"),
     *             @OA\Property(property="total_pemasukan", type="integer", example=7000000),
     *             @OA\Property(property="total_pengeluaran", type="integer", example=4000000)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful update"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $laporanKeuangan = LaporanKeuangan::findOrFail($id);
        $laporanKeuangan->update($request->all());
        return response()->json($laporanKeuangan, 200);
    }

    /**
     * @OA\Delete(
     *     path="/laporan-keuangans/{id}",
     *     summary="Delete a financial report",
     *     tags={"Laporan Keuangan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the report to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        LaporanKeuangan::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/laporan-keuangans/user/{user_id}",
     *     summary="Get all financial reports by user ID",
     *     tags={"Laporan Keuangan"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found or no reports available"
     *     )
     * )
     */
    public function getByUser($user_id)
    {
        // Ambil semua laporan keuangan yang memiliki user_id sesuai
        $laporanUser = LaporanKeuangan::where('user_id', $user_id)->get();

        if ($laporanUser->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada laporan keuangan untuk user_id ' . $user_id
            ], 404);
        }

        return response()->json($laporanUser, 200);
    }
}
