@extends('adminlte::page')

@section('title', 'SPT')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Surat Perintah Tugas</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Surat Perintah Tugas</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Surat Perintah Tugas <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/spt/create') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
                    <a href="#" class="btn btn-tool disabled"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool disabled"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nomor Spt</th>
                            <th>Tanggal SPT</th>
                            <th>Total Pegawai</th>
                            <th width="80px">Action</th>
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
<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Surat Perintah Tugas</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame" src="" width="100%" height="500"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
        });
        var _dataTable = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.spt.fetch') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'no_idx', name: 'no_idx'},
                {data: 'tgl_spt', name: 'tgl_spt'},
                {data: 'ttl_pegawai', name: 'ttl_pegawai'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('body').on('click', '.action-delete', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('admin/spt/destroy') }}" + "/" + id,
                        dataType: 'JSON',
                        success: function (data) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Data berhasil di hapus'
                            });
                            $('.data-table').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
        $('body').on('click', '.action-cetak', function () {
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Wait...');
            $(this).prop('disabled', true);
            var _button = $(this);
            var module_id = $(this).data("id");
            $.ajax({
                url: "{{ route('admin.spt.cetak') }}",
                type: "get",
                data: {id: module_id},
                dataType: "json",
                success: function (result) {
                    if (result.status == 'success') {
                        _button.html('<i class="fas fa-file-pdf"></i> Cetak');
                        _button.prop('disabled', false);
                        $('#ajaxAddModel').modal('show');
                        $("#frame").attr("src", result.data.url);
                    }
                },
                error: function (xhr, Status, err) {
                    $("Terjadi error : " + Status);
                }
            });
        });
    });
</script>
@stop