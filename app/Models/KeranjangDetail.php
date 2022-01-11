<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    use HasFactory;

    protected $fillable = ['keranjang_id'];

    public function keranjangs()
    {
        return $this->hasMany(Keranjangs::class, 'keranjang_id', 'id');
    }
}
