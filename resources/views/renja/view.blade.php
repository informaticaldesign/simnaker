@extends('adminlte::page')

@section('title', 'Renja')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Renja</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('renja') }}">Rencana Kerja</a></li>
            <li class="breadcrumb-item active">View Renja</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3" style="width: 21cm;">
            <div class="content">
                <table style="margin-top: 15px; margin-left: auto;margin-right: auto; font-family: 'Arial';" cellspacing='0'>
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
                            <td style="text-align: center; font-size: 16pt;font-weight: bold;">RENCANA KERJA PENGAWAS KETENAGAKERJAAN</td>
                        </tr>
                        <tr style="height:20px !important;">
                            <td style="text-align: center; font-size: 16pt;font-weight: bold; ">PROVINSI BANTEN</td>
                        </tr>
                        <tr style="height:20px !important;">
                            <td style="text-align: center; font-size: 16pt;">BULAN {{ strtoupper(\Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('MMMM')) }} TAHUN {{ $year }}</td>
                        </tr>
                    </thead>
                </table>
                <table style="margin-top: 20px; font-family: 'Times New Roman';" cellspacing='0'>
                    <thead>
                        <tr style="height:30px !important;">
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;">NAMA/NIP</td>
                            <td style="text-align: left; font-size: 12pt;">:</td>
                            <td style="text-align: left; font-size: 12pt;"> {{ $biodata->name }}</td>
                        </tr>
                        <tr style="height:30px !important;">
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;">PANGKAT/GOL</td>
                            <td style="text-align: left; font-size: 12pt;">:</td>
                            <td style="text-align: left; font-size: 12pt;"> {{ $biodata->pangkat }}/{{ $biodata->golongan }}</td>
                        </tr>
                        <tr style="height:30px !important;">
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;">JABATAN</td>
                            <td style="text-align: left; font-size: 12pt;">:</td>
                            <td style="text-align: left; font-size: 12pt;"> {{ $biodata->jabatan }}</td>
                        </tr>
                    </thead>
                </table>
                <table width="100%" style="margin-top: 20px; font-family: 'Times New Roman';" cellspacing='0'>
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 3px #000000;border-bottom-style: double;padding: 5px;background-color:rgba(0,0,0,0.0);">NO</th>
                            <th rowspan="2" style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 3px #000000;border-bottom-style: double;padding: 5px;background-color: rgba(0,0,0,0.0);">JENIS KEGIATAN</th>
                            <th colspan="2" style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.0);">PELAKSANAAN</th>
                            <th rowspan="2" style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-top: solid 1px #000000;border-bottom: solid 3px #000000;border-bottom-style: double;border-right:solid 1px #000000;padding: 5px;background-color: rgba(0,0,0,0.0);">KETERANGAN</th>
                        </tr>
                        <tr>
                            <th style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-bottom: solid 3px #000000;padding: 5px;border-bottom-style: double;background-color: rgba(0,0,0,0.0);">NAMA DAN ALAMAT PERUSAHAAN</th>
                            <th style="text-align: center; font-size: 12pt; border-left: solid 1px #000000; border-bottom: solid 3px #000000;padding: 5px;border-bottom-style: double;background-color: rgba(0,0,0,0.0);">TANGGAL PELAKSANAAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach ($renja as $key => $val)
                        <tr>
                            <td class="renjacol">{{ $no++ }}</td>
                            <td class="renjacol">{{ $val->jenis_kegiatan }}<br>{{ $val->type_kegiatan }}</td>
                            <td class="renjacol">{{ ucwords($val->perusahaan) }}<br>{{ ucwords(strtolower($val->alamat)) }}</td>
                            <td class="renjacol">{{ \Carbon\Carbon::parse($val->tgl_pelaksanaan)->locale('id')->isoFormat('D MMMM Y') }}</td>
                            <td style="text-align: left; font-size: 12pt; border-left: solid 1px #000000;border-bottom: solid 1px #000000;border-right:solid 1px #000000; vertical-align: top; padding-top: 4px;">{{ $val->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table width="100%" style="margin-top: 20px; font-family: 'Times New Roman';" cellspacing='0'>
                    <thead>
                        <tr>
                            <td></td>
                            <td rowspan="9"><!--<img style="height: auto; width: 80px;" src="{{ asset('images/qrcode.png')}}" />--></td>
                            <!--<td style="text-align: center; font-size: 12pt;">Serang, {{ \Carbon\Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat('D MMMM Y') }}</td>-->
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt;">Mengetahui/ Menyetujui :</td>
                            <td rowspan="3" style="text-align: center; font-size: 12pt;">Pengawas ketenagakerjaan,</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt;">Kepala Dinas Tenaga Kerja Dan Transmigrasi </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt;">Provinsi Banten </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt; padding: 20px;"></td>
                            <td style="text-align: center; font-size: 12pt; padding: 20px;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt; text-decoration: underline; font-weight: bold;">Drs. H. SEPTO KALNADI, MM</td>
                            <td style="text-align: center; font-size: 12pt; text-decoration: underline; font-weight: bold;">{{ $biodata->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt;"></td>
                            <td style="text-align: center; font-size: 12pt;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 12pt;">NIP. 19680916 198303 1 010</td>
                            <td style="text-align: center; font-size: 12pt;">NIP. {{ $biodata->nip }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
                <a href="{{ url('admin/renja') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .renjacol{
        text-align:left;
        font-size:12pt;
        border-left:solid 1px black;
        border-bottom:solid 1px black;
        padding-top: 4px;
        padding-left: 4px;
        padding-right: 4px;
        vertical-align: top; 
    }
</style>
@stop