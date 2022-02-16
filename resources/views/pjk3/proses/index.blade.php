@extends('adminlte::page')

@section('title', 'Proses Suket')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Proses Pengajuan Surat Keterangan Online</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Proses</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Proses <small>list</small></h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool" target="_blank"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nomor Surat Pengajuan</th><!-- comment -->
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Perusahaan</th>
                            <th width="100px">Status</th>
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
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.proses.fetch') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'no_surat', name: 'no_surat'},
                {data: 'tgl_surat', name: 'no_surat'},
                {data: 'company_name', name: 'company_name'},
                {data: 'status', name: 'status'},
            ],
        });
    });
</script>
@stop