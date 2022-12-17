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
            {!! $template->content !!}
        </div>
    </body>
</html>