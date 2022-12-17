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
                        <td style="text-align: center; font-size: 9pt;font-weight: bold; text-decoration: underline;">SURAT PERINTAH TUGAS</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: center; font-size: 9pt;">{{ $spt->no_idx }}</td>
                    </tr>
                </thead>
            </table>
            <br>
            <div style="text-indent: 50px; text-align: justify">
                {!! $spt->uraian !!}
            </div>
            <table width="100%" style="margin-top: 15px; margin-left: auto;margin-right: auto;" cellspacing='0'>
                <thead>
                    <tr style="height:20px !important;">
                        <td style="text-align: center; font-size: 9pt;font-weight: bold;">MEMERINTAHKAN</td>
                    </tr>
                </thead>
            </table>
            <div>
                <p>Kepada:</p>
            </div>
            <table width="100%" style="margin-top: 5px; margin-left: 20px" cellspacing='0'>
                <tbody>
                    <?php
                    $no = 1;
                    ?>
                    @foreach($petugas as $key => $value)
                    <tr >
                        <td style="text-align: left; font-size: 9pt; width:20px">{{ $no++ }}</td>
                        <td style="text-align: left; font-size: 9pt; width:20%">Nama</td>
                        <td style="text-align: left; font-size: 9pt;">: {{ $value->name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 9pt; width:20px"></td>
                        <td style="text-align: left; font-size: 9pt;">NIP</td>
                        <td style="text-align: left; font-size: 9pt;">: {{ $value->nip }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 9pt; width:20px"></td>
                        <td style="text-align: left; font-size: 9pt;">Pangkat</td>
                        <td style="text-align: left; font-size: 9pt;">: {{ $value->pangkat_name }}/{{ $value->golongan_name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size: 9pt; width:20px"></td>
                        <td style="text-align: left; font-size: 9pt;">Jabatan</td>
                        <td style="text-align: left; font-size: 9pt;">: {{ $value->jabatan_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table width="100%" style="margin-top: 10px;" cellspacing='0'>
                <tbody>
                    <tr>
                        <td style="text-align: left; font-size: 9pt; vertical-align: top;text-align: left; width: 50px;">Untuk :</td>
                        <td style="text-align: left; font-size: 9pt;">{!! $spt->keperluan !!}</td>
                    </tr>
                </tbody>
            </table>
            <div style="text-indent: 0px;">
                <p>Demikian Surat Tugas ini dibuat untuk  dilaksanakan dengan penuh tanggung jawab dan melaporkan hasilnya.</p>
            </div>
            <table width="100%" style="margin-top: 20px;" cellspacing='0'>
                <thead>
                    <tr>
                        <td style="width:50%; text-align: center; "></td>
                        <td style="text-align: center; font-size: 9pt;">Ditetapkan di : Serang</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                        <td style="text-align: center; font-size: 9pt; text-decoration: underline;">Pada Tanggal : {{ \Carbon\Carbon::parse($spt->tgl_spt)->locale('id')->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                        <td rowspan="3" style="text-align: center; font-size: 9pt; ">KEPALA<br>DINAS TENAGA KERJA DAN TRANSMIGRASI<br>PROVINSI BANTEN</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt; padding: 20px;"><img style="height: 75px; width: 75px;" src="{{ asset('images/qrcode.png')}}" /></td>
                        <td style="text-align: center; font-size: 9pt; padding: 20px;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt; text-decoration: underline; font-weight: bold;"></td>
                        <td style="text-align: center; font-size: 9pt; text-decoration: underline; font-weight: bold;">Drs. H. SEPTO KALNADI, MM</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                        <td style="text-align: center; font-size: 9pt;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 9pt;"></td>
                        <td style="text-align: center; font-size: 9pt;">NIP. 19680916 198303 1 010</td>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
</html>