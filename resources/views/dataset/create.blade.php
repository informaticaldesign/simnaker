@extends('adminlte::page')
@section('title', 'Dataset')
@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Dataset</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Dataset</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Tambah <small>Dataset</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.dataset.store','method'=>'post', 'enctype'=>"multipart/form-data")) }}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Judul<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Judul">
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
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
                    <label for="label" class="col-sm-2 col-form-label">Topik</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_topic" name="id_topic">
                            @foreach ($topiks as $key => $topik)
                            <option value="{{ $key }}">{{ $topik }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Organisasi</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_organization" name="id_organization">
                            @foreach ($organizations as $key => $organization)
                            <option value="{{ $key }}">{{ $organization }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Status Dataset</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" checked value="1">
                            <label class="form-check-label" for="inlineRadio1">Publish</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0">
                            <label class="form-check-label" for="inlineRadio2">Unpublish</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">API Key</label>
                    <div class="col-sm-2">
                        <input type="text" name="api_id" class="form-control" id="api_id" placeholder="API Key">
                        @if ($errors->has('api_id'))
                        <span class="text-danger">{{ $errors->first('api_id') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('admin/dataset') }}" class="btn btn-warning">Cancel</a>
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