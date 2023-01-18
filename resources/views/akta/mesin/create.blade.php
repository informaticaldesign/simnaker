@extends('adminlte::page')
@section('title', 'Akta Pengawasan' )
@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Akta Pengawasan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <!-- <a href="{{ url('/admin') }}" class="btn btn-default"> <i class="fas fa-times"></i> Tutup</a>&nbsp;
            <button type="button" class="btn btn-danger btn-save btn-action-submit"><i class="far fa-save"></i> Simpan</button>&nbsp; -->
        </ol>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('route' => 'admin.pengawasan.store','method'=>'post', 'enctype'=>"multipart/form-data", 'id'=>'form-input')) }}
<input type="hidden" name="id">
<?php
$widthLabel = 'col-sm-3 col-form-label';
$widthField = 'col-sm-6';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <h6>Penggunaan mesin-mesin produksi di Perusahaan berdasarkan Undang-undang Nomor 1 Tahun 1970 tentang Keselamatan Kerja.</h6>
                    </div>
                </div>
                <hr>
                <div class="form-group row mt-1">
                    <label for="company_id" class="{{ $widthLabel }}">Nama Perusahaan <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::select('company_id',[],old('company_id'),['class'=>'form-control','id'=>'company_id']); }}
                        <div class="invalid-feedback invalid-company_id"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="{{ $widthLabel }}">Alamat</label>
                    <div class="{{ $widthField }}">
                        {{ Form::textarea('address', old('address'),['class'=>'form-control','rows'=>3,'id'=>'address']); }}
                        <div class="invalid-feedback invalid-address"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jml_cabang" class="{{ $widthLabel }}">Data Mesin Produksi <span class="text-danger">*</span> <button class="btn btn-md btn-primary" id="addBtn" type="button" value="0">
                            Tambah Data
                        </button>
                    </label>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Mesin</th>
                                    <th>Jumlah motor Listrik</th>
                                    <th>Kekuatan/ Daya MotorListrik (TK.KW.HP)</th>
                                    <th>Jumlah Daya/Kekuatan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
                                        {{ Form::text('nama_motor[0]',null,['class'=>'form-control','id'=>'nama_motor']); }}
                                        <div class="invalid-feedback invalid-nama_motor.0"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('jml_motor[0]',null,['class'=>'form-control','id'=>'jml_motor']); }}
                                        <div class="invalid-feedback invalid-jml_motor.0"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('daya_motor[0]',null,['class'=>'form-control','id'=>'daya_motor']); }}
                                        <div class="invalid-feedback invalid-daya_motor.0"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('ttl_daya_motor[0]',null,['class'=>'form-control','id'=>'ttl_daya_motor']); }}
                                        <div class="invalid-feedback invalid-ttl_daya_motor.0"></div>
                                    </td>
                                    <td>
                                        {{ Form::text('keterangan[0]',null,['class'=>'form-control','id'=>'keterangan']); }}
                                        <div class="invalid-feedback invalid-keterangan.0"></div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove" type="button">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="form-group row text-right">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success btn-save btn-action-submit"><i class="far fa-save"></i> Simpan</button>&nbsp;
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
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
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
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $eventSelect = $("#company_id");
            $eventSelect.select2({
                placeholder: 'Pilih perusahaan',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ url('admin/pengawasan/get-company') }}",
                    dataType: 'json',
                    delay: 150,
                    data: function(params) {
                        console.log(1232)
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        };
                    },
                    cache: true
                },
            });

            $eventSelect.on("select2:selecting", function(e) {
                $('#address').val(e.params.args.data.address);
            });

            $('button.btn-action-submit').click(function(e) {
                $('button.btn-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                $('button.btn-save').prop('disabled', true);
                event.preventDefault();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-tgl_pemeriksaan').text('');

                var _form = $("#form-input");
                var formData = new FormData(_form[0]);
                $.ajax({
                    url: "{{ route('admin.pengawasan.mesin.store') }}",
                    type: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
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
                            toastr.success('Pengajuan Akta Pengawasan Berhasil', 'Success');
                        } else {
                            toastr.error('Update LHP Pengawasan Gagal', 'Error');
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

            $("#tgl_pemeriksaan").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });

            var rowIdx = 0;

            // jQuery button click event to add a row.
            $('#addBtn').on('click', function() {
                var _row = '<tr>';
                var _rowNum = $(this).val();
                var _roxIdx = parseInt(_rowNum) + 1;
                $(this).val(_roxIdx)
                _row += '<td>';
                _row += '<input class="form-control" id="nama_motor" name="nama_motor[' + _roxIdx + ']" type="text">';
                _row += '<div class="invalid-feedback invalid-nama_motor.' + _roxIdx + '"></div>';
                _row += '</td>';
                _row += '<td>';
                _row += '<input class="form-control" id="jml_motor" name="jml_motor[' + _roxIdx + ']" type="number">';
                _row += '<div class="invalid-feedback invalid-jml_motor.' + _roxIdx + '"></div>';
                _row += '</td>';
                _row += '<td>';
                _row += '<input class="form-control" id="daya_motor" name="daya_motor[' + _roxIdx + ']" type="number">';
                _row += '<div class="invalid-feedback invalid-daya_motor.' + _roxIdx + '"></div>';
                _row += '</td>';
                _row += '<td>';
                _row += '<input class="form-control" id="ttl_daya_motor" name="ttl_daya_motor[' + _roxIdx + ']" type="number">';
                _row += '<div class="invalid-feedback invalid-ttl_daya_motor.' + _roxIdx + '"></div>';
                _row += '</td>';
                _row += '<td>';
                _row += '<input class="form-control" id="keterangan" name="keterangan[' + _roxIdx + ']" type="text">';
                _row += '<div class="invalid-feedback invalid-keterangan.' + _roxIdx + '"></div>';
                _row += '</td>';
                _row += '<td>';
                _row += '<button class="btn btn-danger remove" type="button">Remove</button>';
                _row += '</td>';
                _row += '</tr>';
                $('#tbody').append(_row);
            });

            $('#tbody').on('click', '.remove', function() {

                // Getting all the rows next to the 
                // row containing the clicked button
                var child = $(this).closest('tr').nextAll();

                // Iterating across all the rows 
                // obtained to change the index
                child.each(function() {

                    // Getting <tr> id.
                    var id = $(this).attr('id');

                    // Getting the <p> inside the .row-index class.
                    var idx = $(this).children('.row-index').children('p');

                    // Gets the row number from <tr> id.
                    var dig = parseInt(id.substring(1));

                    // Modifying row index.
                    idx.html(`Row ${dig - 1}`);

                    // Modifying row id.
                    $(this).attr('id', `R${dig - 1}`);
                });

                // Removing the current row.
                $(this).closest('tr').remove();

                // Decreasing the total number of rows by 1.
                rowIdx--;
            });

        });
    </script>
    @stop