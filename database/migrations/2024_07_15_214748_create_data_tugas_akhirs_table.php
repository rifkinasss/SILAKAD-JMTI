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
        Schema::create('data_tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_layanan')->default('Permohonan Data Tugas Akhir');

            // Data Diri
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Data Mitra
            $table->string('nama_mitra');

            // Alamat Mitra
            $table->string('alamat_mitra');

            // Periode Pelaksanaan
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');

            // Judul
            $table->string('judul_tugas_akhir');

            // Dosen Pembimbing
            $table->string('dosen_pembimbing');

            // Data yang di butuhkan
            $table->string('data_yang_dibutuhkan');

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
        Schema::table('data_tugas_akhirs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
