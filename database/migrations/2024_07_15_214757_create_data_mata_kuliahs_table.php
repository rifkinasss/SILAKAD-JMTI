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
        Schema::create('data_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_layanan')->default('Permohonan Data Mata Kuliah');

            // Data Diri
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Nama Anggota
            $table->string('nama_anggota_1')->nullable();
            $table->string('nim_anggota_1', 8)->nullable();
            $table->string('nama_anggota_2')->nullable();
            $table->string('nim_anggota_2', 8)->nullable();
            $table->string('nama_anggota_3')->nullable();
            $table->string('nim_anggota_3', 8)->nullable();
            $table->string('nama_anggota_4')->nullable();
            $table->string('nim_anggota_4', 8)->nullable();
            // Data Mitra
            $table->string('nama_mitra');
            // Alamat Mitra
            $table->string('alamat_mitra');

            // Periode Pelaksanaan
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');

            // Dosen Pembimbing
            $table->string('dosen_pembimbing');

            // Data yang di butuhkan
            $table->string('data_yang_dibutuhkan');

            // Nama Matkul
            $table->string('nama_matkul');

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
        Schema::table('data_mata_kuliahs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
