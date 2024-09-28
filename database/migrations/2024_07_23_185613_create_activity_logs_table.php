<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('data_tugas_akhir_id')->nullable();
            $table->unsignedBigInteger('data_mata_kuliah_id')->nullable();
            $table->unsignedBigInteger('ket_telah_tugas_akhir_id')->nullable();
            $table->unsignedBigInteger('rekomendasi_lomba_id')->nullable();
            $table->unsignedBigInteger('rekomendasi_beasiswa_id')->nullable();
            $table->string('jenis_layanan');
            $table->string('status');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('data_tugas_akhir_id')->references('id')->on('data_tugas_akhirs')->onDelete('cascade');
            $table->foreign('data_mata_kuliah_id')->references('id')->on('data_mata_kuliahs')->onDelete('cascade');
            $table->foreign('ket_telah_tugas_akhir_id')->references('id')->on('ket_telah_tugas_akhirs')->onDelete('cascade');
            $table->foreign('rekomendasi_lomba_id')->references('id')->on('rekomendasi_lombas')->onDelete('cascade');
            $table->foreign('rekomendasi_beasiswa_id')->references('id')->on('rekomendasi_beasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
