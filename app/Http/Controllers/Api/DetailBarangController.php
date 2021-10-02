<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetailBarangController extends Controller
{
    public function index()
    {
        $detail_barang = DetailBarang::with('barang')->get();

        return response()->json([
            'message' => 'Berhasil menampilkan detail barang',
            'data' => $detail_barang
        ], 200);
    }

    public function store(Request $request)
    {
        $barang = Barang::all();
        $barang = $barang->implode('id', ', ');

        $request->validate([
            'barang_id' => 'required|in:' .$barang,
            'harga' => 'required|min:1|numeric',
            'durasi' => 'required|min:1|numeric'
        ]);

        $detail_barang = DetailBarang::create([
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'durasi' => $request->durasi
        ]);

        return response()->json([
            'message' => 'Berhasil menambah detail barang',
            'data' => $detail_barang
        ], 200);
    }

    public function show($id)
    {
        $detail_barang = DetailBarang::with('barang')->whereId($id)->first();

        return response()->json([
            'message' => 'Berhasil menampilkan detail barang',
            'data' => $detail_barang
        ], 200);
    }

    public function update(Request $request, DetailBarang $detail_barang)
    {
        $barang = Barang::all();
        $barang = $barang->implode('id', ', ');

        $request->validate([
            'barang_id' => 'required|in:' . $barang,
            'harga' => 'required|min:1|numeric',
            'durasi' => 'required|min:1|numeric'
        ]);

        $detail_barang->update([
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'durasi' => $request->durasi
        ]);

        return response()->json([
            'message' => 'Berhasil mengubah detail barang',
            'data' => $detail_barang
        ], 200);
    }
}
