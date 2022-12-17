<?php

use Illuminate\Support\Carbon;
?>
<html>
    <head>
    </head>
    <body>
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3" style="width: 21cm;">
                    <table style="margin-top: 15px; margin-left: auto;margin-right: auto; font-family: 'Arial' !important;" cellspacing='0'>
                        <thead>
                            <tr style="height:10px !important;">
                                <td style="text-align: right; " rowspan="5" width='100'>
                                    <img style="height: auto; width: 90px;" src="{{ asset('images/logo-banten.png')}}" />
                                </td>
                                <td style="text-align: center; font-size: 22pt; font-weight: bold;">PEMERINTAH PROVINSI BANTEN </td>
                            </tr>
                            <tr style="height:10px !important;">
                                <td style="text-align: center; font-size: 18pt; font-weight: bold;">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
                            </tr>
                            <tr style="height:10px !important;">
                                <td style="text-align: center; font-size: 12pt;">Kawasan Pusat Pemerintahan Provinsi Banten (KP3B) Jl. Syeh. KH. Nawawi Al Bantani </td>
                            </tr>
                            <tr style="height:10px !important;">
                                <td style="text-align: center; font-size: 12pt">Telp. (0254) 267111 Fax. (0254) 267112  Kota Serang 42171</td>
                            </tr>
                        </thead>
                    </table>
                    <div style="border-bottom: double; margin-top: 10px"></div>
                    <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                        <thead>
                            <tr style="height:20px !important;">
                                <td style="text-align: center; font-size: 16pt;font-weight: bold; text-decoration: underline;">SURAT PERINTAH TUGAS</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: center; font-size: 12pt;">Nomor : {{ $spt->no_idx }}</td>
                            </tr>
                        </thead>
                    </table>
                    <div style="font-family: 'Times New Roman'; text-indent: 2em; font-size: 12pt; text-align: justify;">
                        <p>
                            Berdasarkan Undang-Undang Nomor 3 Tahun 1951 tentang Penyataan Berlakunya Undang - Undang  Pengawasan  Perburuhan  Tahun  1948  Nomor 23 dari  Republik  Indonesia untuk  Seluruh  Indonesia,  Undang-Undang  Nomor 1 Tahun 1970 tentang  Keselamatan  Kerja dan  Undang - Undang  Nomor  13  Tahun  2003  tentang  Ketenagakerjaan,  dengan ini Kepala Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten.
                        </p>
                    </div>
                    <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                        <thead>
                            <tr style="height:20px !important;">
                                <td style="text-align: center; font-size: 12pt;font-weight: bold;">MEMERINTAHKAN</td>
                            </tr>
                        </thead>
                    </table>
                    <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                        <tbody>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px; font-weight: bold;">Kepada : </td>
                                <td style="text-align: left; font-size: 12pt; width:130px;"></td>
                                <td style="text-align: left; font-size: 12pt;"></td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;">Nama / NIP</td>
                                <td style="text-align: left; font-size: 12pt;">: {{ $biodata->name . '/' . $biodata->nip }}</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;">Pangkat / Gol</td>
                                <td style="text-align: left; font-size: 12pt;">: {{ $biodata->pangkat . '/' . $biodata->golongan }}</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;">Jabatan</td>
                                <td style="text-align: left; font-size: 12pt;">: {{ $biodata->jabatan }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" height='10'></td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px; font-weight: bold;">Untuk : </td>
                                <td style="text-align: left; font-size: 12pt; width:130px;" colspan="2">{{ 'Melakukan ' . $renja->jenis_kegiatan . ' Ketenagakerjaan' }}</td>
                                <td style="text-align: left; font-size: 12pt;"></td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px; font-weight: bold;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;" colspan="2"><b>di</b> {{ $renja->perusahaan }}</td>
                                <td style="text-align: left; font-size: 12pt;"></td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px; font-weight: bold;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;" colspan="2"><b>Alamat</b> {{ ucwords(strtolower($renja->alamat)) }}</td>
                                <td style="text-align: left; font-size: 12pt;"></td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width:80px; font-weight: bold;"></td>
                                <td style="text-align: left; font-size: 12pt; width:130px;" colspan="2"><b>Pada Hari</b> {{ Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->dayName }} <b>Tanggal</b> {{ Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->isoFormat('D MMMM Y') }} Pukul 09.00 WIB s/d Selesei</td>
                                <td style="text-align: left; font-size: 12pt;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="font-family: 'Times New Roman'; text-indent: 2em; font-size: 12pt; text-align: justify;">
                        <p>
                            Demikian Surat Perintah Tugas ini agar dilaksanakan sebagaimana mestinya, disertai rasa tanggung jawab dan melaporkan hasilnya.
                        </p>
                    </div>
                    <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                        <tbody>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: left; font-size: 12pt;">Di keluarkan di</td>
                                <td style="text-align: left; font-size: 12pt;">: Serang</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: left; font-size: 12pt; border-bottom: 1pt solid black;">Pada Tanggal</td>
                                <td style="text-align: left; font-size: 12pt; border-bottom: 1pt solid black;">: {{ Carbon::parse($spt->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: center; font-size: 12pt; padding-top: 10px;" colspan="2">Kepala Dinas Tenaga Kerja dan Transmigrasi</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: center; font-size: 12pt;" colspan="2">Provinsi Banten</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: center; font-size: 12pt; text-decoration: underline; font-weight:bold; padding-top: 40px" colspan="2">Drs. H.SEPTO KALNADI,MM</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: center; font-size: 12pt;" colspan="2">Pembina Utama Madya</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                                <td style="text-align: center; font-size: 12pt;" colspan="2">NIP.  19680916 198303 1 010</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                        <tbody>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt; font-style:italic; text-decoration: underline">Tembusan disampaikan kepada:</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt;">1. Yth. Pj. Gubernur Banten (sebagai laporan);</td>
                            </tr>
                            <tr style="height:20px !important;">
                                <td style="text-align: left; font-size: 12pt;">2. Yth. Kepala BKD Provinsi Banten.</td>
                            </tr>
                        </tbody>
                    </table>
                            <!--<a href='#' class="btn-edit-pasal" data-id="{{ $spt->id }}"><i class="fa fa-edit"></i> Edit Spt</a>-->
                </div>
                <!--                <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
                                    <a href="{{ url('spt/list') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $spt->id }}" data-original-title="Cetak" class="action-cetak btn btn-info"><i class="fas fa-print"></i>&nbsp;Cetak</a>
                                </div>-->
            </div>
        </div>
    </body>
</html>