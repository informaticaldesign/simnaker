@extends('adminlte::page')
@section('title', 'LHP Pengawasan' )
@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>LHP Pengawasan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{ url('/admin') }}" class="btn btn-default"> <i class="fas fa-times"></i> Tutup</a>&nbsp;
        </ol>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('route' => 'pengawasan.store','method'=>'post', 'enctype'=>"multipart/form-data", 'id'=>'form-input')) }}
<input type="hidden" name="id">
<div class="row">
    <div class="col-6">
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Identitas Pemeriksa</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nama Pegawai Pengawas<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_pemeriksa" placeholder="Nama Pegawai Pengawas" disabled value="{{ $datastore->nama_pemeriksa }}">
                    <div class="invalid-feedback invalid-nama_pemeriksa"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Induk Pegawai / NIP<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nip_pemeriksa" placeholder="Nomor Induk Pegawai" disabled value="1231232">
                    <div class="invalid-feedback invalid-nip_pemeriksa"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Pangkat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pangkat_pemeriksa" placeholder="Pangkat" disabled value="Penata">
                    <div class="invalid-feedback invalid-pangkat_pemeriksa"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Golongan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="golongan_pemeriksa" placeholder="Golongan" disabled value="IIIC">
                    <div class="invalid-feedback invalid-golongan_pemeriksa"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Jabatan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="jabatan_pemeriksa" placeholder="Jabatan" disabled value="Pengawas">
                    <div class="invalid-feedback invalid-jabatan_pemeriksa"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Tanggal Pemeriksaan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tgl_pemeriksaan" id="tgl_pemeriksaan" placeholder="Tanggal Pemeriksaan" disabled value="{{ $datastore->tgl_pemeriksaan }}">
                    <div class="invalid-feedback invalid-tgl_pemeriksaan"></div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Identitas Perusahaan</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nama Perusahaan<span class="text-danger">*</span></label>
                    <select class="form-control" name="perusahaan" disabled>
                        @foreach ($perusahaans as $key => $perusahaan)
                        <option value="{{ $key }}" {{$datastore->perusahaan == $key ? 'selected' :'' }}>{{ $perusahaan }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback invalid-title"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Alamat<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="alamat" disabled>Jl Halmahera No.17 Tangerang</textarea>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Jenis Usaha<span class="text-danger">*</span></label>
                    <select class="form-control" name="jenis_usaha" disabled>
                        <option value="1">Manufacture</option>
                        <option value="2">Tambang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Bidang Usaha<span class="text-danger">*</span></label>
                    <select class="form-control" name="bidang_usaha" disabled>
                        <option value="1">Otomotif</option>
                        <option value="2">Elektronik</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
{{ Form::close() }}
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #ffffff;
        background: #2196f3;
        padding: 3px 7px;
        border-radius: 3px;
    }

    .bootstrap-tagsinput {
        width: 100%;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button.btn-action-submit').click(function (e) {
        $('button.btn-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-save').prop('disabled', true);
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-tgl_pemeriksaan').text('');

        var _form = $("#form-input");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ route('pengawasan.store') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    var _field = $(document).find('[name="id"]');
                    _field.val(response.data.id);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    // $('.btn-action-preview').prop('disabled', false);
                    if (response.status == 'insert') {
                        toastr.success('Input LHP Pengawasan Berhasil', 'Success');
                    } else {
                        toastr.info('Update LHP Pengawasan Berhasil', 'Success');
                    }
                } else {
                    toastr.error('Update LHP Pengawasan Gagal', 'Error');
                }
                $('button.btn-save').html('<i class="far fa-save"></i> Update');
                $('button.btn-save').prop('disabled', false);
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-save').html('<i class="far fa-save"></i> Save');
                $('button.btn-save').prop('disabled', false);
            }
        });
    });

    $("#tgl_pemeriksaan").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

});
</script>
@stop