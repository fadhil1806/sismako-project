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
        Schema::create('patroli_asrama', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('area', 100);
            $table->string('dokumentasi', 100)->nullable();
            $table->enum('status_patroli', ['kebersihan','keamanan', 'kamar asrama']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patroli_asrama');
    }
};
