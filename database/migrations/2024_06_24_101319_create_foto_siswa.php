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
        Schema::create('foto_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned(); // Ensure this is bigInteger
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->enum('jenis_foto', ['X', 'XI', 'XII']);
            $table->string('path_file', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_siswa');
    }
};
