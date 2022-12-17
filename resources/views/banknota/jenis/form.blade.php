@extends('adminlte::page')

@section('title', 'Jenis Bank Nota')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Jenis Bank Nota</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/jenis') }}">Jenis Bank Nota</a></li>
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
                @if(isset($jenis->id))
                <input type="hidden" name="id" value="{{ isset($jenis->id) ? $jenis->id:'' }}">
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <label for="name" class="col-sm-6 col-form-label">Nama Jenis Bank Nota<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ isset($jenis->name)?$jenis->name:'' }}">
                                <div class="invalid-feedback invalid-name"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nib" class="col-sm-12 col-form-label">Deskripsi<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea id="summernote-description" class="summernote" name="description" id="description">
                                    {{ isset($jenis->description)?$jenis->description:'' }}
                                </textarea>
                                <div class="invalid-feedback invalid-description"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="city_code" class="col-sm-6 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control status" name="status">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="active" {{ (isset($jenis->status) && $jenis->status=='active')?'selected':'' }}>Active</option>
                                    <option value="deactive" {{ (isset($jenis->status) && $jenis->status=='deactive')?'selected':'' }}>Deactive</option>
                                </select>
                                <div class="invalid-feedback invalid-status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="card-footer">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ url('/banknota/jenis') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>&nbsp;
                <button type="button" class="btn btn-info btn-action-save"><i class="fas fa-save"></i>&nbsp;Submit</button>
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

    $('#summernote-description').summernote(
            {
                height: 300,
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
            $('.invalid-' + inputName).text('');
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('banknota/jenis/store') }}",
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
                        $('button.btn-action-save').html('Submit&nbsp;<i class="fas fa-arrow-right"></i>');
                        $('button.btn-action-save').prop('disabled', false);
                        window.location.href = "{{ route('banknota.jenis')}}";
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