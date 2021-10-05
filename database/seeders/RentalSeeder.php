<?php

namespace Database\Seeders;

use App\Models\Rental;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rental::create([
            'nama' => 'laravel rental ps',
            'alamat' => 'jl. pemuda',
            'hp' => '0852123456789'
        ]);
    }
}
