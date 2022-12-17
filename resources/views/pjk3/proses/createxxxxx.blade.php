@extends('adminlte::page')
@section('title', 'Pengajuan Suket')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pengajuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/proses') }}">Suket Online</a></li>
            <li class="breadcrumb-item active">Pengajuan</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline" style="border-top: 3px solid #1e375b;">
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-lg text-center text-bold">PERMOHONAN<br>SURAT KETERANGAN KESELAMATAN & KESEHATAN KERJA</p>
                <div class="row">
                    <div class="col">
                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                                    <div class="inner-circle"></div>
                                    <p c                    lass="h6 mt-3 mb                    -1">Step                    2</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Nomor Surat</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 3</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Waktu & Obyek K3</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 4</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Surat Permohonan</p>
                                </div>
                            </div>
                            <div class="timeline-step mb-0">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 5</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Jenis Obyek K3</p>
                                </div>
                            </div>
                            <div class="timeline-step mb-0">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 6</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Proses Persetujuan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col (left) -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    6. PROSES PERSETUJUAN DAN DELEGASI PEGAWAI
                </h3>
            </div>
            {{ Form::open(array('id' => 'MyForm','method'=>'post','name'=>'MyForm', 'class'=>'form-horizontal')) }}
            <input type="hidden" name="step" value="{{ $step }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="menu" value="proses">
            <div class="card-body">
                <!--<p class="text-lg text-center text-bold">FORMULIR</p>-->
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <p>Status Persetujuan</p>
                        <div class="form-group">
                            <select class="form-control" id="status" name="status">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="prosesupt">Diproses</option>
                            </select>
                            <div class="invalid-feedback invalid-status"></div>
                        </div>
                        <!--<button class="btn btn-outline-lite py-0 add_new_frm_field_btn_k3"><i class="fas fa-plus add_icon"></i> Tambah</button>-->
                    </div>
                </div>
                <div class="container-pegawai">
                    <p class="card-text">
                        Pilih pegawai untuk uji kegiatan pemeriksaan dan pengawasan
                    </p>
                    <table id="dtBasicExample"  class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr class="blockHeader">
                                <th width="40%">
                                    @if($data->status == 'proses')<input class="alignTop" type="checkbox" id="module_select_all">&nbsp; @endif Nama Pegawai
                                </th>
                                <th width="15%">
                                    NIP
                                </th>
                                <th width="15%">
                                    JABATAN
                                </th>
                                <th width="15%">
                                    PANGKAT
                                </th>
                                <th width="15%">
                                    GOLONGAN
                                </th>
                            </tr>
                        </thead>
                        @foreach($biodata as $module)
                        <tr>
                            <td> @if($data->status == 'proses')<input module_id="{{ $module->id }}" class="module_checkb" type="checkbox" name="pegawai[{{$module->id}}]" value="{{$module->id}}" id="pegawai_{{$module->id}}">&nbsp;@endif  {{ $module->name }}</td>
                            <td>{{ $module->nip }}</td>
                            <td>{{ $module->jabatan_name }}</td>
                            <td>{{ $module->pangkat_name }}</td>
                            <td>{{ $module->golongan_name }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @if($data->status == 'proses')
                    <div class="alert alert-danger alert-dismissible alert-pegawai">
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Silahkan pilih pegawai
                    </div>
                    @endif
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-warning mr-1" href="{{ url('admin/proses/create/4') }}/{{ $id }}"><i class="fas fa-arrow-left"></i>&nbsp;Sebelumnya</a>
                    <button class="btn btn-success btn-action-next">Proses&nbsp;<i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@stop
@section('js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
bsCustomFileInput.init();
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.alert-pegawai').hide();
    $('.container-pegawai').hide();
    $('select#status').on('change', function () {
        var _status = $(this).val();
        if(_status == 'prosesupt'){
            $('.container-pegawai').show();
        }else{
            $('.container-pegawai').hide();
        }
    });

    var table = $('#dtBasicExample').DataTable({
        pageLength: 100
    });
    $('#module_select_all').on('click', function () {
        // Get all rows with search applied
        var rows = table.rows({'search': 'applied'}).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle click on checkbox to set state of "Select all" control
    $('#dtBasicExample tbody').on('change', 'input[type="checkbox"]', function () {
        // If checkbox is not checked
        if (!this.checked) {
            var el = $('#module_select_all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if (el && el.checked && ('indeterminate' in el)) {
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
    });

    $('button.btn-action-next').click(function (e) {
        $('.alert-pegawai').hide();
        $('button.btn-action-next').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-next').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('admin/proses/store') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    window.location.href = "{{ url('admin/proses')}}";
                }
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    if (i == 'pegawai') {
                        $('.alert-pegawai').show();
                    } else {
                        var _field = $(document).find('[name="' + i + '"]');
                        _field.addClass('is-invalid');
                        var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                        el.css('display', 'block');
                        el.text(error[0]);
                    }
                });
                $('button.btn-action-next').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-next').prop('disabled', false);
            }
        });
    });

});
</script>
@stop