<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailBarang;
use Illuminate\Http\Request;

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
}
