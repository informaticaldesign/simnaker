@extends('adminlte::page')
@section('title', 'Note Pemeriksaan' )
@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Nota Pemeriksaan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{ url('/admin') }}" class="btn btn-default"> <i class="fas fa-times"></i> Cancel</a>&nbsp;
            <button type="button" class="btn btn-danger btn-save btn-action-submit"><i class="far fa-save"></i> Simpan</button>
        </ol>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('route' => 'pemeriksaan.store','method'=>'post', 'enctype'=>"multipart/form-data", 'id'=>'form-input')) }}
<div class="row">
    <div class="col-6">
        <div class="card card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nama Pegawai Pengawas<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pegawai Pengawas" value="">
                    <div class="invalid-feedback invalid-title"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Induk Pegawai / NIP<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nip" placeholder="Nomor Induk Pegawai" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Induk Kependudukan / NIK<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Alamat Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Handphone<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="phone" placeholder="Nomor Handphone" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Alamat Unit Kerja<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="alamat"></textarea>
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
                    <label for="label" class="col-sm-6 col-form-label">Jabatan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="">
                    <div class="invalid-feedback invalid-title"></div>
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Pangkat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pangkat" placeholder="Pangkat" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Golongan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="golongan" placeholder="Golongan" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Alamat Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Nomor Handphone<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="phone" placeholder="Nomor Handphone" value="">
                </div>
                <div class="form-group">
                    <label for="label" class="col-sm-6 col-form-label">Alamat Unit Kerja<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="alamat"></textarea>
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
@section('plugins.Momentjs', true)
@section('plugins.jqueryUi', true)
@section('plugins.datetimePicker', true)
<script>
    $(function() {
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 260,
                minHeight: null,
                maxHeight: null,
                focus: false,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });

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
            $('.invalid-title').text('');
            $('.invalid-slug').text('');
            $('.invalid-photo').text('');
            $('.invalid-publish_date').text('');

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
                    window.location.href = "{{ url('/pages') }}"
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

        $('#basic_example_1').datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
        });
    });
</script>
@stop