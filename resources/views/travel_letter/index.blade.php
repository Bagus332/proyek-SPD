@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Perjalanan Dinas / Surat Perjalanan Dinas</h4>

    <a href="{{ route('travel.letter.create') }}" class="btn btn-primary">
        + Tambah Surat
    </a>
</div>

<div class="card">
    <div class="card-body">
        {{-- Input pencarian --}}
        <div class="mb-3">
            <input type="text" class="form-control" id="searchTravel" placeholder="Cari...">
        </div>

        {{-- Daftar Surat --}}
        <table class="table" id="travelTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Surat</th>
                    <th>Nama Pegawai</th>
                    <th>Tujuan</th>
                    <th>Aksi</th>
                    <th>Lanjutan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($letters as $letter)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $letter->letter_number }}</td>
                        <td>{{ $letter->pegawai_nama }}</td>
                        <td>{{ $letter->tempat_tujuan }}</td>
                        <td>
                            {{-- Tombol cetak --}}
                            <a href="{{ route('travel.letter.print.surat_tugas', $letter->id) }}"
                                class="btn btn-primary btn-sm">Cetak Surat Tugas</a>
                            <a href="{{ route('travel.letter.print.spd', $letter->id) }}"
                                class="btn btn-success btn-sm">Cetak SPD</a>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm toggle-detail" data-id="{{ $letter->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Baris detail tersembunyi --}}
                    <tr id="detail-{{ $letter->id }}" class="detail-row" style="display: none; background-color: #f9f9f9;">
                        <td colspan="5">
                            <div class="p-3 border rounded">
                                <h6 class="fw-bold mb-2">Detail Surat Perjalanan Dinas</h6>
                                <p><strong>No Surat:</strong> {{ $letter->letter_number }}</p>
                                <p><strong>Nama Pegawai:</strong> {{ $letter->pegawai_nama }}</p>
                                <p><strong>Tujuan:</strong> {{ $letter->tempat_tujuan }}</p>
                                <p><strong>Keperluan:</strong> {{ $letter->keperluan ?? '-' }}</p>
                                <p><strong>Tanggal Berangkat:</strong> {{ $letter->tanggal_berangkat ?? '-' }}</p>
                                <p><strong>Tanggal Kembali:</strong> {{ $letter->tanggal_kembali ?? '-' }}</p>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi pencarian
    document.getElementById("searchTravel").addEventListener("input", function() {
        var searchTerm = this.value.toLowerCase();
        var rows = document.querySelectorAll("#travelTable tbody tr:not(.detail-row)");

        rows.forEach(function(row) {
            var cells = row.getElementsByTagName("td");
            var matchFound = false;

            for (var i = 0; i < cells.length - 1; i++) {
                if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                    matchFound = true;
                    break;
                }
            }

            // Sembunyikan juga detail-row-nya
            row.style.display = matchFound ? "" : "none";
            var detailRow = document.querySelector('#detail-' + row.querySelector('.toggle-detail')?.dataset.id);
            if (detailRow) detailRow.style.display = matchFound ? detailRow.style.display : "none";
        });
    });

    // Toggle detail row
    document.querySelectorAll('.toggle-detail').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.dataset.id;
            var detailRow = document.getElementById('detail-' + id);

            // Sembunyikan semua detail lain
            document.querySelectorAll('.detail-row').forEach(r => {
                if (r !== detailRow) r.style.display = "none";
            });

            // Toggle tampilan baris ini
            detailRow.style.display = (detailRow.style.display === "none") ? "table-row" : "none";
        });
    });
});
</script>
@endsection
