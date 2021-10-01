<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBarang extends Model
{
    use HasFactory;

    protected $table = 'detail_barang';
    protected $fullable = ['barang_id', 'harga', 'durasi'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
