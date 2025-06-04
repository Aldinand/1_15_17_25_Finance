<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Kategori",
 *     description="Operations related to categories"
 * )
 */
class KategoriSwaggerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/kategoris",
     *     summary="Display a listing of all categories",
     *     description="Get a list of all categories",
     *     operationId="indexKategori",
     *     tags={"Kategori"},
     *     @OA\Response(
     *         response=200,
     *         description="List of categories",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nama_kategori", type="string"),
     *                 @OA\Property(property="tipe", type="string"),
     *                 @OA\Property(property="user_id", type="integer")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json($kategoris);
    }

    /**
     * @OA\Post(
     *     path="/kategoris",
     *     summary="Store a newly created category",
     *     description="Create a new category",
     *     operationId="storeKategori",
     *     tags={"Kategori"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_kategori", "tipe"},
     *             @OA\Property(property="nama_kategori", type="string", example="Food"),
     *             @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nama_kategori", type="string"),
     *             @OA\Property(property="tipe", type="string"),
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $validatedData['nama_kategori'],
            'tipe' => $validatedData['tipe'],
            'user_id' => $validatedData['user_id'] ?? Auth::id(),
        ]);

        return response()->json($kategori, 201);
    }

    /**
     * @OA\Get(
     *     path="/kategoris/{id}",
     *     summary="Display the specified category",
     *     description="Get category by ID",
     *     operationId="showKategori",
     *     tags={"Kategori"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nama_kategori", type="string"),
     *             @OA\Property(property="tipe", type="string"),
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }

    /**
     * @OA\Put(
     *     path="/kategoris/{id}",
     *     summary="Update the specified category",
     *     description="Update an existing category by ID",
     *     operationId="updateKategori",
     *     tags={"Kategori"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_kategori", "tipe"},
     *             @OA\Property(property="nama_kategori", type="string", example="Transportation"),
     *             @OA\Property(property="tipe", type="string", enum={"Pemasukan", "Pengeluaran"}),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nama_kategori", type="string"),
     *             @OA\Property(property="tipe", type="string"),
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return response()->json($kategori);
    }

    /**
     * @OA\Delete(
     *     path="/kategoris/{id}",
     *     summary="Remove the specified category",
     *     description="Delete a category by ID",
     *     operationId="destroyKategori",
     *     tags={"Kategori"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Category deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(null, 204);
    }
}
