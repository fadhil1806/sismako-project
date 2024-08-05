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
        Schema::create('data_kelulusan', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_pelajaran', 40);
            $table->bigInteger('id_siswa')->unsigned(); // Ensure this is bigInteger
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->string('jurusan', 30);
            $table->date('tanggal_kelulusan');
            $table->integer('angkatan');
            $table->string('karir_selanjutnya', 100);
            $table->string('no_hp', 20);
            $table->string('email', 50);
            $table->string('path_foto', 70);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelulusan');
    }
};
