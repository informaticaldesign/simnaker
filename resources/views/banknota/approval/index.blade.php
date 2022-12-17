@extends('adminlte::page')

@section('title', 'Approval Bank Nota 1')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Approval Bank Nota 1</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Approval Bank Nota 1</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Approval Bank Nota 1 <small>list</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No. Doc</th>
                            <!--<th>Nama Perusahaan</th> comment -->
                            <th width="100px">Nama Perusahaan</th>
                            <th width="100px">Tanggal</th>
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

<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bank Nota</h4>
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

        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('banknota.approval.fetch') }}",
            columns: [
                {data: 'document_no', name: 'document_no'},
                {data: 'company_name', name: 'company_name'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
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
                        url: "{{ url('banknota/approval/destroy') }}" + "/" + id,
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
                url: "{{ route('banknota.approval.cetak') }}",
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