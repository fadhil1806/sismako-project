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
        Schema::create('pkl_adminstrasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('nisn', 20);
            $table->string('tempat_pkl', 50);
            $table->string('path_rekap_kehadiran', 100);
            $table->string('path_jurnal_pkl', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkl_adminstrasi_siswa');
    }
};
