<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function keranjangdetail()
    // {
    //     return $this->belongsTo(KeranjangDetail::class, 'keranjang_id', 'id');
    // }

    // public function keranjangs()
    // {
    //     return $this->belongsTo(Keranjangs::class);
    // }
}
