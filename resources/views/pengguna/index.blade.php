@extends('adminlte::page')

@section('title', 'Data Pegawai')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Data Pegawai</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
        </ol>
    </div>
</div>
@stop

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Data Pegawai <small>list</small></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-action-add" data-toggle="tooltip" data-placement="top" title="Add Modules">
                        <i class="fas fa-plus text-primary"></i>
                    </button>
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Ttl. Perush</th>
                            <th>Ttl. UPT</th>
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
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'PenggunaForm','name'=>'PenggunaForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="pengguna_id" id="pengguna_id">
                <div class="form-group">
                    <label for="nip" class="col-sm-2 control-label">Nip</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control nip_pengawas" id="nip" name="nip" maxlength="21">
                        <div class="invalid-feedback invalid-nip"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" maxlength="256">
                        <div class="invalid-feedback invalid-name"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="256">
                        <div class="invalid-feedback invalid-email"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" maxlength="256">
                        <div class="invalid-feedback invalid-phone"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                        <div class="invalid-feedback invalid-address"></div>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-submit-update btn-save"><i class="far fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ asset('vendor/inputmask/inputmask.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

//    $('.nip_pengawas').mask('00000000 000000 0 000');
//    $('.nip_pengawas').inputmask({"mask": "(999) 999-9999"});
//    $(".nip_pengawas").inputmask("99-9999999");

    var _dataTable = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengguna.fetch') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nip', name: 'nip'},
            {data: 'name', name: 'name'},
            {data: 'jabatan_name', name: 'jabatan_name'},
            {data: 'pangkat_name', name: 'pangkat_name'},
            {data: 'golongan_name', name: 'golongan_name'},
            {data: 'ttl_comp', name: 'ttl_comp'},
            {data: 'ttl_upt', name: 'ttl_upt'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });
    var Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('body').on('click', '.action-delete', function () {
        var pengguna_id = $(this).data("id");
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
                    url: "{{ url('pengguna/destroy') }}" + "/" + pengguna_id,
                    dataType: 'JSON',
                    data: {
                        'id': pengguna_id,
                    },
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
    $('body').on('click', '.action-edit', function () {
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nip').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-save').prop('disabled', false);
        var pengguna_id = $(this).data('id');
        $.get("pengguna" + '/' + pengguna_id + '/edit', function (data) {
            $('#modelHeading').html("Edit Pengguna");
            $('#ajaxModel').modal('show');
            $('#pengguna_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', false);
            $('#email').val(data.email);
            $('#email').prop('readonly', false);
            $('#nip').val(data.nip);
            $('#nip').prop('readonly', false);
            $('#phone').val(data.phone);
            $('#phone').prop('readonly', false);
            $('#address').val(data.address);
            $('#address').prop('readonly', false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nip').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        var pengguna_id = $(this).data('id');
        $.get("pengguna" + '/' + pengguna_id + '/edit', function (data) {
            $('#modelHeading').html("View Pengguna");
            $('#ajaxModel').modal('show');
            $('#pengguna_id').val(data.id);
            $('#nip').val(data.nip);
            $('#nip').prop('readonly', true);
            $('#name').val(data.name);
            $('#name').prop('readonly', true);
            $('#email').val(data.email);
            $('#email').prop('readonly', true);
            $('#phone').val(data.phone);
            $('#phone').prop('readonly', true);
            $('#address').val(data.address);
            $('#address').prop('readonly', true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelHeading').html("Add Pengguna");
        $('#ajaxModel').modal('show');
        $('#pengguna_id').val('');
        $('button.btn-submit-update').show();
        $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-save').prop('disabled', false);
        $('#PenggunaForm')[0].reset();
        $('input').prop('readonly', false);
    });

    $('button.btn-submit-update').click(function (e) {
        $('button.btn-submit-update').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-submit-update').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nip').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        $.ajax({
            url: "{{ route('pengguna.update') }}",
            method: 'PUT',
            data: $('#PenggunaForm').serialize(),
            success: function (result) {
                if (result.success) {
                    $('#ajaxModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil di update'
                    });
                    $('.data-table').DataTable().ajax.reload();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data gagal di update'
                    });
                }
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
                $('button.btn-save').prop('disabled', false);
            }
        });
    });
});
</script>
@stop