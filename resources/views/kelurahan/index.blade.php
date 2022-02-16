@extends('adminlte::page')

@section('title', 'Kelurahan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Kelurahan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Master</a></li>
            <li class="breadcrumb-item active">Kelurahan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Kelurahan <small>list</small></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-action-add" data-toggle="tooltip" data-placement="top" title="Add Modules">
                        <i class="fas fa-plus text-primary"></i>
                    </button>
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
                            <th>Provinsi</th>
                            <th>Kota/Kab</th>
                            <th>Kecamatan</th>
                            <th>Kode Kelurahan</th>
                            <th>Nama Kelurahan</th>
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
                    <label for="prov_code" class="col-sm-12 col-form-label">Provinsi <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <select class="form-control prov_code" name="prov_code">
                            <option value="" selected disabled>Pilih Provinsi</option>
                            @foreach ($provinsis as $key => $provinsi)
                            <option value="{{ $key }}">{{ $provinsi }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback invalid-prov_code"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city_code" class="col-sm-12 col-form-label">Kota/Kab <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <select class="form-control city_code" name="city_code">
                            <option value="" selected disabled>Pilih Kota/Kab</option>
                        </select>
                        <div class="invalid-feedback invalid-city_code"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kec_code" class="col-sm-12 col-form-label">Kecamatan <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <select class="form-control kec_code" name="kec_code">
                            <option value="" selected disabled>Pilih Kecamatan</option>
                        </select>
                        <div class="invalid-feedback invalid-kec_code"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kel_code" class="col-sm-12 control-label">Kode Kelurahan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="kel_code" placeholder="Kode Kelurahan" maxlength="18">
                        <div class="invalid-feedback invalid-kel_code"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label">Nama Kelurahan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kelurahan" maxlength="256">
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
            ajax: "{{ route('admin.kelurahan.fetch') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'prov_name', name: 'prov_name'},
                {data: 'city_name', name: 'city_name'},
                {data: 'kec_name', name: 'kec_name'},
                {data: 'kel_code', name: 'kel_code'},
                {data: 'name', name: 'name'},
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
                        url: "{{ url('admin/kelurahan/destroy') }}" + "/" + id,
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
            $.get("/admin/kelurahan" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("Edit Kelurahan");
                $('#ajaxModel').modal('show');
                var _cityCodeVal = '';
                var _kecCodeVal = '';
                $("form#MyForm :input").each(function () {
                    var inputName = $(this).attr('name');
                    if (inputName !== undefined) {
                        var _field = $(document).find('[name="' + inputName + '"]');
                        _field.val(data[inputName]);
                        _field.attr('readonly', false);
                        _cityCodeVal = data['city_code'];
                        _kecCodeVal = data['kec_code'];
                        if (inputName == 'prov_code') {
                            var provCode = data[inputName];
                            /** get kota/kab **/
                            $.get("/admin/kota" + '/' + provCode + '/combo', function (data) {
                                $('select.city_code').empty();
                                $('select.city_code').append('<option value="" selected disabled>Pilih Kota</option>');
                                $.each(data, function (city_code, name) {
                                    $('select.city_code').append(new Option(name, city_code))
                                });
                                $('select.city_code').val(_cityCodeVal);
                                /** get kecamatan **/
                                $.get("/admin/kecamatan" + '/' + _cityCodeVal + '/combo', function (data) {
                                    $('select.kec_code').empty();
                                    $('select.kec_code').append('<option value="" selected disabled>Pilih Kecamatan</option>');
                                    $.each(data, function (kec_code, name) {
                                        $('select.kec_code').append(new Option(name, kec_code))
                                    });
                                    $('select.kec_code').val(_kecCodeVal);
                                });

                            });
                        }
                    }
                });
                $('button.btn-submit-update').show();
            });
        });

        $('body').on('click', '.action-view', function () {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-name').text('');
            var id = $(this).data('id');
            $.get("/admin/kelurahan" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("View Kelurahan");
                $('#ajaxModel').modal('show');
                var _cityCodeVal = '';
                var _kecCodeVal = '';
                $("form#MyForm :input").each(function () {
                    var inputName = $(this).attr('name');
                    if (inputName !== undefined) {
                        var _field = $(document).find('[name="' + inputName + '"]');
                        _field.val(data[inputName]);
                        _field.attr('readonly', true);
                        _cityCodeVal = data['city_code'];
                        _kecCodeVal = data['kec_code'];
                        if (inputName == 'prov_code') {
                            var provCode = data[inputName];
                            $.get("/admin/kota" + '/' + provCode + '/combo', function (data) {
                                $('select.city_code').empty();
                                $('select.city_code').append('<option value="" selected disabled>Pilih Kota</option>');
                                $.each(data, function (city_code, name) {
                                    $('select.city_code').append(new Option(name, city_code))
                                });
                                $('select.city_code').val(_cityCodeVal);
                                /** get kecamatan **/
                                $.get("/admin/kecamatan" + '/' + _cityCodeVal + '/combo', function (data) {
                                    $('select.kec_code').empty();
                                    $('select.kec_code').append('<option value="" selected disabled>Pilih Kecamatan</option>');
                                    $.each(data, function (kec_code, name) {
                                        $('select.kec_code').append(new Option(name, kec_code))
                                    });
                                    $('select.kec_code').val(_kecCodeVal);
                                });
                            });
                        }
                    }
                });
                $('button.btn-submit-update').hide();
            });
        });

        $('body').on('click', '.btn-action-add', function () {
            $('#modelHeading').html("Tambah Kelurahan");
            $('#ajaxModel').modal('show');
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('name');
                $('.invalid-' + inputName).text('');
            });
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
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('name');
                $('.invalid-' + inputName).text('');
            });
            $.ajax({
                url: "/admin/kelurahan/update",
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

        $('select.prov_code').on('change', function () {
            var provCode = $(this).val();
            $.get("/admin/kota" + '/' + provCode + '/combo', function (data) {
                $('select.city_code').empty();
                $('select.city_code').append('<option value="" selected disabled>Pilih Kota</option>');
                $('select.kec_code').empty();
                $('select.kec_code').append('<option value="" selected disabled>Pilih Kecamatan</option>');
                $.each(data, function (city_code, name) {
                    $('select.city_code').append(new Option(name, city_code))
                })
            });
        });

        $('select.city_code').on('change', function () {
            var cityCode = $(this).val();
            $.get("/admin/kecamatan" + '/' + cityCode + '/combo', function (data) {
                $('select.kec_code').empty();
                $('select.kec_code').append('<option value="" selected disabled>Pilih Kecamatan</option>');
                $.each(data, function (kec_code, name) {
                    $('select.kec_code').append(new Option(name, kec_code))
                })
            });
        });

    });
</script>
@stop