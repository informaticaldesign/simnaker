@extends('adminlte::page')

@section('title', 'Bank Nota II')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Bank Nota II</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/listbnn') }}">Bank Nota II</a></li>
            <li class="breadcrumb-item active">Buat Bank Nota II</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3" style="width: 29.7cm;">
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
            <table width=100% class="banknota">
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
            <div class="isi-banknota-second">{!! $banknota->description !!}</div><a href='#' class="btn-edit-pasal" data-id="{{ $banknota->id }}"><i class="fa fa-edit"></i> Edit isi Surat</a>
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
            <a href="{{ url('/banknota/listbnn/'.$banknota->uuid.'/edit') }}" class="btn btn-danger float-right"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>&nbsp;
            <a href="{{ url('/banknota/listbnn') }}" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Simpan</a>&nbsp;
            <button type="button" class="btn btn-info btn-action-send" data-id="{{ $banknota->id }}">Kirim Kadis&nbsp;<i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="height: 80%;">
            <div class="modal-body">
                <form id="MyForm" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id-description">
                    <div class="form-group">
                        <textarea class="summernote" name="description" id="summernote-description"></textarea>
                        <div class="invalid-feedback invalid-description"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-save">Submit</button>
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
<style>
    table.banknota{
        font-size: 11pt; 
        font-family: Tahoma, sans-serif;
    }

    table.banknota td, tr{
        padding: 2px;
        vertical-align:middle;
    }
</style>
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

    $('.form-control').removeClass('is-invalid');
    $("form#MyForm :input").each(function () {
        var inputName = $(this).attr('name');
        $('.invalid-' + inputName).text('');
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
            url: "{{ url('banknota/listbnn/desc') }}",
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

    $(document).on("click", "button.btn-add-jenis-bank-nota", function (e) {
        e.preventDefault();
        var _jmlRow = $('div.col-jenis-bank-nota').attr('data-id');
        $('div.col-jenis-bank-nota').attr('data-id', (parseInt(_jmlRow) + 1));
        $('div.col-jenis-bank-nota').append('<div class="row row-jenis-bank-nota mt-1 row-' + (parseInt(_jmlRow) + 1) + '"></div>');
        $('div.row-' + parseInt(_jmlRow)).html($('div.row-jenis-bank-nota').html());
        $('div.row-' + parseInt(_jmlRow)).children('div.col-2').children('button').attr('data-value', parseInt(_jmlRow));
        $('div.row-' + parseInt(_jmlRow)).children('div.col-10').children('select').attr('name', 'jenis_id[' + parseInt(_jmlRow) + ']');
        $('div.row-' + parseInt(_jmlRow)).children('div.col-10').children('div.invalid-feedback').attr('class', 'invalid-feedback invalid-jenis_id.' + parseInt(_jmlRow));
    }).on('click', 'button.btn-remove-jenis-bank-nota', function (e) {
        e.preventDefault();
        var _row = $(this).attr('data-value');
        $('div.row-' + _row).remove();
    }).on('click', 'button.btn-action-send', function (e) {
        e.preventDefault();
        $('button.btn-action-send').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-send').prop('disabled', true);
        e.preventDefault();
        var _id = $('button.btn-action-send').attr('data-id');
        $.ajax({
            url: "{{ url('banknota/listbnn/send') }}",
            type: "POST",
            data: {
                id: _id
            },
            success: function (result) {
                if (result.success) {
                    window.location.href = "{{ url('banknota/listbnn')}}";
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: "Description",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-send').html('Submit&nbsp;<i class="fas fa-paper-plane"></i>');
                        $('button.btn-action-send').prop('disabled', false);
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
                $('button.btn-action-send').html('Kirim ke Kadis&nbsp;<i class="fas fa-paper-plane"></i>');
                $('button.btn-action-send').prop('disabled', false);
            }
        });
    });

    $('body').on('click', 'a.btn-edit-pasal', function (e) {
        e.preventDefault();
        $('#ajaxAddModel').modal('show');
        var _id = $(this).attr('data-id');
        $('input#id-description').val(_id);
        $('#summernote-description').summernote("code", $('div.isi-banknota-second').html());
    });
});
</script>
@stop