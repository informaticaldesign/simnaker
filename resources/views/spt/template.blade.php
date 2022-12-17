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
                <input type="hidden" name='id' value="{{ isset($spt) ? $spt->id : '' }}">
                <input type="hidden" name='flag' value="simpan">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label for="content" class="col-sm-12 col-form-label">Template<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea id="summernote-uraian" class="summernote" name="content">{{ isset($spt) ? $spt->content : '' }}</textarea>
                                <div class="invalid-feedback invalid-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ url('/admin') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Tutup</a>&nbsp;
                    <button type="button" class="btn btn-info btn-action-save"><i class="fas fa-save"></i>&nbsp;Simpan</button>
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
                height: 400,
                minHeight: null,
                maxHeight: null,
                focus: true,
//                toolbar: [
//                    ['style', ['bold', 'italic', 'underline', 'clear']],
//                    ['font', ['strikethrough', 'superscript', 'subscript']],
//                    ['fontsize', ['fontsize']],
//                    ['color', ['color']],
//                    ['para', ['ul', 'ol', 'paragraph']],
//                    ['height', ['height']],
//                    ['style', ['style']],
//                    ['font', ['bold', 'italic', 'underline', 'clear']],
//                    ['fontname', ['fontname']],
//                    ['color', ['color']],
//                    ['para', ['ul', 'ol', 'paragraph']],
//                    ['height', ['height']],
//                    ['table', ['table']],
//                    ['insert', ['link', 'picture', 'hr']],
//                    ['view', ['fullscreen', 'codeview']],
//                    ['help', ['help']]
//                ]
            }
    );


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
            url: "{{ url('admin/spt/template') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Template SPT Berhasil diupdate.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1e375b',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('<i class="fas fa-save"></i>&nbsp;Simpan');
                        $('button.btn-action-save').prop('disabled', false);
//                        window.location.href = "{{ route('admin.spt')}}";
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
                        $('button.btn-action-save').html('<i class="fas fa-save"></i>&nbsp;Simpan');
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
                $('button.btn-action-save').html('<i class="fas fa-save"></i>&nbsp;Simpan');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });
});
</script>
@stop