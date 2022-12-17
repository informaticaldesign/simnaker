@extends('adminlte::page')
@section('title', 'Note Pemeriksaan' )
@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Layanan Pengaduan</h1>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal', 'url' => 'admin/layanan-pengaduan/store')) }}
<?= Form::hidden('id', $pengaduan->id) ?>
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-1">
                    <label for="nib" class="col-sm-12 col-form-label">Pilih Klasifikasi Laporan Anda<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <?= Form::radio('jenis', 'pengaduan', ['id' => 'rdo-pengaduan', 'checked' => $pengaduan->jenis == 'pengaduan' ? true : false]) ?> Pengaduan
                            </div>
                            <div class="col-md-4">
                                <?= Form::radio('jenis', 'aspirasi', ['id' => 'rdo-aspirasi', 'checked' => $pengaduan->jenis == 'aspirasi' ? true : false]) ?> Aspirasi
                            </div>
                            <div class="col-md-4">
                                <?= Form::radio('jenis', 'permintaan_informasi', ['id' => 'rdo-permintaan-informasi', 'checked' => $pengaduan->jenis == 'permintaan_informasi' ? true : false]) ?> Permintaan Informasi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="name" class="col-sm-12 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::text('name', $pengaduan->name, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-name"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="col-sm-12 col-form-label">Alamat Email <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::email('email', $pengaduan->email, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-email"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="phone" class="col-sm-12 col-form-label">Nomor Telephone <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::text('phone', $pengaduan->phone, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-phone"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="kategori" class="col-sm-12 col-form-label">Kategori Pengaduan<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::select('kategori', $categories, $pengaduan->kategori, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-kategori"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="lokasi" class="col-sm-12 col-form-label">Lokasi Kejadian<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::select('lokasi', $kotas, $pengaduan->lokasi, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-lokasi"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="judul" class="col-sm-12 col-form-label">Judul Laporan <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::text('judul', $pengaduan->judul, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-judul"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="laporan" class="col-sm-12 col-form-label">Isi Laporan <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::textarea('laporan', $pengaduan->laporan, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-laporan"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="status" class="col-sm-12 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <?= Form::select('status', [0 => 'Open', 1 => 'Process', 2 => 'Close'], $pengaduan->status, ['class' => 'form-control']) ?>
                        <div class="invalid-feedback invalid-kategori"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <a href="{{ url($pengaduan->lampiran_path) }}" download><label for="lampiran" class="col-sm-12 col-form-label"><i class="fa fa-paperclip"></i> Lampiran</label></a>
                </div>
                <div class="mb-1">
                    <div class="col-sm-12">
                        <a class="btn btn-default" href="{{ url('/admin/layanan-pengaduan') }}">
                            <i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali
                        </a>
                        <button type="submit" class="btn btn-primary float-end btn-action-daftar mr-2" style="background-color:#1e375b; border-color: #1e375b;">
                            Update&nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop