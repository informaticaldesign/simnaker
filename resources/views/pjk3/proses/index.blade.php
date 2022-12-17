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
                            <th width="100px">Action</th>
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
@section('css')
<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('js')
<script src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/datatables-plugins/jszip/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/datatables-plugins/pdfmake/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/datatables-plugins/pdfmake/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
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
                {data: 'action', name: 'action'},
            ],
            dom: 'Bfrtip',//'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@stop