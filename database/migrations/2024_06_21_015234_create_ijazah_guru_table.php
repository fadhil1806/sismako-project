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
        Schema::create('ijazah_guru', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id')->on('guru')->cascadeOnDelete();
            $table->enum('jenis_ijazah', ['SMP', 'SMA', 'S1', 'S2', 'S3']);
            $table->string('nama_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijazah_guru');
    }
};
