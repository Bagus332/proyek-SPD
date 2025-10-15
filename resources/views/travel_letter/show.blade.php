<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Tugas - {{ $letter->letter_number }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }
        .paper-container {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .header-table {
            width: 100%;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
        }
        .header-table td {
            text-align: center;
        }
        .header-table img {
            width: 80px;
        }
        .header-table .kop-title {
            font-weight: bold;
        }
        .header-table .kop-address {
            font-size: 9pt;
        }
        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 30px;
        }
        .letter-number {
            text-align: center;
        }
        .content-table {
            width: 100%;
            margin-top: 20px;
        }
        .content-table td {
            vertical-align: top;
        }
        .content-table .label {
            width: 15%;
        }
        .content-table .separator {
            width: 5%;
        }
        .signature-section {
            width: 40%;
            float: right;
            text-align: left;
            margin-top: 50px;
        }
        .clear {
            clear: both;
        }
        @media print {
            body, .paper-container {
                margin: 0;
                box-shadow: none;
                border: none;
            }
            .btn-group {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="paper-container">
        <table class="header-table">
            <tr>
                <td>
                    {{-- Ganti `path/to/your/logo.png` dengan path logo Anda --}}
                    <img src="https://saintek.uinib.ac.id/wp-content/uploads/2019/08/logo-uin-150x150.png" alt="Logo UIN Imam Bonjol">
                </td>
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

        <table class="content-table">
            <tr>
                <td class="label">Menimbang</td>
                <td class="separator">:</td>
                <td>
                    <table>
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">a.</td>
                            <td>bahwa sehubungan dengan kegiatan {{ $letter->purpose }}, maka perlu diutus pihak terkait untuk kegiatan tersebut;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">b.</td>
                            <td>bahwa Saudara yang namanya tersebut di bawah ini dipandang cakap dan memenuhi syarat untuk kegiatan tersebut.</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="3" style="height: 10px;"></td></tr>
            <tr>
                <td class="label">Dasar</td>
                <td class="separator">:</td>
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">1.</td>
                            <td>KMA RI No.9 Tahun 2016 tentang Pedoman Tata Naskah Dinas pada Kementerian Agama RI;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">2.</td>
                            <td>Peraturan Menteri Agama RI Nomor 6 Tahun 2018 tanggal 21 Februari 2018 tentang Perjalanan Dinas Pada Kementerian Agama;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">3.</td>
                            <td>Permendikbud Nomor 3 Tahun 2020 tentang Standar PTKI pada Standar Proses Pembelajaran;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-right: 5px;">4.</td>
                            <td> DIPA{{ $letter->dipa_number }} tanggal {{ \Carbon\Carbon::parse($letter->dipa_date)->isoFormat('D MMMM YYYY') }}.</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Memberi Tugas</h4>

        <table class="content-table">
             <tr>
                <td class="label">Kepada</td>
                <td class="separator">:</td>
                <td>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 25%;">Nama</td>
                            <td>: {{ $letter->lecturer_name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>: {{ $letter->lecturer_nip }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat/Gol</td>
                            <td>: {{ $letter->lecturer_rank }}</td>
                        </tr>
                         <tr>
                            <td>Jabatan</td>
                            <td>: Dosen</td>
                        </tr>
                    </table>
                </td>
            </tr>
             <tr><td colspan="3" style="height: 10px;"></td></tr>
            <tr>
                <td class="label">Untuk</td>
                <td class="separator">:</td>
                <td>
                    Melaksanakan perjalanan dinas dalam rangka {{ $letter->purpose }} yang akan dilaksanakan di {{ $letter->destination }} pada tanggal {{ \Carbon\Carbon::parse($letter->start_date)->isoFormat('D MMMM YYYY') }} s.d {{ \Carbon\Carbon::parse($letter->end_date)->isoFormat('D MMMM YYYY') }}.
                </td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Setelah selesai melaksanakan tugas ini segera membuat laporan tertulis kepada pimpinan terkait.</p>
        <p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya.</p>


        <div class="signature-section">
            Padang, {{ now()->isoFormat('D MMMM YYYY') }}<br>
            Dekan,
            <br><br><br><br><br>
            <strong style="text-decoration: underline;">Dr. Nurus Shalihin, M.Si.</strong><br>
            NIP. 197507222003121003
        </div>
        <div class="clear"></div>

    </div>

    <div class="btn-group" style="text-align: center; margin-top: 20px; margin-bottom: 50px;">
         <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Cetak Surat</button>
         <a href="{{ route('travel.letter.create') }}" style="padding: 10px 20px; font-size: 16px; margin-left: 10px;">Buat Surat Baru</a>
    </div>

</body>
</html>