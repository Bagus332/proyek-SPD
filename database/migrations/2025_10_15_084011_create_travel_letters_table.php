<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_letters', function (Blueprint $table) {
            $table->id();

            // Data PPK
            $table->string('ppk_nama');
            $table->string('ppk_nip');

            // Data Pegawai Pelaksana
            $table->string('pegawai_nama');
            $table->string('pegawai_nip');
            $table->string('pegawai_pangkat_golongan')->nullable();
            $table->string('pegawai_jabatan')->nullable();

            // Data Pengikut (JSON)
            $table->json('pengikut')->nullable();

            // Detail Perjalanan
            $table->text('keperluan');
            $table->string('alat_angkut')->nullable();
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->integer('lama_perjalanan')->nullable();

            // Anggaran
            $table->string('instansi')->nullable();
            $table->string('akun')->nullable();

            // Keterangan tambahan
            $table->text('keterangan')->nullable();

            // File hasil generate
            $table->string('file_surat_tugas')->nullable();
            $table->string('file_spd')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_letters');
    }
};
