@extends('adminlte::page')

@section('title', 'LHP Pengawasan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>LHP Pengawasan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Rekapitulasi Data</a></li>
            <li class="breadcrumb-item active">LHP Pengawasan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">LHP Pengawasan <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ route('pengawasan') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
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
                            <th>Tgl Pemeriksaan</th>
                            <th>Nama Perusahaan</th>
                            <th>Pemeriksa</th>
                            <th width="50">Action</th>
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
    var urlFetch = "{{ route('pengawasan.fetch') }}";
    $(function() {
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
        $('body').on('click', '.action-delete', function() {
            var module_id = $(this).data("id");
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda yakin ingin hapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data Ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "/pengawasan/destroy" + '/' + module_id,
                        dataType: 'JSON',
                        data: {
                            'id': module_id,
                        },
                        success: function(data) {
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

        var _dataTable = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: urlFetch,
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'tgl_pemeriksaan',
                    name: 'tgl_pemeriksaan'
                },
                {
                    data: 'nama_perusahaan',
                    name: 'nama_perusahaan'
                },
                {
                    data: 'nama_pemeriksa',
                    name: 'nama_pemeriksa'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });
</script>
@stop