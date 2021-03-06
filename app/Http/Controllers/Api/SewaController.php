<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailBarang;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function index()
    {
        $sewa = Sewa::with('user', 'detail_barang.barang')->latest()->get();
        return response()->json([
            'message' => 'Berhasil menampilkan sewa',
            'data' => $sewa
        ], 200);
    }

    public function sewa_user()
    {
        $sewa = Sewa::with('user', 'detail_barang.barang')->where('user_id', auth()->id())->latest()->get();
        return response()->json([
            'message' => 'Berhasil menampilkan sewa',
            'data' => $sewa
        ], 200);
    }

    public function store(Request $request)
    {
        $detail_barang = DetailBarang::get();
        $detail_barang = $detail_barang->implode('id', ',');

        $request->validate([
            'detail_barang_id' => 'required|in:' .$detail_barang,
            'tanggal_diambil' => 'required|after_or_equal:' .now(),
        ]);

        $cek_sewa = Sewa::whereId(auth()->id())->where('status', 1)->first();
        if ($cek_sewa) {
            return response()->json([
                'message' => 'Masih memiliki sewa, kembalikan dulu barangnya'
            ]);
        }

        $barang_dipilih = DetailBarang::find($request->detail_barang_id);

        $sewa = Sewa::create([
            'detail_barang_id' => $request->detail_barang_id,
            'tanggal_diambil' => $request->tanggal_diambil,
            'tanggal_dikembalikan' => Carbon::create($request->tanggal_diambil)->subDays($barang_dipilih->durasi),
            'status' => 1,
            'denda' => 0,
            'total_bayar' => 0,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Berhasil melakukan sewa',
            'data' => $sewa
        ], 200);
    }

    public function update($id)
    {
        $sewa = Sewa::whereId($id)->where('status', 1)->first();
        $denda = Carbon::create($sewa->tanggal_dikembalikan)->diffInDays(now()) * $sewa->detail_barang->harga;
        
        $sewa->update([
            'status' => 2,
            'denda' => $denda,
            'total_bayar' => $sewa->detail_barang->harga + $denda
        ]);

        return response()->json([
            'message' => 'Berhasil menyelesaikan sewa',
            'data' => $sewa
        ],
            200
        );
    }

    public function count_selesai()
    {
        $sewa = Sewa::where('status', 2)->count();
        return response()->json(
            [
                'message' => 'Berhasil menampilkan sewa',
                'data' => $sewa
            ],
            200
        );
    }

    public function count_belum_selesai()
    {
        $sewa = Sewa::where('status', 1)->count();
        return response()->json(
            [
                'message' => 'Berhasil menampilkan sewa',
                'data' => $sewa
            ],
            200
        );
    }

    public function sewa_chart()
    {
        $sewa = Sewa::select(DB::raw('count(tanggal_dikembalikan) as value'), DB::raw('DATE_FORMAT(tanggal_dikembalikan, "%d") as date'))
            ->whereMonth('tanggal_dikembalikan', now()->month)
            ->whereYear('tanggal_dikembalikan', now()->year)
            ->where('status', 2)
            ->groupBy('date')
            ->get();

        $sewa_baru = [];
        for ($a=0; $a < now()->day; $a++) { 
            for ($b=0; $b < count($sewa); $b++) { 
                if ($a+1 == $sewa[$b]->date) {
                    $sewa_baru[$a+1] = $sewa[$b]->value;
                    break;
                } else {
                    $sewa_baru[$a+1] = 0;
                }
            }
        }

        return response()->json(
            [
                'message' => 'Berhasil menampilkan sewa',
                'data' => $sewa_baru
            ],
            200
        );
    }
}
