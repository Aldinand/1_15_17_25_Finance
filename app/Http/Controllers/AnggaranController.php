<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

<<<<<<< HEAD
/**
 * @OA\Tag(
 *     name="Anggaran",
 *     description="Manajemen data anggaran"
 * )
 */
class AnggaranController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/anggaran",
     *     tags={"Anggaran"},
     *     summary="Ambil semua data anggaran",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil ambil data anggaran",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Anggaran"))
     *     )
     * )
     */
=======
class AnggaranController extends Controller
{
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
    public function index()
    {
        return Anggaran::all();
    }

<<<<<<< HEAD
    /**
     * @OA\Post(
     *     path="/api/anggaran",
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
=======
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'kategori_id' => 'sometimes|exists:kategori,id',
            'jumlah_anggaran' => 'required|integer',
            'periode' => 'required|string',
        ]);
        $anggaran = Anggaran::create($request->all());
        return response()->json($anggaran, 201);
    }

<<<<<<< HEAD
    /**
     * @OA\Get(
     *     path="/api/anggaran/{id}",
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
     *     )
     * )
     */
=======
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
    public function show($id)
    {
        return Anggaran::findOrFail($id);
    }

<<<<<<< HEAD
    /**
     * @OA\Put(
     *     path="/api/anggaran/{id}",
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
     *     )
     * )
     */
=======
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update($request->all());
        return response()->json($anggaran, 200);
    }

<<<<<<< HEAD
    /**
     * @OA\Delete(
     *     path="/api/anggaran/{id}",
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
     *     )
     * )
     */
=======
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
    public function destroy($id)
    {
        Anggaran::destroy($id);
        return response()->json(null, 204);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 5b55bab2baf76c506d967b580422ecafa36cbfc0
