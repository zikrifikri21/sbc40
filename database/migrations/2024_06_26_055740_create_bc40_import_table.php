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
            $table->integer('nomor_bc40');
            $table->date('tanggal_bc40');
            $table->string('npwp_pengusaha', 15);
            $table->string('nama_pengusaha', 255);
            $table->string('npwp_pengirim', 15);
            $table->string('nama_pengirim', 255);
            $table->string('nomor_aju', 30)->nullable();
            $table->string('kode_kantor', 10)->nullable();
            $table->string('kode_barang', 20);
            $table->string('uraian_barang', 255);
            $table->bigInteger('harga_penyerahan');
            $table->decimal('kadar_final', 5, 2)->nullable();
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
