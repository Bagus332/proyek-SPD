<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Surat Perjalanan Dinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .lecturer-item .form-label { font-size: .9rem; }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card p-4">
            <h2 class="mb-3">Formulir Surat Tugas</h2>

            {{-- ================================================== --}}
            {{-- || START: BLOK PENAMPIL ERROR YANG DITAMBAHKAN || --}}
            {{-- ================================================== --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <strong>Gagal menyimpan data. Silakan periksa isian Anda:</strong>
                    <ul class="mb-0">
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

                {{-- Daftar Dosen (dropdown dihapus, input manual saja) --}}
                <fieldset class="border p-3 mb-3">
                    <legend class="float-none w-auto p-2 fs-6">Daftar Pejabat yang Bertugas</legend>
                    <div id="lecturer-list">
                        @if(old('lecturers'))
                            @foreach(old('lecturers') as $i => $oldLect)
                                <div class="lecturer-item mb-3" data-index="{{ $i }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Pejabat</label>
                                            <input type="text" name="lecturers[{{ $i }}][name]" class="form-control name-input" value="{{ $oldLect['name'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIP</label>
                                            <input type="text" name="lecturers[{{ $i }}][nip]" class="form-control nip-input" value="{{ $oldLect['nip'] ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label class="form-label">Pangkat / Golongan</label>
                                            <input type="text" name="lecturers[{{ $i }}][rank]" class="form-control rank-input" value="{{ $oldLect['rank'] ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan</label>
                                            <input type="text" name="lecturers[{{ $i }}][position]" class="form-control position-input" value="{{ $oldLect['position'] ?? '' }}">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-lecturer w-100" {{ count(old('lecturers')) == 1 ? 'disabled' : '' }}>Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="lecturer-item mb-3" data-index="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Pejabat</label>
                                        <input type="text" name="lecturers[0][name]" class="form-control name-input" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIP</label>
                                        <input type="text" name="lecturers[0][nip]" class="form-control nip-input" required>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label class="form-label">Pangkat / Golongan</label>
                                        <input type="text" name="lecturers[0][rank]" class="form-control rank-input">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="lecturers[0][position]" class="form-control position-input">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-lecturer w-100" disabled>Hapus</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-lecturer" class="btn btn-success mt-2">Tambah pejabat</button>
                </fieldset>

                <button type="submit" class="btn btn-primary">Input</button>
            </form>
        </div>
    </div>

    <!-- jQuery only (Select2 JS removed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            // Simple add/remove/reindex logic (dropdown removed)
            let nextIndex = $('#lecturer-list .lecturer-item').length || 1;

            $('#add-lecturer').on('click', function () {
                const idx = nextIndex++;
                const $row = $(`
                    <div class="lecturer-item mb-3" data-index="${idx}">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pejabat</label>
                                <input type="text" name="lecturers[${idx}][name]" class="form-control name-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIP</label>
                                <input type="text" name="lecturers[${idx}][nip]" class="form-control nip-input" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="form-label">Pangkat / Golongan</label>
                                <input type="text" name="lecturers[${idx}][rank]" class="form-control rank-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="lecturers[${idx}][position]" class="form-control position-input">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-lecturer w-100">Hapus</button>
                            </div>
                        </div>
                    </div>
                `);
                $('#lecturer-list').append($row);
                updateRemoveButtons();
            });

            $('#lecturer-list').on('click', '.remove-lecturer', function () {
                $(this).closest('.lecturer-item').remove();
                updateRemoveButtons();
            });

            function updateRemoveButtons() {
                const removeButtons = $('#lecturer-list').find('.remove-lecturer');
                if (removeButtons.length === 1) removeButtons.prop('disabled', true);
                else removeButtons.prop('disabled', false);

                // Re-index rows and update input names
                $('#lecturer-list .lecturer-item').each(function (i) {
                    $(this).attr('data-index', i);
                    $(this).find('.name-input').attr('name', `lecturers[${i}][name]`);
                    $(this).find('.nip-input').attr('name', `lecturers[${i}][nip]`);
                    $(this).find('.rank-input').attr('name', `lecturers[${i}][rank]`);
                    $(this).find('.position-input').attr('name', `lecturers[${i}][position]`);
                });

                // reset nextIndex to be consistent
                nextIndex = $('#lecturer-list .lecturer-item').length;
            }

            updateRemoveButtons();
        });
    </script>
</body>
</html>