<?php

use Illuminate\Support\Carbon;
?>
@extends('adminlte::page')

@section('title', 'SPT')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Surat Perintah Tugas</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/jenis') }}">Surat Perintah Tugas</a></li>
            <li class="breadcrumb-item active">Daftar SPT</li>
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
            <a href="{{ url('spt/list') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $spt->id }}" data-original-title="Cetak" class="action-cetak btn btn-info"><i class="fas fa-print"></i>&nbsp;Cetak</a>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Surat Perintah Kerja</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame" src="" width="100%" height="500"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@stop
@section('js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#summernote-description').summernote(
            {
                height: 400,
                minHeight: null,
                maxHeight: null,
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            }
    );

    $('body').on('click', '.action-cetak', function () {
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Wait...');
        $(this).prop('disabled', true);
        var _button = $(this);
        var module_id = $(this).data("id");
        $.ajax({
            url: "{{ route('spt.list.cetak') }}",
            type: "get",
            data: {id: module_id},
            dataType: "json",
            success: function (result) {
                if (result.status == 'success') {
                    _button.html('<i class="fas fa-file-pdf"></i> Cetak');
                    _button.prop('disabled', false);
                    $('#ajaxAddModel').modal('show');
                    $("#frame").attr("src", result.data.url);
                }
            },
            error: function (xhr, Status, err) {
                $("Terjadi error : " + Status);
            }
        });
    });

    $('body').on('click', 'a.btn-edit-pasal', function (e) {
        e.preventDefault();
        $('#ajaxAddModelEdit').modal('show');
        var _id = $(this).attr('data-id');
        $('input#id-description').val(_id);
    });

    $('button.btn-action-save').click(function (e) {

        $('button.btn-action-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-save').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            if (inputName !== undefined) {
                $('.invalid-' + inputName).text('');
            }
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('spt/list/desc') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    $('#ajaxAddModel').modal('hide');
                    location.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: "Description",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Submit&nbsp;<i class="fas fa-arrow-right"></i>');
                        $('button.btn-action-save').prop('disabled', false);
                    });
                }
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-action-save').html('Submit&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });

});
</script>
@stop