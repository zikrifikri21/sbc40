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
        Schema::table('bc40_import', function (Blueprint $table) {
            $table->integer('id_users');
            $table->foreign('id_users')->references('id_users')->on('tbl_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bc40_import', function (Blueprint $table) {
            $table->dropColumn('id_users');
        });
    }
};
