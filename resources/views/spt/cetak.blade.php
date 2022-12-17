<html>
    <head>
        <title>Report Sektorat</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                color: #000000 !important;
                width: 29.7cm; 
                height: 21cm;
                margin-left: auto;
                margin-right: auto;
            }
            #watermark {
                position: absolute;
                background: white;
                top: 25%;
                width: 50%;
                left: 25%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                transform-origin: 50% 50%;
                z-index: -10000;
            }
            .content{
                z-index: 5;
            }

            .renjacol{
                text-align:left;
                font-size:9pt;
                border-left:solid 1px black;
                border-bottom:solid 1px black;
                padding: 4px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <table style="margin-top: 15px; margin-left: auto;margin-right: auto;" cellspacing='0'>
                <thead>
                    <tr style="height:10px !important;">
                        <td style="text-align: right; " rowspan="5" width='100'>
                            <img style="height: auto; width: 90px;" src="{{ asset('images/logo-banten.png')}}" />
                        </td>
                        <td style="text-align: center; font-size: 14pt; font-weight: bold;">PEMERINTAH PROVINSI BANTEN </td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 16pt; font-weight: bold;">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt; font-weight: bold;">KAWASAN PUSAT PEMERINTAHAN PROVINSI BANTEN (KP3B)</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt">Jl. Syekh KH. Nawawi Al-Bantani Kota Serang-Provinsi Banten</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt">Telp. (0254) 267111 – Fax. (0254) 267112</td>
                    </tr>
                </thead>
            </table>
            <div style="border-bottom: double; margin-top: 10px"></div>
            <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto;" cellspacing='0'>
                <thead>
                    <tr style="height:20px !important;">
                        <td style="text-align: center; font-size: 9pt;font-weight: bold;">RENCANA KERJA PENGAWAS KETENAGAKERJAAN</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: center; font-size: 9pt;font-weight: bold; ">PROVINSI BANTEN</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: center; font-size: 9pt;font-weight: bold; ">BULAN {{ $month }} TAHUN {{ $year }}</td>
                    </tr>
                </thead>
            </table>
            <table style="margin-top: 20px;" cellspacing='0'>
                <thead>
                    <tr style="height:30px !important;">
                        <td style="text-align: left; font-size: 9pt;">NAMA/NIP</td>
                        <td style="text-align: left; font-size: 9pt;">:</td>
                        <td style="text-align: left; font-size: 9pt;"> {{ $biodata->name }}</td>
                    </tr>
                    <tr style="height:30px !important;">
                        <td style="text-align: left; font-size: 9pt;">PANGKAT/GOLONGAN</td>
                        <td style="text-align: left; font-size: 9pt;">:</td>
                        <td style="text-align: left; font-size: 9pt;"> {{ $biodata->pangkat }}/{{ $biodata->golongan }}</td>
                    </tr>
                    <tr style="height:30px !important;">
                        <td style="text-align: left; font-size: 9pt ">JABATAN</td>
                        <td style="text-align: left; font-size: 9pt;">:</td>
                        <td style="text-align: left; font-size: 9pt;"> {{ $biodata->jabatan }}</td>
                    </tr>
                </thead>
            </table>
            <table width="100%" style="margin-top: 20px;" cellspacing='0'>
                <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 1px #000000;padding: 5px;background-color:rgba(0,0,0,0.2);">NO</td>
                        <td rowspan="2" style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.2);">JENIS KEGIATAN</td>
                        <td colspan="2" style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.2);">PELAKSANAAN</td>
                        <td rowspan="2" style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 1px #000000;border-right:solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.2);">KETERANGAN</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-bottom: solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.2);">NAMA DAN ALAMAT PERUSAHAAN</td>
                        <td style="text-align: center; font-size: 9pt; border-left: solid 1px #000000; border-bottom: solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.2);">TANGGAL PELAKSANAAN</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($renja as $key => $val)
                    <tr>
                        <td class="renjacol">{{ $no++ }}</td>
                        <td class="renjacol">{{ $val->jenis_kegiatan }}</td>
                        <td class="renjacol">{{ $val->perusahaan }},{{ $val->alamat }}</td>
                        <td class="renjacol">{{ \Carbon\Carbon::parse($val->tgl_pelaksanaan)->format('l, d F Y') }}</td>
                        <td style="text-align: left; font-size: 9pt; border-left: solid 1px #000000;border-bottom: solid 1px #000000;border-right:solid 1px #000000;">{{ $val->keterangan }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: left; font-size: 9pt; padding-top: 5px;">*) Memuat Kegiatan Pembinaan, Pemeriksaan, Pengujian dan/atau Penyidikan Tindak Pidana Ketenagakerjaan.</td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" style="margin-top: 20px;" cellspacing='0'>
                <thead>
                    <tr>
                        <td></td>
                        <td style="text-align: center; font-size: 9pt;">Serang, {{ date('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;">Mengetahui/ Menyetujui :</td>
                        <td rowspan="3" style="text-align: center; font-size: 9pt;">Pengawas ketenagakerjaan,</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;">Kepala Dinas Tenaga Kerja Dan Transmigrasi </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;">Provinsi Banten </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt; padding: 20px;"></td>
                        <td style="text-align: center; font-size: 9pt; padding: 20px;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt; text-decoration: underline; font-weight: bold;">H. Al Hamidi, S.Sos,M.Si</td>
                        <td style="text-align: center; font-size: 9pt; text-decoration: underline; font-weight: bold;">{{ $biodata->name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;">Pembina Utama Madya</td>
                        <td style="text-align: center; font-size: 9pt;">Ahli K3 Madya</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;">NIP. 19640817 198603 1 022</td>
                        <td style="text-align: center; font-size: 9pt;">NIP. {{ $biodata->nip }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
</html>