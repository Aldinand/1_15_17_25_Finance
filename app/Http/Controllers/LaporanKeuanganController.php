<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
 public function index()
    {
        return LaporanKeuangan::all();
    }

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

    public function show($id)
    {
        return LaporanKeuangan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $laporanKeuangan = LaporanKeuangan::findOrFail($id);
        $laporanKeuangan->update($request->all());
        return response()->json($laporanKeuangan, 200);
    }

    public function destroy($id)
    {
        LaporanKeuangan::destroy($id);
        return response()->json(null, 204);
    }
}