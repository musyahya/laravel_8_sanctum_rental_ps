<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa';
    protected $fillable = ['tanggal_diambil', 'tanggal_dikembalikan', 'detail_barang_id', 'user_id', 'status', 'denda', 'total_bayar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_barang()
    {
        return $this->belongsTo(DetailBarang::class);
    }
}