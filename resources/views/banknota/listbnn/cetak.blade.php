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
            <table width=100% class="banknota" style="margin-top: 10px; margin-bottom: 10px;">
                <tr>
                    <td style="text-align:right;">{{ $banknota->kota }}, {{ \Carbon\Carbon::parse($banknota->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</td>
                </tr>
            </table>
            <table width=100% class="banknota">
                <tr>
                    <td style="text-align:left;">Nomor</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">{{ $banknota->document_no }}</td>
                    <td style="text-align:left;">Yth</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Sifat</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">Rahasia</td>
                    <td style="text-align:left;">Sdr. Pimpinan Perusahaan</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Lampiran</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">-</td>
                    <td style="text-align:left;"><b>{{ $banknota->company_name }}</b></td>
                </tr>
                <tr>
                    <td style="text-align:left;">Perihal</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">{{ $banknota->perihal }}</td>
                    <td style="text-align:left;">di {{ $banknota->kota }}</td>
                </tr>
            </table>
            {!! $banknota->description !!}
            <table width=100% class="banknota" style="margin-top:20px;">
                <tr>
                    <td style="text-align:center;">Mengetahui</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:left;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;">Kepala Dinas Tenaga Kerja dan</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;">Pengawas Ketenagakerjaan</td>
                </tr>
                <tr>
                    <td style="text-align:center;">Transmigrasi Provinsi Banten</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;">Yang Memeriksa</td>
                </tr>
                <tr>
                    <td style="text-align:left; height: 50px;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:left;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b style="text-decoration: underline;">{!! $banknota->kadis_name !!}</b></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;"><b style="text-decoration: underline;">{!! $banknota->pengawas_name !!}</b></td>
                </tr>
                <tr>
                    <td style="text-align:center;">Nip {!! $banknota->kadis_nip !!}</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;">Nip {!! $banknota->pengawas_nip !!}</td>
                </tr>
            </table>
            <table width=100% class="banknota" style="margin-top:70px !important;">
                <tr>
                    <td style="text-align:left;">Tembusan :</td>
                </tr>
                <?php $no = 0; ?>
                @foreach($jenis as $key => $val)
                <?php $no++; ?>
                <tr>
                    <td style="text-align:left;">{{ $no }}. {{ $val->description }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>