@extends('adminlte::page')
@section('title', 'Organisasi')
@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Organisasi</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Organisasi</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Tambah <small>Organisasi</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.organisasi.store','method'=>'post', 'enctype'=>"multipart/form-data")) }}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Urutan</label>
                    <div class="col-sm-2">
                        <input type="number" name="hierarchy" class="form-control" id="hierarchy" placeholder="Urutan">
                        @if ($errors->has('hierarchy'))
                        <span class="text-danger">{{ $errors->first('hierarchy') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea id="summernote" class="summernote" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Icon<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="file" name="icon" id="icon" placeholder="icon">
                        @if ($errors->has('icon'))
                        <span class="text-danger">{{ $errors->first('icon') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('admin/organisasi') }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
$(function () {
    $(document).ready(function () {
        $('#summernote').summernote(
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
    });

    $(document).on("change", ":file", function () {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input
                .val()
                .replace(/\\/g, "/")
                .replace(/.*\//, "");
        $('.custom-file-label').html(label);
    });

    $('#form-input').on('submit', function (e) {
        $('.btn-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('.btn-save').prop('disabled', true);
    });
});

</script>
@stop