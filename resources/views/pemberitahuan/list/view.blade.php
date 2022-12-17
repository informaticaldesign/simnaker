<?php

use Illuminate\Support\Carbon;
?>
@extends('adminlte::page')

@section('title', 'Surat Pemberitahuan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Surat Pemberitahuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/jenis') }}">Pemberitahuan</a></li>
            <li class="breadcrumb-item active">Surat Pemberitahuan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
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
                <tbody>
                    <tr style="height:50px !important;">
                        <td style="width:70%;"></td>
                        <td style="text-align: left; font-size: 12pt; padding-right: 20px;">Serang, {{ Carbon::parse($notif->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                <tbody>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; font-weight: bold; width:10%;">Nomor</td>
                        <td style="text-align: left; font-size: 12pt; width:60%">: {{ $notif->no_idx }}</td>
                        <td style="text-align: left; font-size: 12pt;"><b>Kepada:</b></td>
                        <td style="text-align: left; font-size: 12pt;"></td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; font-weight: bold; width:10%;">Lampiran</td>
                        <td style="text-align: left; font-size: 12pt; width:60%">: -</td>
                        <td style="text-align: left; font-size: 12pt;"><b>Yth. Sdr. Pimpinan Perusahaan</b></td>
                        <td style="text-align: left; font-size: 12pt;"></td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; font-weight: bold; width:10%;">Sifat</td>
                        <td style="text-align: left; font-size: 12pt; width:60%">: Penting</td>
                        <td style="text-align: left; font-size: 12pt;">{{ $renja->perusahaan }}</td>
                        <td style="text-align: left; font-size: 12pt;"></td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; font-weight: bold; width:10%;">Perihal</td>
                        <td style="text-align: left; font-size: 12pt; width:60%; text-decoration: underline">: Pemeriksaan Ketenagakerjaan</td>
                        <td style="text-align: left; font-size: 12pt;"><b>Di - </b></td>
                        <td style="text-align: left; font-size: 12pt;"></td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; font-weight: bold; width:10%;"></td>
                        <td style="text-align: left; font-size: 12pt; width:60%; text-decoration: underline"></td>
                        <td style="text-align: left; font-size: 12pt;text-decoration: underline; padding-left: 50px;" colspan="2"><b>Tempat</b></td>
                    </tr>
                </tbody>
            </table>
            <div style="font-family: 'Times New Roman'; text-indent: 2em; font-size: 12pt; margin-top: 20px; text-align: justify;">
                <p>Dengan ini diberitahukan bahwa Pengawas Ketenagakerjaan Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten akan mengadakan pemeriksaan ketenagakerjaan di perusahaan Saudara, sesuai dengan Undang – Undang No. 3 Tahun 1951 tentang Pengawasan Perburuhan dan Undang – Undang No. 1 Tahun 1970 tentang Keselamatan Kerja yang dilaksanakan pada :</p>
            </div>
            <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                <tbody>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt;width:10%;"></td>
                        <td style="text-align: left; font-size: 12pt;width:20%;"><b>Hari/Tanggal</b></td>
                        <td style="text-align: left; font-size: 12pt;width:70%;">: {{ Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->dayName . '/' . Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt;width:10%;"></td>
                        <td style="text-align: left; font-size: 12pt;width:20%;"><b>Waktu</b></td>
                        <td style="text-align: left; font-size: 12pt;width:70%;">: 09.00 WIB s/d Selesei</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt;width:10%;"></td>
                        <td style="text-align: left; font-size: 12pt;width:20%;"><b>Petugas</b></td>
                        <td style="text-align: left; font-size: 12pt;width:70%;">: {{ $biodata->name . '/' . $biodata->jabatan }}</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt;width:10%;"></td>
                        <td style="text-align: left; font-size: 12pt;width:20%;"><b>Contact Person</b></td>
                        <td style="text-align: left; font-size: 12pt;width:70%;">: {{ $biodata->phone }}</td>
                    </tr>
                </tbody>
            </table>
            <p style="font-family: 'Times New Roman'; font-size: 12pt; margin-bottom: 0px; text-align: justify;">Untuk itu diminta agar Saudara mempersiapkan data-data antara lain sebagai berikut :</p>
            <table width="100%" style="margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                <tbody>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">1.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Wajib Lapor Ketenagakerjaan dan Buku Akte Pengawasan;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">2.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Daftar upah karyawan (3 bulan terakhir);</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">3.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Daftar cuti haid, cuti  melahirkan / keguguran, daftar tenaga  kerja wanita  yang  bekerja  pada malam hari;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">4.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Dokumen kepesertaan BPJS Ketenagakerjaan dan Kesehatan;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">5.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Dokumen Hubungan Kerja (Daftar pekerja/Absensi, Perjanjian Kerja, Peraturan Perusahaan/Perjanjian  Kerja  Bersama  dan  syarat-syarat  penyerahan  sebagian pelaksanaan pekerjaan/outsourching);</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">6.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Dokumen Mempekerjakan Tenaga Asing;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">7.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Pengesahan dan laporan P2K3 (Panitia Pembina Keselamatan  dan  Kesehatan  Kerja), bukti penerapan SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja);</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">6.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Data peralatan yang mengandung potensi bahaya ditempat kerja (pesawat angkat dan angkut,instalasi  listrik,  instalasi  penyalur  petir,  pesawat  tenaga  dan  produksi,  instalasi  pemadam kebakaran,  lift,  bejana tekan, tangki  penampung,  pesawat up, dll) beserta hasil pemeriksaan dan pengujiannya;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">9.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Pengesahan Unit Pelayanan Kesehatan Kerja,  Pemeriksaan  kesehatan  tenaga  kerja  (awal, berkala, dan khusus), sertifikat Dokter Pemeriksa Kesehatan Tenaga Kerja dan Rekomendasi Catering;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">10.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Data sumber  daya  manusia  dibidang   Keselamatan   dan  Kesehatan  Kerja  (K3),   (dokter perusahaan, ahli K3 Umum/Spesialis, operator pesawat angkat dan angkut,  operator  pesawat uap, dll);</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">11.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Data pengujian faktor kimia, faktor fisika dan biologi ditempat kerja;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">12.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Dokumen pengendalian bahan kimia berbahaya dan prosedur kerja ditempat berbahaya;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">13.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">Daftar dan bukti laporan kasus kecelakaan kerja;</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; vertical-align: top;width:20px;">14.</td>
                        <td style="text-align: left; font-size: 12pt; vertical-align: top; text-align: justify;">dan lain-lain yang diperlukan.</td>
                    </tr>
                </tbody>
            </table>
            <p style="font-family: 'Times New Roman'; text-indent: 2em; font-size: 12pt; margin-bottom: 0px; text-align: justify;">Demikian   pemberitahuan  ini disampaikan untuk mendapat perhatian dan dipersiapkan sebagaimana mestinya. </p>
            <p style="font-family: 'Times New Roman'; font-size: 12pt; text-align: justify;">Atas perhatian dan kerjasamanya diucapkan terimakasih.</p>
            <table width="100%" style="margin-top: 5px; margin-left: auto;margin-right: auto; font-family: 'Times New Roman';" cellspacing='0'>
                <tbody>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                        <td style="text-align: center; font-size: 12pt; padding-top: 10px;" colspan="2">Kepala Dinas Tenaga Kerja dan Transmigrasi</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; width: 50%"> </td>
                        <td style="text-align: center; font-size: 12pt;" colspan="2">Provinsi Banten</td>
                    </tr>
                    <tr style="height:20px !important;">
                        <td style="text-align: left; font-size: 12pt; width: 50%; padding-top: 50px;"> </td>
                        <td style="text-align: center; font-size: 12pt; padding-top: 50px;text-decoration: underline; font-weight:bold;" colspan="2">Drs. H.SEPTO KALNADI,MM</td>
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
            <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
                <a href="{{ url('pemberitahuan/list') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
            </div>
        </div>
    </div>
</div>
@stop