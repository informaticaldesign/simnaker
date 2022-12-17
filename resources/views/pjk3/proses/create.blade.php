@extends('adminlte::page')
@section('title', 'Pengajuan Suket')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pengajuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/proses') }}">Suket Online</a></li>
            <li class="breadcrumb-item active">Pengajuan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline" style="border-top: 3px solid #1e375b;">
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-lg text-center text-bold">PERMOHONAN<br>SURAT KETERANGAN KESELAMATAN & KESEHATAN KERJA</p>
                <div class="row">
                    <div class="col">
                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 1</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Formulir</p>
                                </div>
                            </div>
                            <div class="timeline-step-next">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 2</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Nomor Surat</p>
                                </div>
                            </div>
                            <div class="timeline-step-next">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 3</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Waktu & Obyek K3</p>
                                </div>
                            </div>
                            <div class="timeline-step-next">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 4</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Surat Permohonan</p>
                                </div>
                            </div>
                            <div class="timeline-step-next mb-0">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 5</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Jenis Obyek K3</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col (left) -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    1. FORMULIR
                </h3>
            </div>
            <div class="card-body">
                <!--<p class="text-lg text-center text-bold">FORMULIR</p>-->
                <p class="card-text">
                    Formulir ini untuk Perusahaan Jasa Kesehatan dan Keselamatan Kerja (PJK3) mengajukan Permohonan Penerbitan Surat Keterangan (SUKET) K3 kepada Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten. Akunt pada pertanyaan pertama adalah alamat email untuk mendapatkan bukti jika sudah mengisi formulir ini. Hasil Verifikasi / Kartu Penunjukkan Pengawas Spesialis K3, Hasil Evaluasi dan Informasi Cetak SUKET K3 akan secara otomatis dikirimkan ke akunt Perusahaan Jasa K3 pada bagian <b>Pengajuan (Suket Online)</b> yang dimasukkan di formulir ini. Periksa kembali jawaban dan lampiran sebelum mengirim formulir ini, kesalahan pada pengisian dapat mempengaruhi proses verifikasi.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-danger mr-1" href="{{ url('admin/proses') }}"><i class="fas fa-times-circle"></i>&nbsp;Tutup</a>
                    <a class="btn btn-success" href="{{ url('admin/proses/create/2') }}/{{ $id }}">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@stop
@section('js')
@stop