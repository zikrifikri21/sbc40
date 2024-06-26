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
        Schema::create('bc40_edits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bc40_id')->constrained('bc40_import')->onDelete('cascade');
            $table->integer('id_users');
            $table->foreign('id_users')->references('id_users')->on('tbl_users')->onDelete('cascade');
            $table->timestamp('edited_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bc40_edits');
    }
};
