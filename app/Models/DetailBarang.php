<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBarang extends Model
{
    protected $table = 'detail_barang';

    protected $fillable = [
        'tanggal_masuk',
        'harga',
        'stok',
        'kode_barang',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
