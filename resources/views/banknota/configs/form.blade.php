@extends('adminlte::page')

@section('title', 'Jenis Bank Nota')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Configs Bank Nota</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Configs Bank Nota</li>
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
                <!-- text input -->
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" placeholder="" name="bankNotaKota" value="{{$configs->bankNotaKota}}">
                </div>
                <div class="form-group">
                    <label>Nota Header Deskripsi Bank Nota 1</label>
                    <textarea class="summernote" name="bankNotaHeader" id="summernote-nota-header">
                                    {{ $configs->bankNotaHeader }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Nota Footer Deskripsi Bank Nota 1</label>
                    <textarea class="summernote" name="bankNotaFooter" id="summernote-nota-footer">
                                    {{ $configs->bankNotaFooter }}
                    </textarea>
                </div>
                
               <div class="form-group">
                    <label>Template Bank Nota 2</label>
                    <textarea class="summernote" name="bankNotaSecond" id="summernote-nota-second">
                                    {{ $configs->bankNotaSecond }}
                    </textarea>
                </div> 
                <div class="form-group float-right">
                    <a href="{{ url('admin') }}" class="btn btn-default float-right"><i class="far fa-window-close"></i>&nbsp;Tutup</a>&nbsp;
                    <button type="button" class="btn btn-info btn-action-save mr-1"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div>
                {{ Form::close() }}
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

    $('#summernote-nota-header').summernote(
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
    
    $('#summernote-nota-footer').summernote(
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
    
    $('#summernote-nota-second').summernote(
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
            url: "{{ url('banknota/configs/store') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: result.message,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1e375b',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Simpan&nbsp;<i class="fas fa-arrow-right"></i>');
                        $('button.btn-action-save').prop('disabled', false);
//                        window.location.href = "{{ route('banknota.listbn')}}";
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: " Jenis Bank Nota gagal dibuat",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Simpan&nbsp;<i class="fas fa-arrow-right"></i>');
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
                $('button.btn-action-save').html('Simpan&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });
});
</script>
@stop