<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        return Anggaran::all();
    }

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

    public function show($id)
    {
        return Anggaran::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update($request->all());
        return response()->json($anggaran, 200);
    }

    public function destroy($id)
    {
        Anggaran::destroy($id);
        return response()->json(null, 204);
    }
}