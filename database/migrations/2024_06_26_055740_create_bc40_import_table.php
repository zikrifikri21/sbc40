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
        Schema::create('bc40_import', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bc40')->nullable();
            $table->datetime('tanggal_bc40')->nullable();
            $table->string('npwp_pengusaha', 30)->nullable();
            $table->string('nama_pengusaha', 255)->nullable();
            $table->string('npwp_pengirim', 30)->nullable();
            $table->string('nama_pengirim', 255)->nullable();
            $table->string('npwp_supplier', 30)->nullable();
            $table->string('nama_supplier', 255)->nullable();
            $table->string('uraian_barang', 255)->nullable();
            $table->string('pos_tarif', 255)->nullable();
            $table->integer('jumlah_satuan')->nullable();
            $table->string('kode_satuan')->nullable();
            $table->bigInteger('harga_penyerahan')->nullable();
            $table->decimal('kadar_final', 5, 2)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bc40_import');
    }
};