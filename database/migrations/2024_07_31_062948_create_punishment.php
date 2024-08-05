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
        Schema::create('punishment', function (Blueprint $table) {
            $table->id();
            $table->integer('angkatan');
            $table->date('tanggal');
            $table->bigInteger('id_siswa')->unsigned(); // Ensure this is bigInteger
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->string('jenis_pelanggaran', 75);
            $table->text('kronologi');
            $table->string('tindak_lanjut');
            $table->string('pengawasan_guru', 50);
            $table->integer('pengurangan_point');
            $table->string('path_dokumen', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punishment');
    }
};
