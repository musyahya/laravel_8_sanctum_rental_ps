<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\DetailBarang;
use Faker\Factory;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        $barang = Barang::create([
            'nama' => 'PS3',
            'deskripsi' => 'HDD 500, 2 stik',
            'gambar' => 'barang/' .$faker->image('public/storage/barang', 640, 480, 'animals', false)
        ]);

        DetailBarang::create([
            'barang_id' => $barang->id,
            'harga' => 60000,
            'durasi' => 1
        ]);

        DetailBarang::create([
            'barang_id' => $barang->id,
            'harga' => 150000,
            'durasi' => 3
        ]);

        $barang = Barang::create([
            'nama' => 'PS4',
            'deskripsi' => 'HDD 500, 2 stik',
            'gambar' => 'barang/' .$faker->image('public/storage/barang', 640, 480, 'animals', false)
        ]);

        DetailBarang::create([
            'barang_id' => $barang->id,
            'harga' => 110000,
            'durasi' => 1
        ]);

        DetailBarang::create([
            'barang_id' => $barang->id,
            'harga' => 300000,
            'durasi' => 3
        ]);
    }
}
