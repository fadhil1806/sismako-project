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
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned(); // Ensure this is bigInteger
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->integer('angkatan');
            $table->string('tahun_pelajaran', 20);
            $table->enum('kelas', ['X', 'XI', 'XII', 'XIII', 'Lulus'])->nullable();
            $table->string('jurusan', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};
