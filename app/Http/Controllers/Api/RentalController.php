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
}
