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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_lengkap', 255);
            $table->string('nik', 20);
            $table->string('nuptk', 20);
            $table->string('status_kepegawaian', 50);
            $table->string('jenis_kelamin', 10);
            $table->string('tugas', 100);
            $table->string('penempatan', 100);
            $table->date('tanggal_lahir');
            $table->string('nomor_handphone', 15);
            $table->string('email', 255)->unique();
            $table->string('email_madrasah', 255)->nullable();
            $table->string('password_awal', 255);
            $table->string('foto_profile')->nullable();
            $table->timestamps(); // created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
