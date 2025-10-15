<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Surat Perjalanan Dinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2>Formulir Surat Tugas Perjalanan Dinas</h2>
        <p>Aplikasi ini akan men-generate surat sesuai dengan template dari Fakultas Sains dan Teknologi UIN Imam Bonjol Padang.</p>

        <form action="{{ route('travel.letter.store') }}" method="POST" class="mt-4">
            @csrf
            {{-- Data Dosen --}}
            <fieldset class="border p-3 mb-3">
                <legend class="float-none w-auto p-2 fs-6">Data Dosen</legend>
                <div class="mb-3">
                    <label for="lecturer_name" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" id="lecturer_name" name="lecturer_name" required>
                </div>
                <div class="mb-3">
                    <label for="lecturer_nip" class="form-label">NIP Dosen</label>
                    <input type="text" class="form-control" id="lecturer_nip" name="lecturer_nip" required>
                </div>
                <div class="mb-3">
                    <label for="lecturer_rank" class="form-label">Pangkat/Golongan</label>
                    <input type="text" class="form-control" id="lecturer_rank" name="lecturer_rank" required placeholder="Contoh: Penata Muda Tk. I / III B">
                </div>
            </fieldset>

            {{-- Detail Perjalanan --}}
            <fieldset class="border p-3 mb-3">
                <legend class="float-none w-auto p-2 fs-6">Detail Perjalanan</legend>
                <div class="mb-3">
                    <label for="purpose" class="form-label">Maksud Perjalanan</label>
                    <textarea class="form-control" id="purpose" name="purpose" rows="3" required placeholder="Contoh: Mengikuti kegiatan Workshop..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Tujuan / Lokasi</label>
                    <input type="text" class="form-control" id="destination" name="destination" required placeholder="Contoh: Hotel Grand Zuri, Padang">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Berangkat</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="vehicle" class="form-label">Alat Angkut yang Digunakan</label>
                    <input type="text" class="form-control" id="vehicle" name="vehicle" required placeholder="Contoh: Kendaraan Umum">
                </div>
            </fieldset>

            {{-- Dasar Surat --}}
             <fieldset class="border p-3 mb-3">
                <legend class="float-none w-auto p-2 fs-6">Dasar Surat</legend>
                 <div class="mb-3">
                    <label for="dipa_number" class="form-label">Nomor DIPA</label>
                    <input type="text" class="form-control" id="dipa_number" name="dipa_number" required placeholder="Contoh: DIPA UIN Imam Bonjol Padang Nomor...">
                </div>
                <div class="mb-3">
                    <label for="dipa_date" class="form-label">Tanggal DIPA</label>
                    <input type="date" class="form-control" id="dipa_date" name="dipa_date" required>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Buat Surat</button>
            <a href="{{ route('travel.letter.index') }}" class="btn btn-secondary">Lihat Daftar Surat</a>
        </form>
    </div>
</body>
</html>