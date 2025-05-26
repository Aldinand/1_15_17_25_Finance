<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json($kategoris);
    }

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

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }

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

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(null, 204);
    }
}
