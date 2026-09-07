<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->string('keterangan');
            $table->string('kode_barang');
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onDelete('cascade');
            $table->integer('jumlah_masuk');
            $table->decimal('harga_satuan', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuk');
    }
};
