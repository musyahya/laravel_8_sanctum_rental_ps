<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'message' => 'Berhasil menampilkan barang',
            'data' => $barang
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|max:1024'
        ]);

        $gambar = $request->file('gambar')->store('barang', 'public');

        $barang = Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar
        ]);

        return response()->json([
            'message' => 'Berhasil menambah barang',
            'data' => $barang
        ], 200);
    }
    
    public function show(Barang $barang)
    {
        return response()->json([
            'message' => 'Berhasil menampilkan barang',
            'data' => $barang
        ], 200);
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($request->gambar) {
            Storage::delete('/public/' .$barang->gambar);
            $gambar = $request->file('gambar')->store('barang', 'public');
        }else {
            $gambar = $barang->gambar;
        }

        $barang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar
        ]);

        return response()->json([
            'message' => 'Berhasil mengubah barang',
            'data' => $barang
        ], 200);
    }

    public function destory(Barang $barang)
    {
        $barang->delete();

        return response()->json([
            'message' => 'Berhasil hapus barang',
        ], 200);
    }
}
