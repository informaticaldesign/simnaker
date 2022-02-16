@extends('adminlte::page')

@section('title', 'Regulasi')

@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Regulasi</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Regulasi</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Regulasi <small>list</small></h3>
                @if($users->role_id != 35 )
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-action-add" data-toggle="tooltip" data-placement="top" title="Add Modules">
                        <i class="fas fa-plus text-primary"></i>
                    </button>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool" target="_blank"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
                @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Judul</th>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="id" id="id">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type" class="col-sm-12 control-label">Type Dokumen<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="type" name="type" placeholder="Type Dokumen" maxlength="255">
                                    <div class="invalid-feedback invalid-type"></div>
                                </div>
                                <label for="judul" class="col-sm-12 control-label">Judul Peraturan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Peraturan" maxlength="255">
                                    <div class="invalid-feedback invalid-judul"></div>
                                </div>
                                <label for="tajuk" class="col-sm-6 control-label">Tajuk Entri Utama<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tajuk" name="tajuk" placeholder="Tajuk Entri Utama">
                                    <div class="invalid-feedback invalid-tajuk"></div>
                                </div>
                                <label for="text" class="col-sm-6 control-label">Nomor Peraturan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Peraturan">
                                    <div class="invalid-feedback invalid-nomor"></div>
                                </div>
                                <label for="tahun" class="col-sm-6 control-label">Tahun Peraturan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun Peraturan">
                                    <div class="invalid-feedback invalid-tahun"></div>
                                </div>
                                <label for="jenis" class="col-sm-6 control-label">Jenis/Bentuk Peraturan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis/Bentuk Peraturan">
                                    <div class="invalid-feedback invalid-jenis"></div>
                                </div>
                                <label for="singkatan" class="col-sm-6 control-label">Singkatan Bentuk Peraturan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="Singkatan Bentuk Peraturan">
                                    <div class="invalid-feedback invalid-singkatan"></div>
                                </div>
                                <label for="tmp_netap" class="col-sm-6 control-label">Tempat Penetapan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tmp_netap" name="tmp_netap" placeholder="Tempat Penetapan">
                                    <div class="invalid-feedback invalid-tmp_netap"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tgl_netap" class="col-sm-6 control-label">Tanggal Penetapan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control tgl_netap" id="tgl_netap" name="tgl_netap" placeholder="Tanggal Penetapan">
                                    <div class="invalid-feedback invalid-tgl_netap"></div>
                                </div>
                                <label for="tgl_undang" class="col-sm-6 control-label">Tanggal Pengundangan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tgl_undang" name="tgl_undang" placeholder="Tanggal Pengundangan">
                                    <div class="invalid-feedback invalid-tgl_undang"></div>
                                </div>
                                <label for="sumber" class="col-sm-6 control-label">Sumber<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="sumber" name="sumber" placeholder="Sumber">
                                    <div class="invalid-feedback invalid-sumber"></div>
                                </div>
                                <label for="lokasi" class="col-sm-6 control-label">Lokasi<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi">
                                    <div class="invalid-feedback invalid-lokasi"></div>
                                </div>
                                <label for="bid_hukum" class="col-sm-6 control-label">Bidang Hukum<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="bid_hukum" name="bid_hukum" placeholder="Bidang Hukum">
                                    <div class="invalid-feedback invalid-bid_hukum"></div>
                                </div>
                                <label for="bahasa" class="col-sm-6 control-label">Bahasa<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="bahasa" name="bahasa" placeholder="Bahasa">
                                    <div class="invalid-feedback invalid-bahasa"></div>
                                </div>
                                <label for="status" class="col-sm-6 control-label">Lampiran<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="file" name="attachment" accept=".pdf">
                                        <div class="invalid-feedback invalid-attachment"></div>
                                    </div>
                                </div>
                                <label for="status" class="col-sm-6 control-label">Status<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status">
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
        ajax: "{{ route('admin.regulasi.fetch') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'judul', name: 'judul'},
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
                    url: "{{ url('admin/regulasi/destroy') }}" + "/" + id,
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
        $.get("/admin/regulasi" + '/' + id + '/edit', function (data) {
            $('#modelHeading').html("Edit Regulasi");
            $('#ajaxModel').modal('show');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('id');
                if (inputName !== undefined) {
                    var _field = $(document).find('[name="' + inputName + '"]');
                    _field.val(data[inputName]);
                    _field.attr('disabled', false);
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
        $.get("/admin/regulasi" + '/' + id + '/edit', function (data) {
            $('#modelHeading').html("View Regulasi");
            $('#ajaxModel').modal('show');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('id');
                if (inputName !== undefined) {
                    var _field = $(document).find('[name="' + inputName + '"]');
                    _field.val(data[inputName]);
                    _field.attr('disabled', true);
                }
            });
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelHeading').html("Add Regulasi");
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
            url: "{{ url('admin/regulasi/update') }}",
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
    $("#tgl_netap").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $("#tgl_undang").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});
</script>
@stop