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
        Schema::create('rekomendasi_lombas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_layanan')->default('Rekomendasi Lomba');

            // Data Diri
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Data Tambahan
            $table->string('nama_program');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');

            // Upload File
            $table->string('screenshot');
            $table->string('transkrip_nilai');
            $table->string('format_khusus');

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
        Schema::table('rekomendasi_lombas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
