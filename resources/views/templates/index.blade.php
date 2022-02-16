@extends('adminlte::page')

@section('title', 'Jabatan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Templates</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Master</a></li>
            <li class="breadcrumb-item active">Templates</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Templates <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ url('admin/templates/create') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
                    <a href="#" class="btn btn-tool disabled"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool disabled" target="_blank"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Code</th>
                            <th>Nama</th>
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
                {{ Form::open(array('id' => 'MyForm','name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="jabatan_code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="jabatan_code" name="jabatan_code" placeholder="Enter Code" maxlength="256">
                        <div class="invalid-feedback invalid-jabatan_code"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" maxlength="256">
                        <div class="invalid-feedback invalid-name"></div>
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
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var _dataTable = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jabatan.fetch') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'jabatan_code', name: 'jabatan_code'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
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
                        url: "{{ url('jabatan/destroy') }}" + "/" + id,
                        dataType: 'JSON',
                        data: {
                            'id': id,
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
            $('.invalid-name').text('');
            $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
            $('button.btn-save').prop('disabled', false);
            var id = $(this).data('id');
            $.get("jabatan" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("Edit Templates");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#jabatan_code').val(data.jabatan_code);
                $('#jabatan_code').prop('readonly', false);
                $('#name').val(data.name);
                $('#name').prop('readonly', false);
                $('button.btn-submit-update').show();
            });
        });

        $('body').on('click', '.action-view', function () {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-name').text('');
            var id = $(this).data('id');
            $.get("jabatan" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("View Templates");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#jabatan_code').val(data.jabatan_code);
                $('#jabatan_code').prop('readonly', true);
                $('#name').val(data.name);
                $('#name').prop('readonly', true);
                $('button.btn-submit-update').hide();
            });
        });

        $('body').on('click', '.btn-action-add', function () {
            $('#modelHeading').html("Add Templates");
            $('#ajaxModel').modal('show');
            $('#id').val('');
            $('button.btn-submit-update').show();
            $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
            $('button.btn-save').prop('disabled', false);
            $('#MyForm')[0].reset();
            $('input').prop('readonly', false);
        });

        $('button.btn-submit-update').click(function (e) {
            $('button.btn-submit-update').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-submit-update').prop('disabled', true);
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-name').text('');
            $.ajax({
                url: "jabatan/update",
                method: 'PUT',
                data: $('#MyForm').serialize(),
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