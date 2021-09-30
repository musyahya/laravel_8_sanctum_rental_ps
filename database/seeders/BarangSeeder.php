<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'nama' => 'PS3',
            'deskripsi' => 'HDD 500, 2 stik'
        ]);

        Barang::create([
            'nama' => 'PS4',
            'deskripsi' => 'HDD 500, 2 stik'
        ]);
    }
}
