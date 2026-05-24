<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'stok',
        'harga',
        'kondisi',
        'lokasi',
        'deskripsi',
        'image',
        'users_id',
    ];

    // Relasi: 1 Item dimiliki oleh (belongsTo) 1 User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}