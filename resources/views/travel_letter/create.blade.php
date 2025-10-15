<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Surat Perjalanan Dinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2>Formulir Surat Tugas</h2>

        {{-- ================================================== --}}
        {{-- || START: BLOK PENAMPIL ERROR YANG DITAMBAHKAN || --}}
        {{-- ================================================== --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <strong>Gagal menyimpan data. Silakan periksa isian Anda:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ================================================ --}}
        {{-- || END: BLOK PENAMPIL ERROR YANG DITAMBAHKAN || --}}
        {{-- ================================================ --}}

        <form action="{{ route('travel.letter.store') }}" method="POST" class="mt-4">
            @csrf

            {{-- Detail Perjalanan & Dasar Surat --}}
            <fieldset class="border p-3 mb-3">
                <legend class="float-none w-auto p-2 fs-6">Detail Surat</legend>
                 <div class="mb-3">
                    <label for="purpose" class="form-label">Maksud Perjalanan</label>
                    <textarea class="form-control" name="purpose" rows="3" required>{{ old('purpose') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Tujuan / Lokasi</label>
                    <input type="text" class="form-control" name="destination" value="{{ old('destination') }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Berangkat</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="vehicle" class="form-label">Alat Angkut</label>
                    <input type="text" class="form-control" name="vehicle" value="{{ old('vehicle') }}" required>
                </div>
                 <div class="mb-3">
                    <label for="dipa_number" class="form-label">Nomor DIPA</label>
                    <input type="text" class="form-control" name="dipa_number" value="{{ old('dipa_number') }}" required>
                </div>
                <div class="mb-3">
                    <label for="dipa_date" class="form-label">Tanggal DIPA</label>
                    <input type="date" class="form-control" name="dipa_date" value="{{ old('dipa_date') }}" required>
                </div>
            </fieldset>

            {{-- Daftar Dosen --}}
            <fieldset class="border p-3 mb-3">
                <legend class="float-none w-auto p-2 fs-6">Daftar Pejabat yang Bertugas</legend>
                <div id="lecturer-list">
                    {{-- Baris pertama untuk isian dosen --}}
                    <div class="lecturer-item row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nama Pejabat pembuat komitmen</label>
                            <input type="text" name="lecturers[0][name]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="lecturers[0][nip]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pangkat dan Golongan</label>
                            <input type="text" name="lecturers[0][rank]" class="form-control" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-lecturer" disabled>Hapus</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-lecturer" class="btn btn-success mt-2">Tambah pejabat</button>
            </fieldset>

            <button type="submit" class="btn btn-primary">Input</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let lecturerIndex = 1;
            const lecturerList = document.getElementById('lecturer-list');

            document.getElementById('add-lecturer').addEventListener('click', function () {
                const newItem = document.createElement('div');
                newItem.classList.add('lecturer-item', 'row', 'mb-3');
                newItem.innerHTML = `
                    <div class="col-md-4">
                        <label class="form-label">Nama Pejabat</label>
                        <input type="text" name="lecturers[${lecturerIndex}][name]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIP</label>
                        <input type="text" name="lecturers[${lecturerIndex}][nip]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pangkat dan Golongan</label>
                        <input type="text" name="lecturers[${lecturerIndex}][rank]" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-lecturer">Hapus</button>
                    </div>
                `;
                lecturerList.appendChild(newItem);
                lecturerIndex++;
                updateRemoveButtons();
            });

            lecturerList.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-lecturer')) {
                    e.target.closest('.lecturer-item').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                const removeButtons = lecturerList.querySelectorAll('.remove-lecturer');
                removeButtons.forEach((button, index) => {
                    button.disabled = removeButtons.length === 1;
                });
            }
            updateRemoveButtons();
        });
    </script>
</body>
</html>