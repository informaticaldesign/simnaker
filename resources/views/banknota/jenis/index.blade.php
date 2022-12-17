@extends('adminlte::page')

@section('title', 'Jenis Bank Nota')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Jenis Bank Nota</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Bank Nota</a></li>
            <li class="breadcrumb-item active">Jenis Bank Nota</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Jenis Bank Nota <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ url('/banknota/jenis/create') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" disabled>
                        <i class="fas fa-file-excel text-gray-300"></i>
                    </button><!-- comment -->
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" disabled>
                        <i class="fas fa-file-pdf text-gray-300"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama</th><!-- comment -->
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelAddHeading"></h4>
            </div>
            <div class="modal-body"></div>
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
            ajax: "{{ route('banknota.jenis.fetch') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
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
                        url: "{{ url('banknota/jenis/destroy') }}" + "/" + id,
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
        
    });
</script>
@stop