<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Transaksi::all()
        ]);
    }

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

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $transaksi
        ]);
    }

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

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(null, 204);
    }
}
