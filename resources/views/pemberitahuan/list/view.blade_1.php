@extends('adminlte::page')

@section('title', 'Pemberitahuan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Surat Pemberitahuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pemberitahuan/list') }}">Surat Pemberitahuan</a></li>
            <li class="breadcrumb-item active">Daftar Pemberitahuan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3" style="width: 25cm;">
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
            {!! $notif->uraian !!}
            <a href='#' class="btn-edit-pasal" data-id="{{ $notif->id }}"><i class="fa fa-edit"></i> Edit Spt</a>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
            <a href="{{ url('pemberitahuan/list') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $notif->id }}" data-original-title="Cetak" class="action-cetak btn btn-info"><i class="fas fa-print"></i>&nbsp;Cetak</a>
        </div>
    </div>
</div>


<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bank Nota</h4>
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

<div class="modal fade" id="ajaxAddModelEdit" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="height: 80%;">
            <div class="modal-body">
                <form id="MyForm" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id-description">
                    <div class="form-group">
                        <textarea class="summernote" name="description" id="summernote-description">
                            {{ $notif->uraian }}
                        </textarea>
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
            url: "{{ route('pemberitahuan.list.cetak') }}",
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
            url: "{{ url('pemberitahuan/list/desc') }}",
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