<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index()
    {
        $sewa = Sewa::with('user', 'detail_barang.barang')->get();
        return response()->json([
            'message' => 'Berhasil menampilkan sewa',
            'data' => $sewa
        ], 200);
    }
}
