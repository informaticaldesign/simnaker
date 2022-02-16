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
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama" disabled value="{{ $topic->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Urutan</label>
                    <div class="col-sm-2">
                        <input type="number" name="hierarchy" class="form-control" id="hierarchy" placeholder="Urutan" disabled value="{{ $topic->hierarchy }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">Icon<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <img src="{{ asset('images/frontend/group_icons/inactive') }}/{{ $topic->icon }}" width="150" height="150" class="img-fluid mb-2" alt="black sample">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!--                        <a href="" class="btn btn-danger"></a>-->
                        <a href="{{ url('admin/topik') }}" class="btn btn-warning float-right">Cancel</a>
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

<script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>