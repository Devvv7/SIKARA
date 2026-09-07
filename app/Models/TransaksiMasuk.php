<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiMasuk extends Model
{
    protected $table = 'transaksi_masuk';

    protected $fillable = [
        'tanggal_masuk',
        'keterangan',
        'kode_barang',
        'jumlah_masuk',
        'harga_satuan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga_satuan' => 'decimal:2',
    ];

    /**
     * @return BelongsTo<Barang, $this>
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(
            Barang::class,
            'kode_barang',
            'kode_barang'
        );
    }
}
