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
        Schema::create('ket_telah_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_layanan')->default('Keterangan Telah Tugas Akhir');

            // Data Diri
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Judul Tugas Akhir
            $table->string('judul_tugas_akhir');

            $table->string('nama_pembimbing_utama');
            $table->string('nama_pembimbing_pendamping');

            // Status
            $table->string('status')->default('pending');
            $table->string('keterangan')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ket_telah_tugas_akhirs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
