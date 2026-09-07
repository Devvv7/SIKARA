<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiKeluar extends Model
{
    protected $table = 'transaksi_keluar';

    protected $fillable = [
        'tanggal_keluar',
        'keterangan',
        'kode_barang',
        'jumlah_keluar',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
