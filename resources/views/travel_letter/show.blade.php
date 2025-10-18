<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Tugas - {{ $letter->letter_number }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; background-color: #f0f0f0; }
        .paper-container {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            page-break-after: always; /* Memberi jeda halaman setelah setiap surat */
        }
        .paper-container:last-child { page-break-after: auto; }
        .header-table { width: 100%; border-bottom: 3px solid black; padding-bottom: 10px; }
        .header-table td { text-align: center; }
        .header-table img { width: 80px; }
        .header-table .kop-title { font-weight: bold; }
        .header-table .kop-address { font-size: 9pt; }
        .title { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 30px; }
        .letter-number { text-align: center; }
        .content-table { width: 100%; margin-top: 20px; }
        .content-table td { vertical-align: top; }
        .content-table .label { width: 15%; }
        .content-table .separator { width: 5%; }
        .signature-section { width: 40%; float: right; text-align: left; margin-top: 50px; }
        .clear { clear: both; }
        .btn-group { text-align: center; margin: 20px auto 50px; width: 21cm; }
        @media print {
            body { background-color: white; }
            .paper-container { margin: 0; box-shadow: none; border: none; }
            .btn-group { display: none; }
        }
    </style>
</head>
<body>

    {{-- Tombol Cetak & Buat Baru --}}
    <div class="btn-group">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Cetak Semua Halaman</button>
        <a href="{{ route('travel.letter.create') }}" style="padding: 10px 20px; font-size: 16px; margin-left: 10px;">Buat Surat Baru</a>
    </div>

    {{-- HALAMAN INDIVIDUAL UNTUK SETIAP DOSEN --}}
    @foreach ($letter->lecturers as $lecturer)
    <div class="paper-container">
        {{-- KOP SURAT --}}
        <table class="header-table">
            <tr>
                <td><img src="{{ asset('UIN_LOGO.png') }}" alt="Logo"></td>
                <td>
                    <div class="kop-title">KEMENTERIAN AGAMA REPUBLIK INDONESIA</div>
                    <div class="kop-title">UNIVERSITAS ISLAM NEGERI (UIN) IMAM BONJOL PADANG</div>
                    <div class="kop-title">FAKULTAS SAINS DAN TEKNOLOGI</div>
                    <div class="kop-address">Alamat: Sungai Bangek Kelurahan Balai Gadang Kecamatan Koto Tangah Kota Padang</div>
                    <div class="kop-address">Website: https://saintek.uinib.ac.id – e-mail: admin-fst@uinib.ac.id</div>
                </td>
            </tr>
        </table>

        <h4 class="title">SURAT TUGAS</h4>
        <p class="letter-number">Nomor : {{ $letter->letter_number }}</p>

        <p style="text-align: center; margin-top: 20px;">DEKAN FAKULTAS SAINS DAN TEKNOLOGI</p>

        {{-- Menimbang & Dasar --}}
        <table class="content-table">
            <tr>
                <td class="label">Menimbang</td> <td class="separator">:</td>
                <td>
                    <table style="width: 100%">
                        <tr><td style="width: 5%; vertical-align: top;">a.</td><td>bahwa sehubungan dengan kegiatan {{ $letter->purpose }}, maka perlu diutus pihak terkait untuk kegiatan tersebut;</td></tr>
                        <tr><td style="width: 5%; vertical-align: top;">b.</td><td>bahwa Saudara yang namanya tersebut di bawah ini dipandang cakap dan memenuhi syarat untuk kegiatan tersebut.</td></tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="3" style="height: 10px;"></td></tr>
            <tr>
                <td class="label">Dasar</td> <td class="separator">:</td>
                <td>
                    <table style="width: 100%">
                        <tr><td style="width: 5%; vertical-align: top;">1.</td><td>KMA RI No.9 Tahun 2016 tentang Pedoman Tata Naskah Dinas pada Kementerian Agama RI;</td></tr>
                        <tr><td style="width: 5%; vertical-align: top;">2.</td><td>Peraturan Menteri Agama RI Nomor 6 Tahun 2018 tanggal 21 Februari 2018 tentang Perjalanan Dinas Pada Kementerian Agama;</td></tr>
                        <tr><td style="width: 5%; vertical-align: top;">3.</td><td>Permendikbud Nomor 3 Tahun 2020 tentang Standar PTKI pada Standar Proses Pembelajaran;</td></tr>
                        <tr><td style="width: 5%; vertical-align: top;">4.</td><td>DIPA {{ $letter->dipa_number }} tanggal {{ \Carbon\Carbon::parse($letter->dipa_date)->isoFormat('D MMMM YYYY') }}.</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Memberi Tugas</h4>

        <table class="content-table">
             <tr>
                <td class="label">Kepada</td><td class="separator">:</td>
                <td>
                    <table style="width: 100%;">
                        <tr><td style="width: 25%;">Nama</td><td>: {{ $lecturer->name }}</td></tr>
                        <tr><td>NIP</td><td>: {{ $lecturer->nip }}</td></tr>
                        <tr><td>Pangkat/Gol</td><td>: {{ $lecturer->rank }}</td></tr>
                        <tr><td>Jabatan</td><td>: {{ $lecturer->position ?? 'Dosen' }}</td></tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="3" style="height: 10px;"></td></tr>
            <tr>
                <td class="label">Untuk</td><td class="separator">:</td>
                <td>Melaksanakan perjalanan dinas dalam rangka {{ $letter->purpose }} yang akan dilaksanakan di {{ $letter->destination }} pada tanggal {{ \Carbon\Carbon::parse($letter->start_date)->isoFormat('D MMMM YYYY') }} s.d {{ \Carbon\Carbon::parse($letter->end_date)->isoFormat('D MMMM YYYY') }}.</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Setelah selesai melaksanakan tugas ini segera membuat laporan tertulis kepada pimpinan terkait.</p>
        <p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya.</p>

        {{-- Tanda Tangan --}}
        <div class="signature-section">
            Padang, {{ \Carbon\Carbon::parse($letter->created_at)->isoFormat('D MMMM YYYY') }}<br>
            Dekan,
            <br><br><br><br><br>
            <strong style="text-decoration: underline;">Dr. Nurus Shalihin, M.Si.</strong><br>
            NIP. 197507222003121003
        </div>
        <div class="clear"></div>
    </div>
    @endforeach


    {{-- HALAMAN GABUNGAN (DITAMPILKAN SELALU; jika 1 pegawai akan berisi 1 baris bernomor) --}}
    <div class="paper-container">
         {{-- KOP SURAT --}}
         <table class="header-table">
             <tr>
                 <td><img src="{{ asset('UIN_LOGO.jpg') }}" alt="Logo"></td>
                 <td>
                     <div class="kop-title">KEMENTERIAN AGAMA REPUBLIK INDONESIA</div>
                     <div class="kop-title">UNIVERSITAS ISLAM NEGERI (UIN) IMAM BONJOL PADANG</div>
                     <div class="kop-title">FAKULTAS SAINS DAN TEKNOLOGI</div>
                     <div class="kop-address">Alamat: Sungai Bangek Kelurahan Balai Gadang Kecamatan Koto Tangah Kota Padang</div>
                     <div class="kop-address">Website: https://saintek.uinib.ac.id – e-mail: admin-fst@uinib.ac.id</div>
                 </td>
             </tr>
         </table>

         <h4 class="title">SURAT TUGAS</h4>
         <p class="letter-number">Nomor : {{ $letter->letter_number }}</p>
         <p style="text-align: center; margin-top: 20px;">DEKAN FAKULTAS SAINS DAN TEKNOLOGI</p>

         {{-- Menimbang & Dasar --}}
         <table class="content-table">
             <tr>
                 <td class="label">Menimbang</td> <td class="separator">:</td>
                 <td>
                      <table style="width: 100%">
                         <tr><td style="width: 5%; vertical-align: top;">a.</td><td>bahwa sehubungan dengan kegiatan {{ $letter->purpose }}, maka perlu diutus pihak terkait untuk kegiatan tersebut;</td></tr>
                         <tr><td style="width: 5%; vertical-align: top;">b.</td><td>bahwa Saudara yang namanya tersebut di bawah ini dipandang cakap dan memenuhi syarat untuk kegiatan tersebut.</td></tr>
                     </table>
                 </td>
             </tr>
             <tr><td colspan="3" style="height: 10px;"></td></tr>
             <tr>
                 <td class="label">Dasar</td> <td class="separator">:</td>
                 <td>
                     <table style="width: 100%">
                         <tr><td style="width: 5%; vertical-align: top;">1.</td><td>KMA RI No.9 Tahun 2016 tentang Pedoman Tata Naskah Dinas pada Kementerian Agama RI;</td></tr>
                         <tr><td style="width: 5%; vertical-align: top;">2.</td><td>Peraturan Menteri Agama RI Nomor 6 Tahun 2018 tanggal 21 Februari 2018 tentang Perjalanan Dinas Pada Kementerian Agama;</td></tr>
                         <tr><td style="width: 5%; vertical-align: top;">3.</td><td>Permendikbud Nomor 3 Tahun 2020 tentang Standar PTKI pada Standar Proses Pembelajaran;</td></tr>
                         <tr><td style="width: 5%; vertical-align: top;">4.</td><td>DIPA {{ $letter->dipa_number }} tanggal {{ \Carbon\Carbon::parse($letter->dipa_date)->isoFormat('D MMMM YYYY') }}.</td></tr>
                     </table>
                 </td>
             </tr>
         </table>

         <h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Memberi Tugas</h4>

         <table class="content-table">
              <tr>
                 <td class="label">Kepada</td><td class="separator">:</td>
                 <td>
                     {{-- Loop untuk daftar nama gabungan --}}
                     @foreach ($letter->lecturers as $lecturer)
                         {{ $loop->iteration }}. {{ $lecturer->name }} &nbsp;—&nbsp; NIP {{ $lecturer->nip }}<br>
                     @endforeach
                 </td>
             </tr>
              <tr><td colspan="3" style="height: 10px;"></td></tr>
             <tr>
                 <td class="label">Untuk</td><td class="separator">:</td>
                 <td>Melaksanakan perjalanan dinas dalam rangka {{ $letter->purpose }} yang akan dilaksanakan di {{ $letter->destination }} pada tanggal {{ \Carbon\Carbon::parse($letter->start_date)->isoFormat('D MMMM YYYY') }} s.d {{ \Carbon\Carbon::parse($letter->end_date)->isoFormat('D MMMM YYYY') }}.</td>
             </tr>
         </table>

          <p style="margin-top: 20px;">Setelah selesai melaksanakan tugas ini segera membuat laporan tertulis kepada pimpinan terkait.</p>
         <p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya.</p>

         {{-- Tanda Tangan --}}
         <div class="signature-section">
             Padang, {{ \Carbon\Carbon::parse($letter->created_at)->isoFormat('D MMMM YYYY') }}<br>
             Dekan,
             <br><br><br><br><br>
             <strong style="text-decoration: underline;">Dr. Nurus Shalihin, M.Si.</strong><br>
             NIP. 197507222003121003
         </div>
         <div class="clear"></div>
     </div>

</body>
</html>