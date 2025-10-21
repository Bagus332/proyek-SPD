<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelLetter extends Model
{
    use HasFactory;

    protected $table = 'travel_letters';

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     */
    protected $fillable = [
        // Data Pejabat Pembuat Komitmen (PPK)
        'ppk_nama',
        'ppk_nip',

        // Data Pegawai Pelaksana
        'pegawai_nama',
        'pegawai_nip',
        'pegawai_pangkat_golongan',
        'pegawai_jabatan',

        // Data Pengikut (bisa lebih dari satu, disimpan dalam JSON)
        'pengikut',

        // Detail Perjalanan
        'keperluan',
        'alat_angkut',
        'tempat_berangkat',
        'tempat_tujuan',
        'tanggal_berangkat',
        'tanggal_kembali',
        'lama_perjalanan',

        // Anggaran
        'instansi',
        'akun',

        // Keterangan tambahan
        'keterangan',

        // File PDF yang dihasilkan
        'file_surat_tugas',
        'file_spd',
    ];

    /**
     * Pastikan kolom JSON otomatis dikonversi ke array saat diakses.
     */
    protected $casts = [
        'pengikut' => 'array',
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];
}