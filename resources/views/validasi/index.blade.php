@extends('adminlte::page')

@section('title', 'Validasi')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Validasi Dataset</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}">Home</a></li>
            <li class="breadcrumb-item active">Validasi Dataset</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Validasi Dataset <small>list</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Judul</th>
                            <th>Topik</th><!-- comment -->
                            <th>Organisasi</th>
                            <th>Dibuat Oleh</th>
                            <th>Status</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@stop

@section('js')
<script>
    var urlFetch = "{{ route('admin.validasi.fetch') }}";
    var urlStore = "{{ route('admin.validasi.store') }}";
</script>
<script src="{{ asset('js/dataset.js') }}?{{date('YmdHis')}}"></script>
@stop