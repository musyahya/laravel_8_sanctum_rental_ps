<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rental = Rental::find(1);
        return response()->json([
            'message' => 'Berhasil menampilkan data rental',
            'data' => $rental
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'hp' => 'required|numeric'
        ]);

        $rental = Rental::find(1);
        $rental->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'hp' => $request->hp
        ]);

        return response()->json([
            'message' => 'Berhasil melakukan update rental',
            'data' => $rental
        ], 200);
    }
}
