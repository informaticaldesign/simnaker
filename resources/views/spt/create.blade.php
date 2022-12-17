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
            <li class="breadcrumb-item"><a href="{{ url('admin/spt') }}">Surat Perintah Tugas</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label for="no_idx" class="col-sm-6 col-form-label">Nomor Index Surat/Kode Klasifikasi<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="no_idx" id="no_idx" value="{{ $no_idx }}">
                                <div class="invalid-feedback invalid-no_idx"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nib" class="col-sm-12 col-form-label">Uraian Perintah Tugas<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea id="summernote-uraian" class="summernote" name="uraian"></textarea>
                                <div class="invalid-feedback invalid-uraian"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nib" class="col-sm-12 col-form-label">Keperluan<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea id="summernote-keperluan" class="summernote" name="keperluan"></textarea>
                                <div class="invalid-feedback invalid-keperluan"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="tgl_spt" class="col-sm-6 col-form-label">Tanggal Spt<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tgl_spt" id="tgl_spt">
                                <div class="invalid-feedback invalid-tgl_spt"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="city_code" class="col-sm-6 col-form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control city_code" name="city_code">
                                    <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                    @foreach ($kotas as $key => $kota)
                                    <option value="{{ $key }}">{{ $kota }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-city_code"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ url('/admin/spt') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>&nbsp;
                    <button type="button" class="btn btn-info btn-action-save">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></button>
                </div>
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

    $('#summernote-uraian').summernote(
            {
                height: 200,
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

    $('#summernote-keperluan').summernote(
            {
                height: 200,
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

    $("#tgl_spt").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    // load data edit
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
            $('.invalid-' + inputName).text('');
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('admin/spt/submit') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "SPT Berhasil dibuat.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1e375b',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
                        $('button.btn-action-save').prop('disabled', false);
                        window.location.href = "{{ route('admin.spt')}}";
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: "SPT gagal dibuat",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
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
                $('button.btn-action-save').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });
});
</script>
@stop