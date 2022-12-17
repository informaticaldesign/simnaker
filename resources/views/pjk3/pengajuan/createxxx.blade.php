@extends('adminlte::page')
@section('title', 'Pengajuan Suket')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pengajuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/pengajuan') }}">Suket Online</a></li>
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
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 1</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Formulir</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                                    <div class="inner-circle"></div>
                                    <p class="h6 mt-3 mb-1">Step 2</p>
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
                            <div class="timeline-step-next mb-0">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 5</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Jenis Obyek K3</p>
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
                    4. SURAT PERMOHONAN
                </h3>
            </div>
            {{ Form::open(array('id' => 'MyForm','method'=>'post','name'=>'MyForm', 'class'=>'form-horizontal')) }}
            <input type="hidden" name="step" value="{{ $step }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="menu" value="pengajuan">
            <div class="card-body">
                <!--<p class="text-lg text-center text-bold">FORMULIR</p>-->
                <p class="card-text">
                    Lampirkan Surat Permohonan disini, file harus berbentuk PDF dan maksimal ukuran file 2 MB. Pastikan surat sudah ditandatangani dan dicap sebelum discan dan dilampirkan..
                </p>
                @if($preview)
                <div class="col-md-4">
                    <a class="btn btn-primary btn-block text-white" href="{{ asset($data->lampiran_path) }}" target="_blank"><i class="fa fa-eye"></i> Lihat Lampiran</a>
                </div>
                @else
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="lampiran" class="custom-file-input" id="customFile" value="">
                            <label class="custom-file-label" for="customFile">Upload Surat Permohonan  (Format File.pdf)</label>
                            <div class="invalid-feedback invalid-lampiran"></div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-warning mr-1" href="{{ url('admin/pengajuan/create/3') }}/{{ $id }}"><i class="fas fa-arrow-left"></i>&nbsp;Sebelumnya</a>
                    <button class="btn btn-success btn-action-next">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></button>
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
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button.btn-action-next').click(function (e) {
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
            url: "{{ url('admin/pengajuan/store') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    window.location.href = "{{ url('admin/pengajuan/create/5')}}/" + result.data.id;
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
                $('button.btn-action-next').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
                $('button.btn-action-next').prop('disabled', false);
            }
        });
    });
});
</script>
@stop