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
        Schema::create('data_mutasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->enum('status', ['Guru', 'Siswa']);
            $table->enum('mutasi', ['Masuk', 'Keluar']);
            $table->date('tanggal_mutasi');
            $table->string('asal_sekolah', 50)->nullable();
            $table->string('tujuan_berikutnya', 50)->nullable();
            $table->text('alasan');
            $table->string('path_dokumen_pendukung_tambahan', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mutasi');
    }
};
