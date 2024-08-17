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
        Schema::create('dokumentasi_jamaah_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('kelas', 10);
            $table->date('tanggal');
            $table->string('path_dokumentasi', 100);
            $table->enum('sholat', ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_jamaah_siswa');
    }
};
