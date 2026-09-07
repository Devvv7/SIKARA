<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $table = 'barang';

    protected $primaryKey = 'kode_barang';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'stok',
    ];

    /**
     * @return HasMany<DetailBarang, $this>
     */
    public function detailBarang(): HasMany
    {
        return $this->hasMany(
            DetailBarang::class,
            'kode_barang',
            'kode_barang'
        );
    }

    /**
     * @return HasMany<TransaksiMasuk, $this>
     */
    public function transaksiMasuk(): HasMany
    {
        return $this->hasMany(
            TransaksiMasuk::class,
            'kode_barang',
            'kode_barang'
        );
    }

    /**
     * @return HasMany<TransaksiKeluar, $this>
     */
    public function transaksiKeluar(): HasMany
    {
        return $this->hasMany(
            TransaksiKeluar::class,
            'kode_barang',
            'kode_barang'
        );
    }
}
