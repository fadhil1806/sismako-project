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
        Schema::create('data_prestasi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama', 50);
            $table->enum('status', ['Guru', 'Siswa']);
            $table->enum('kelas', ['X', 'XI', 'XII', 'XIII'])->nullable();
            $table->date('tanggal_lomba');
            $table->string('tempat_lomba');
            $table->string('peringkat', 40);
            $table->string('nama_file', 75);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_prestasi');
    }
};
