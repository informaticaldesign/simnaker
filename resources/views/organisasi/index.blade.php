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
                <h3 class="card-title">Organisasi <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ route('admin.organisasi.create') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th width="50px">Thumbnail</th>
                            <th>Name</th><!-- comment -->
                            <th>Slug</th>
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
    var urlFetch = "{{ route('admin.organisasi.fetch') }}";
    var urlStore = "{{ route('admin.organisasi.store') }}";
</script>
<script src="{{ asset('js/organisasi.js') }}?{{date('YmdHis')}}"></script>
@stop