@extends('adminlte::page')

@section('title', 'Nota Pemeriksaan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Nota Pemeriksaan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Rekapitulasi Data</a></li>
            <li class="breadcrumb-item active">Nota Pemeriksaan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Nota Pemeriksaan <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ route('pemeriksaan') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
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
                            <th>Nomor SPT</th>
                            <th>Tanggal SPT</th>
                            <th>Nama Perusahaan</th><!-- comment -->
                            <th>Jenis Pemeriksaan</th>
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
    var urlFetch = "{{ route('pemeriksaan.fetch') }}";
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
                        url: "/pemeriksaan/destroy" + '/' + module_id,
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
                    data: 'no_spt',
                    name: 'no_spt'
                },
                {
                    data: 'tgl_spt',
                    name: 'tgl_spt'
                },
                {
                    data: 'txt_perusahaan',
                    name: 'txt_perusahaan'
                },
                {
                    data: 'txt_pemeriksaan',
                    name: 'txt_pemeriksaan'
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