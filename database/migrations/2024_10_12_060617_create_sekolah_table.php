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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 100);
            $table->string('npsn', 10);
            $table->string('nss', 15)->nullable();
            $table->string('kode_pos', 5);
            $table->string('nomor_telpon', 13)->nullable();
            $table->string('alamat');
            $table->string('website', 100)->nullable();
            $table->string('email', 35)->nullable();
            $table->string('logo');
            $table->string('kepala_sekolah', 100);
            $table->string('nip_kepala_sekolah', 18)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
