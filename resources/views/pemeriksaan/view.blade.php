@extends('adminlte::page')
@section('title', 'Note Pemeriksaan' )
@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Nota Pemeriksaan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{ url('/admin') }}" class="btn btn-default"> <i class="fas fa-times"></i> Tutup</a>&nbsp;
        </ol>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('route' => 'pemeriksaan.store','method'=>'post', 'enctype'=>"multipart/form-data", 'id'=>'form-input')) }}
<input type="hidden" name="id">
<div class="row">
    <div class="col-6">
        <div class="card card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Surat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_surat" placeholder="XXX/008/DTKT/WASNAKER/12/2021" value="{{ $datastore->no_surat }}" disabled>
                    <div class="invalid-feedback invalid-no_surat"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Sifat Surat<span class="text-danger">*</span></label>
                    <select class="form-control" name="sifat" disabled>
                        <option value="1">Rahasia</option>
                        <option value="2">Sangat Rahasia</option>
                        <option value="3">Konfidensial</option>
                        <option value="4">Biasa</option>
                    </select>
                    <div class="invalid-feedback invalid-sifat"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Lampiran<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="jml_lampiran" placeholder="Lampiran" value="{{ $datastore->jml_lampiran }}" disabled>
                    <div class="invalid-feedback invalid-jml_lampiran"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Perihal<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="perihal" placeholder="Perihal" value="{{ $datastore->perihal }}" disabled>
                    <div class="invalid-feedback invalid-perihal"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor SPT<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_spt" placeholder="XXX/008/SPT/WASNAKER/12/2021" value="{{ $datastore->no_spt }}" disabled>
                    <div class="invalid-feedback invalid-no_spt"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Tanggal SPT<span class="text-danger">*</span></label>
                    <input type="text" class="col-sm-6 form-control" name="tgl_spt" id="tgl_spt" placeholder="Tanggal SPT" value="{{ $datastore->tgl_spt }}" disabled>
                    <div class="invalid-feedback invalid-tgl_spt"></div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="card card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Yth.<br>Sdr. Pimpinan Perusahaan<span class="text-danger">*</span></label>
                    <select class="form-control" name="perusahaan" disabled>
                        @foreach ($perusahaans as $key => $perusahaan)
                        <option value="{{ $key }}" {{$datastore->perusahaan == $key ? 'selected' :'' }}>{{ $perusahaan }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback invalid-perusahaan"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Jenis Pemeriksaan<span class="text-danger">*</span></label>
                    <select class="form-control" name="jns_pemeriksaan" disabled>
                        @foreach ($jnspemeriksaans as $key => $jnspemeriksaan)
                        <option value="{{ $key }}">{{ $jnspemeriksaan }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback invalid-jns_pemeriksaan"></div>
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
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('button.btn-action-submit').click(function(e) {
            $('button.btn-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-save').prop('disabled', true);
            event.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-no_surat').text('');
            $('.invalid-sifat').text('');
            $('.invalid-jml_lampiran').text('');
            $('.invalid-perihal').text('');
            $('.invalid-no_spt').text('');
            $('.invalid-tgl_spt').text('');
            $('.invalid-perusahaan').text('');
            $('.invalid-jns_pemeriksaan').text('');

            var _form = $("#form-input");
            var formData = new FormData(_form[0]);
            $.ajax({
                url: "{{ route('pemeriksaan.store') }}",
                type: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(response) {
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
                            toastr.success('Input Nota Pemeriksaan Berhasil', 'Success');
                        } else {
                            toastr.info('Update Nota Pemeriksaan Berhasil', 'Success');
                        }
                    } else {
                        toastr.error('Update Nota Pemeriksaan Gagal', 'Error');
                    }
                    $('button.btn-save').html('<i class="far fa-save"></i> Update');
                    $('button.btn-save').prop('disabled', false);
                },
                error: function(err) {
                    $.each(err.responseJSON.message, function(i, error) {
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

        $("#tgl_spt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });

    });
</script>
@stop