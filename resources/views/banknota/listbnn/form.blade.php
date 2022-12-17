@extends('adminlte::page')

@section('title', 'Bank Nota II')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Bank Nota II</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/listbnn') }}">Bank Nota II</a></li>
            <li class="breadcrumb-item active">Buat Bank Nota II</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                @if(isset($jenis->id))
                <input type="hidden" name="id" value="{{ isset($jenis->id) ? $jenis->id:'' }}">
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1">
                                    <label for="document_no" class="col-sm-12 col-form-label">Nomor<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="document_no" id="document_no" value="{{ isset($doc_no)?$doc_no:'Nota Pemeriksaan' }}" readonly>
                                        <div class="invalid-feedback invalid-document_no"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="spt_id" class="col-sm-12 col-form-label">Nomor Bank Nota I <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <select class="form-control status" id="spt-id" name="spt_id">
                                            <option value="" selected disabled>Pilih Nomor Bank Nota I</option>
                                            @foreach($spt as $key => $val)
                                            <option value="{{ $key }}" {{ (isset($jenis->status) && $jenis->status=='active')?'selected':'' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback invalid-spt_id"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="sifat_id" class="col-sm-12 col-form-label">Sifat <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="sifat_id">
                                            <option value="" selected disabled>Pilih Sifat Dokumen</option>
                                            @foreach($sifat as $key => $val)
                                            <option value="{{ $key }}" {{ (isset($jenis->status) && $jenis->status=='active')?'selected':'' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback invalid-sifat_id"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="kota" class="col-sm-12 col-form-label">Kota <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="kota">
                                            <option value="" selected disabled>Pilih Kota</option>
                                            @foreach($kotas as $key => $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback invalid-kota"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="perihal" class="col-sm-12 col-form-label">Perihal<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="perihal" id="perihal" value="{{ isset($jenis->perihal)?$jenis->perihal:'Nota Pemeriksaan II' }}">
                                        <div class="invalid-feedback invalid-perihal"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Bank Nota II<span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="tanggal" id="tanggal">
                                        <div class="invalid-feedback invalid-tanggal"></div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label for="jenis_id" class="col-sm-12 col-form-label">Tembusan Surat<span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-jenis-bank-nota" data-id="1">
                                        <div class="row row-jenis-bank-nota mt-1 row-0">
                                            <div class="col-10">
                                                <select class="form-control" name="jenis_id[0]">
                                                    <option value="" selected>Pilih Tembusan Surat</option>
                                                    @foreach($jenis as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback invalid-jenis_id.0"></div>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-danger btn-remove-jenis-bank-nota" data-value="0"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <div class="row row-jenis-bank-nota mt-1 row-1"></div>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-success btn-add-jenis-bank-nota"><i class="fa fa-plus ml"></i> Tambah Tembusan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="">
                                    <h6 id="company-label"></h6>
                                    <h2 id="company-name"></h2>
                                    <p id="company-address" class="lead"></p>
                                    <p id="company-phone" class="lead"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="card-footer">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ url('/banknota/listbnn') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>&nbsp;
                <button type="button" class="btn btn-info btn-action-save">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@stop

@section('js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#company-label').hide();
    $('#company-name').hide();
    $('#company-address').hide();
    $('#company-phone').hide();

    $('.form-control').removeClass('is-invalid');
    $("form#MyForm :input").each(function () {
        var inputName = $(this).attr('name');
        $('.invalid-' + inputName).text('');
    });


    $('button.btn-action-save').click(function (e) {

        $('button.btn-action-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-save').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            if (inputName !== undefined) {
                $('.invalid-' + inputName).text('');
            }
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('banknota/listbnn/store') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    window.location.href = "{{ url('banknota/listbnn/preview')}}" + "/" + result.uuid;
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: " Jenis Bank Nota gagal dibuat",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('Submit&nbsp;<i class="fas fa-arrow-right"></i>');
                        $('button.btn-action-save').prop('disabled', false);
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
                $('button.btn-action-save').html('Submit&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });

    $(document).on("click", "button.btn-add-jenis-bank-nota", function (e) {
        e.preventDefault();
        var _jmlRow = $('div.col-jenis-bank-nota').attr('data-id');
        $('div.col-jenis-bank-nota').attr('data-id', (parseInt(_jmlRow) + 1));
        $('div.col-jenis-bank-nota').append('<div class="row row-jenis-bank-nota mt-1 row-' + (parseInt(_jmlRow) + 1) + '"></div>');
        $('div.row-' + parseInt(_jmlRow)).html($('div.row-jenis-bank-nota').html());
        $('div.row-' + parseInt(_jmlRow)).children('div.col-2').children('button').attr('data-value', parseInt(_jmlRow));
        $('div.row-' + parseInt(_jmlRow)).children('div.col-10').children('select').attr('name', 'jenis_id[' + parseInt(_jmlRow) + ']');
        $('div.row-' + parseInt(_jmlRow)).children('div.col-10').children('div.invalid-feedback').attr('class', 'invalid-feedback invalid-jenis_id.' + parseInt(_jmlRow));
    }).on('click', 'button.btn-remove-jenis-bank-nota', function (e) {
        e.preventDefault();
        var _row = $(this).attr('data-value');
        $('div.row-' + _row).remove();
    }).on('change', '#spt-id', function (e) {
        $.get("/banknota/listbnn" + '/' + $(this).val() + '/spt', function (data) {
            $('#company-label').show();
            $('h6#company-label').text('Nama Perusahaan :');
            $('#company-name').show();
            $('#company-name').text(data.company_name);
            $('#company-address').show();
            $('#company-address').text(data.company_address);
            $('#company-phone').show();
            $('#company-phone').text(data.company_phone);
        });
    });

    $("#tanggal").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});
</script>
@stop