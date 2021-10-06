<?php

namespace Database\Seeders;

use App\Models\Sewa;
use Illuminate\Database\Seeder;

class SewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sewa::create([
            'detail_barang_id' => 1,
            'user_id' => 2,
            'status' => 2,
            'denda' => 0,
            'total_bayar' => 60000,
            'tanggal_diambil' => now()->subDays(3),
            'tanggal_dikembalikan' => now()->subDays(2)
        ]);
    }
}
