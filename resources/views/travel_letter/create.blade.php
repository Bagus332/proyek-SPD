@extends('layouts.main')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Data Perjalanan Dinas</h4>

    <form action="{{ route('travel.letter.store') }}" method="POST">
        @csrf

        {{-- --- DATA PEGAWAI --- --}}
        <h5 class="mt-4 mb-2">Data Pejabat & Pelaksana</h5>
        <div class="mb-3">
            <label for="nama_pejabat" class="form-label">Nama Pejabat Pembuat Komitmen (PPK)</label>
            <input type="text" name="ppk_nama" id="ppk_nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ppk_nip" class="form-label">NIP Pejabat Pembuat Komitmen</label>
            <input type="text" name="ppk_nip" id="ppk_nip" class="form-control">
        </div>

        <hr>

        <h5 class="mt-4 mb-2">Pegawai yang Melaksanakan Perjalanan Dinas</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Pegawai</label>
                <input type="text" name="pegawai_nama" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP Pegawai</label>
                <input type="text" name="pegawai_nip" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pangkat / Golongan</label>
                <input type="text" name="pegawai_pangkat_golongan" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="pegawai_jabatan" class="form-control">
            </div>
        </div>

        {{-- --- DATA PENGIKUT --- --}}
        <h5 class="mt-4 mb-2">Data Pengikut</h5>
        <div id="pengikutContainer">
            <div class="row mb-2 pengikut-item">
                <div class="col-md-5">
                    <input type="text" name="pengikut[0][nama]" class="form-control" placeholder="Nama Pengikut">
                </div>
                <div class="col-md-5">
                    <input type="text" name="pengikut[0][nip]" class="form-control" placeholder="NIP Pengikut">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger removePengikut w-100">Hapus</button>
                </div>
            </div>
        </div>
        <button type="button" id="addPengikut" class="btn btn-secondary btn-sm mb-3">+ Tambah Pengikut</button>

        {{-- --- DETAIL PERJALANAN --- --}}
        <h5 class="mt-4 mb-2">Detail Perjalanan Dinas</h5>
        <div class="mb-3">
            <label for="keperluan" class="form-label">Maksud / Keperluan</label>
            <textarea name="keperluan" id="keperluan" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="alat_angkut" class="form-label">Alat Angkutan yang Digunakan</label>
            <input type="text" name="alat_angkut" id="alat_angkut" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Berangkat</label>
                <input type="text" name="tempat_berangkat" class="form-control" value="Padang">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Tujuan</label>
                <input type="text" name="tempat_tujuan" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Berangkat</label>
                <input type="date" name="tanggal_berangkat" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Lama Perjalanan (hari)</label>
                <input type="number" name="lama_perjalanan" class="form-control" min="1">
            </div>
        </div>

        {{-- --- PEMBEBANAN ANGGARAN --- --}}
        <h5 class="mt-4 mb-2">Pembebanan Anggaran</h5>
        <div class="mb-3">
            <label class="form-label">Instansi</label>
            <input type="text" name="instansi" value="UIN Imam Bonjol Padang" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Akun</label>
            <input type="text" name="akun" value="525115" class="form-control">
        </div>

        {{-- --- KETERANGAN --- --}}
        <div class="mb-3">
            <label class="form-label">Keterangan Tambahan</label>
            <textarea name="keterangan" class="form-control" rows="2"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>

{{-- Script Tambah/Hapus Pengikut Dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let pengikutIndex = 1;

        document.getElementById('addPengikut').addEventListener('click', function () {
            const container = document.getElementById('pengikutContainer');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'pengikut-item');
            newRow.innerHTML = `
                <div class="col-md-5">
                    <input type="text" name="pengikut[${pengikutIndex}][nama]" class="form-control" placeholder="Nama Pengikut">
                </div>
                <div class="col-md-5">
                    <input type="text" name="pengikut[${pengikutIndex}][nip]" class="form-control" placeholder="NIP Pengikut">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger removePengikut w-100">Hapus</button>
                </div>
            `;
            container.appendChild(newRow);
            pengikutIndex++;
        });

        document.getElementById('pengikutContainer').addEventListener('click', function (e) {
            if (e.target.classList.contains('removePengikut')) {
                e.target.closest('.pengikut-item').remove();
            }
        });
    });
</script>
@endsection
