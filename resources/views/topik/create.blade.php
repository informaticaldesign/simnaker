@extends('adminlte::page')
@section('title', 'Topik')
@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Topik</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Topik</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Tambah <small>Topik</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.topik.store','method'=>'post', 'enctype'=>"multipart/form-data")) }}
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
                        <a href="{{ url('admin/topik') }}" class="btn btn-warning">Cancel</a>
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

<script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>