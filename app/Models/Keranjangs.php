<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjangs extends Model
{
    use HasFactory;

    protected $fillable = ["jumlah_pemesanan", "keterangan", "produk_id"];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
