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
                    5. JENIS OBYEK K3
                </h3>
            </div>
            {{ Form::open(array('id' => 'MyForm','method'=>'post','name'=>'MyForm', 'class'=>'form-horizontal')) }}
            <input type="hidden" name="step" value="{{ $step }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="menu" value="proses">
            <div class="card-body">
                <!--<p class="text-lg text-center text-bold">FORMULIR</p>-->
                <p class="card-text">
                    Jika dalam permohonan terdapat Uji Riksa jenis PAA lampirkan file Data Tabel Objek jenis PAA disini, jika tidak ada lewati saja dan lanjutkan ke bagian berikutnya..
                </p>
                <div class="row mb-2">
                    <div class="col-lg-3">
                        <p>Jenis Obyek K3</p>
                        <div class="form-group">
                            <select class="form-control" id="id_pemeriksaan" name="id_pemeriksaan">
                                <option value="" selected disabled>Pilih Jenis Obyek K3</option>
                                @foreach ($pemeriksaan as $key => $jenis)
                                <option value="{{ $key }}" {{ $key == $data->id_pemeriksaan ? 'selected' : '' }}>{{ $jenis }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback invalid-id_pemeriksaan"></div>
                        </div>
                        <!--<button class="btn btn-outline-lite py-0 add_new_frm_field_btn_k3"><i class="fas fa-plus add_icon"></i> Tambah</button>-->
                    </div>
                    <div class="col-lg-3">
                        <p>Jumlah Obyek K3 Jenis PAA</p>
                        <div class="form-group">
                            <input type="number" class="form-control" name="jml_obyek" value="{{ $data->jml_obyek }}">
                            <div class="invalid-feedback invalid-jml_obyek"></div>
                        </div>
                        <!--<button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> Tambah</button>-->
                    </div>
                    <div class="col-lg-3">
                        <p>Lampirkan Tabel Data Objek K3</p>
                        @if($preview)
                         <a class="btn btn-primary btn-block text-white" href="{{ asset($data->attach_object_path) }}" target="_blank"><i class="fa fa-eye"></i> Lihat Lampiran</a>
                         @else
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="attach_object">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div class="invalid-feedback invalid-attach_object"></div>
                            </div>
                        </div>
                         @endif
                        <!--<button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> Tambah</button>-->
                    </div>
                    <div class="col-lg-3">
                        <p>Jenis Pemeriksaan</p>
                        <div class="form-group">
                            <select class="form-control" id="id_type_pem" name="id_type_pem">
                                <option value="" selected disabled>Pilih Jenis Pemeriksaan</option>
                                @foreach ($types as $key => $val)
                                <option value="{{ $key }}" {{ $key == $data->id_type_pem ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback invalid-id_type_pem"></div>
                        </div>
                        <!--<button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> Tambah</button>-->
                    </div>
                </div>
                @if($users->role_id == 35)
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-warning mr-1" href="{{ url('admin/proses/create/4') }}/{{ $id }}"><i class="fas fa-arrow-left"></i>&nbsp;Sebelumnya</a>
                    <button class="btn btn-success btn-action-next">Kirim&nbsp;<i class="fa fa-paper-plane"></i></button>
                </div>
                @else
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-warning mr-1" href="{{ url('admin/proses/create/4') }}/{{ $id }}"><i class="fas fa-arrow-left"></i>&nbsp;Sebelumnya</a>
                    <button class="btn btn-success btn-action-approve">Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i></button>
                </div>
                @endif
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
                        window.location.href = "{{ url('admin/proses')}}";
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
        
        $('button.btn-action-approve').click(function (e) {
            $('button.btn-action-approve').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-action-approve').prop('disabled', true);
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
                        window.location.href = "{{ url('admin/proses/create/6')}}/" + result.data.id;
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
                    $('button.btn-action-approve').html('Selanjutnya&nbsp;<i class="fas fa-arrow-right"></i>');
                    $('button.btn-action-approve').prop('disabled', false);
                }
            });
        });

    });
</script>
@stop