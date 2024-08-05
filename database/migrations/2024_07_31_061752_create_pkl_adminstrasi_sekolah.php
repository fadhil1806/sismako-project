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
        Schema::create('pkl_adminstrasi_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 10);
            $table->string('nama_perusahaan', 40);
            $table->string('path_foto_siswa_dan_perusahaan', 100);
            $table->string('path_foto_mov');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkl_adminstrasi_sekolah');
    }
};
