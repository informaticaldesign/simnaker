@extends('adminlte::page')

@section('title', 'Homepage')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Homepage</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Homepage</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Homepage <small>list</small></h3>
                @if($users->role_id != 35 )
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-action-add" data-toggle="tooltip" data-placement="top" title="Add Modules">
                        <i class="fas fa-plus text-primary"></i>
                    </button>
                </div>
                @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th width="50px">Image</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Slide</th>
                            <th>Status</th>
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
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="id" id="id">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="title" class="col-sm-12 control-label">Title<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" maxlength="255">
                                    <div class="invalid-feedback invalid-title"></div>
                                </div>
                                <label for="subtitle" class="col-sm-12 control-label">Sub Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle" maxlength="255">
                                    <div class="invalid-feedback invalid-subtitle"></div>
                                </div>
                                <label for="start_date" class="col-sm-12 control-label">Start Date</label>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" maxlength="255">
                                            <div class="invalid-feedback invalid-start_date"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="end_date" name="end_date" placeholder="YYYY-MM-DD" maxlength="255">
                                            <div class="invalid-feedback invalid-end_date"></div>
                                        </div>
                                    </div>
                                </div>
                                <label for="sorting" class="col-sm-12 control-label">Sorting</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="sorting" name="sorting" placeholder="Sorting" maxlength="255">
                                    <div class="invalid-feedback invalid-sorting"></div>
                                </div>

                                <label for="img_path" class="col-sm-6 control-label mt-1">Image Slider(1280 × 720)<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="file" name="img_path" accept="image/*">
                                        <div class="invalid-feedback invalid-img_path"></div>
                                    </div>
                                </div>
                                <label for="status" class="col-sm-6 control-label">Status<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status" value="1" name="status">
                                            <label class="custom-control-label" for="status">Active</label>
                                            <div class="invalid-feedback invalid-status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
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
        ajax: "{{ route('admin.homepage.fetch') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'sorting', name: 'sorting'},
            {data: 'status', name: 'status'},
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
                    url: "{{ url('admin/homepage/destroy') }}" + "/" + id,
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
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });
        $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-save').prop('disabled', false);
        var id = $(this).data('id');
        $.get("/admin/homepage" + '/' + id + '/edit', function (data) {
            $('#modelHeading').html("Edit Homepage");
            $('#ajaxModel').modal('show');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('id');
                if (inputName !== undefined) {
                    var _field = $(document).find('[name="' + inputName + '"]');
                    if (inputName != 'status') {
                        _field.val(data[inputName]);
                        _field.attr('disabled', false);
                    } else if (inputName == 'status') {
                        if (data[inputName] == '1') {
                            _field.attr('checked', true);
                        } else {
                            _field.attr('checked', false);
                        }
                    }
                }
            });
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });
        var id = $(this).data('id');
        $.get("/admin/homepage" + '/' + id + '/edit', function (data) {
            $('#modelHeading').html("View Homepage");
            $('#ajaxModel').modal('show');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('id');
                if (inputName !== undefined) {
                    var _field = $(document).find('[name="' + inputName + '"]');
                    if (inputName != 'status') {
                        _field.val(data[inputName]);
                        _field.attr('disabled', true);
                    } else if (inputName == 'status') {
                        if (data[inputName] == '1') {
                            _field.attr('checked', true);
                        } else {
                            _field.attr('checked', false);
                        }
                    }
                }
            });
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelHeading').html("Add Homepage");
        $('#ajaxModel').modal('show');
        $('#id').val('');
        $('button.btn-submit-update').show();
        $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-save').prop('disabled', false);
        $('#MyForm')[0].reset();
        $('input').attr('disabled', false);
    });

    $('button.btn-submit-update').click(function (e) {
        $('button.btn-submit-update').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-submit-update').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });

        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('admin/homepage/update') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
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
    $("#start_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});
</script>
@stop