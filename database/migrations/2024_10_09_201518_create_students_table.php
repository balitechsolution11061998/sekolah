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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 255);
            $table->string('nisn', 20);
            $table->string('nik', 20);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('tingkat_rombel', 100);
            $table->integer('umur');
            $table->string('status', 50);
            $table->string('jenis_kelamin', 10);
            $table->text('alamat');
            $table->string('no_telepon', 15);
            $table->string('kebutuhan_khusus', 100)->nullable();
            $table->string('disabilitas', 100)->nullable();
            $table->string('nomor_kip_pip', 50)->nullable();
            $table->string('nama_ayah', 255);
            $table->string('nama_ibu', 255);
            $table->string('nama_wali', 255)->nullable();
            $table->string('foto_profile')->nullable(); // Image field

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
