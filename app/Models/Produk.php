<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'harga', 'status', 'gambar', 'kategori'];

    public function keranjangs()
    {
        return $this->hasMany(Keranjangs::class);
    }
}
