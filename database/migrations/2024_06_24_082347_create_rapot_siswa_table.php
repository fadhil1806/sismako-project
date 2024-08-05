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
        Schema::create('rapot_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned(); // Ensure this is bigInteger
            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->enum('rapot_kelas', ['VII', 'VIII', 'IX']);
            $table->string('path_file', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapot_siswa');
    }
};
