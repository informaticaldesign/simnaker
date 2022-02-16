@extends('adminlte::page')

@section('title', 'Perusahaan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Tambah Perusahaan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/templates') }}">Templates</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-1">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" placeholder="Judul Surat:">
                                <div class="invalid-feedback invalid-name"></div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="col-sm-12">
                                <textarea id="compose-textarea" name="content" class="form-control"></textarea>
                                <div class="invalid-feedback invalid-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                <a href="{{ url('/company') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('js')
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}" type="text/javascript"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#compose-textarea').summernote({
        height: 400
    });
});
</script>
@stop