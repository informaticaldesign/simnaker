@extends('adminlte::page')
@section('title', 'Visualisasi')
@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Visualisasi</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Visualisasi</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Tambah <small>Visualisasi</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama" disabled value="{{ $topic->title }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Slug<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" id="label" placeholder="Slug" disabled value="{{ $topic->slug }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea id="summernote" class="summernote" name="description">{{ $topic->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Topik</label>
                    <div class="col-sm-10">
                        <input type="text" name="id_topic" class="form-control" id="id_topic" placeholder="Topik" disabled value="{{ $topic->topic_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Visualisasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="id_organization" class="form-control" id="id_organization" placeholder="Visualisasi" disabled value="{{ $topic->organizations_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Icon<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <img src="{{ asset('uploads/visualisasi/thumbnails') }}/{{ $topic->icon }}" width="150" height="150" class="img-fluid mb-2" alt="black sample">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!--                        <a href="" class="btn btn-danger"></a>-->
                        <a href="{{ url('admin/visualisasi') }}" class="btn btn-warning float-right">Cancel</a>
                    </div>
                </div>
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
        $('#summernote').summernote('disable');
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