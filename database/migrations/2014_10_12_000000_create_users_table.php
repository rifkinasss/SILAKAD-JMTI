<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 8)->nullable();
            $table->string('nip', 19)->nullable();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['admin', 'tendik', 'mahasiswa']);
            $table->string('status')->default('aktif');
            $table->string('semester')->nullable();
            $table->string('ipk', 5, 2)->nullable();
            $table->string('sks_tempuh')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('jurusan')->default('Matematika dan Teknologi Informasi');
            $table->string('no_hp', 13)->unique()->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            'nama_lengkap' => 'Admin SILAKAD JMTI',
            'email' => 'admin@silakad-jmti.my.id',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
