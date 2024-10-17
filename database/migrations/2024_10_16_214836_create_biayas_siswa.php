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
        Schema::create('biaya_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biaya_id')->constrained('biayas')->onDelete('cascade');  // Foreign key to biayas table
            $table->foreignId('siswa_id')->constrained('students')->onDelete('cascade');  // Foreign key to students table
            $table->enum('periode', ['bulanan', 'tahunan']);  // Monthly or yearly fee
            $table->integer('jumlah');  // Total fee amount for the student
            $table->date('tanggal_mulai')->nullable();  // Start date for the fee
            $table->date('tanggal_akhir')->nullable();  // End date for the fee (if applicable)
            $table->enum('status', ['lunas', 'belum_lunas'])->default('belum_lunas');  // Payment status
            $table->boolean('is_angsur')->default(false);  // Indicates if payment is in installments
            $table->integer('jumlah_angsur')->nullable();  // Amount per installment (if paying in installments)
            $table->integer('jumlah_angsuran_total')->nullable();  // Total number of installments (if applicable)
            $table->integer('angsuran_terbayar')->default(0)->nullable(); // Number of installments paid
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biayas_siswa');
    }
};
