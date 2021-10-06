<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $table = 'sewa';
    protected $fillable = ['tanggal_diambil', 'tanggal_dikembalikan', 'detail_barang_id', 'user_id', 'status', 'denda', 'total_bayar'];

    public function getTanggalDiambilAttribute($tanggal_diambil)
    {
        return date_format(date_create($tanggal_diambil), 'd-M-Y');
    }

    public function getTanggalDikembalikanAttribute($tanggal_dikembalikan)
    {
        return date_format(date_create($tanggal_dikembalikan), 'd-M-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_barang()
    {
        return $this->belongsTo(DetailBarang::class);
    }
}
