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
                            <div class="timeline-step-next">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                                    <div class="inner-circle-next"></div>
                                    <p class="h6 mt-3 mb-1">Step 3</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0">Waktu & Obyek K3</p>
                                </div>
                            </div>
                            <div class="timeline-step-next">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                                    <div class="inner-circle-next"></div>
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
                    2. NOMOR SURAT PERMOHONAN
                </h3>
            </div>
            <div class="card-body">
                <!--<p class="text-lg text-center text-bold">FORMULIR</p>-->
                <p class="card-text">
                    Masukkan Nomor Surat Permohonan sesuai dengan Nomor Surat yang dilampirkan, pastikan Nomor Surat Permohonan adalah nomor yang berbeda dari Nomor Surat Permohonan yang sebelumnya pernah diajukan. Jika terdapat Nomor Surat yang sama atau Nomor Surat pernah diajukan sebelumnya akan mengakibatkan proses verifikasi oleh Admin menjadi lebih lama atau bahkan tidak bisa diproses. Jika verifikasi lebih dari 3 hari kerja, harap hubungi Admin atau klik tombol bantuan via chat WhatsApp
                </p>
                <div class="col-lg-6">
                    {{ Form::open(array('id' => 'MyForm','method'=>'post','name'=>'MyForm', 'class'=>'form-horizontal')) }}
                    <input type="hidden" name="step" value="{{ $step }}">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input class="form-control" type="text" name="no_surat" placeholder="Masukan Nomor Surat Pengajuan (PJK3)" value="{{ isset($data->no_surat)?$data->no_surat:'' }}">
                    <div class="invalid-feedback invalid-no_surat"></div>
                    {{ Form::close() }}
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-warning mr-1" href="{{ url('admin/proses/create/1') }}/{{ $id }}"><i class="fas fa-arrow-left"></i>&nbsp;Sebelumnya</a>
                    <button class="btn btn-success btn-action-next">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@stop
@section('js')
<script>
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
                url: "{{ url('admin/proses/store') }}",
                type: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.success) {
                        window.location.href = "{{ url('admin/proses/create/3')}}/" + result.data.id;
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