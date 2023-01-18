@extends('frontend.page')
@section('title_prefix', 'Login - ')
@section('title', 'Akta Pemeriksaan')
@section('content')
<div style="margin-top: 100px !important; background: linear-gradient(to top, #586a85, #ffffff); min-height:80%;">
    <div class="row" style="--bs-gutter-x: 0rem; padding:20px 20px 20px 20px;">
        <div class="col-md-6">
            <div class="text-center" style="padding: 20px;">
                <img src="{{ asset('images/loginaktapemeriksaan.png') }}">
                <p style="font-size: 14px; color:#ffffff; margin-top:20px;">Akte Pengawasan Ketenagakerjaan Dikeluarkan Berdasarkan Peraturan Menteri Tenaga Kerja Nomor 33 Tahun 2016 Tentang Tata Cara Pengawasan Ketenagakerjaan</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="padding: 20px;">
                <div class="card-body">
                    {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Masuk ke Akun</h3>
                            <p>Belum memiliki akun? <a href="{{ url('/akta-pemeriksaan') }}"><b>Daftar</b></a></p>
                            <!-- <div class="mb-3 mt-4">
                                <label for="nik" class="col-sm-12 col-form-label">Nomor Induk Kependudukan (No. KTP) <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nik" placeholder="Masukan Nomor Induk Kependudukan">
                                    <div class="invalid-feedback invalid-nik"></div>
                                </div>
                            </div> -->
                            <div class="mb-3">
                                <label for="email" class="col-sm-12 col-form-label">Alamat Email <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" placeholder="Masukan Alamat Email">
                                    <div class="invalid-feedback invalid-email"></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="col-sm-12 col-form-label">Password <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="password" placeholder="Masukan Password">
                                    <div class="invalid-feedback invalid-password"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary btn-lg btn-block btn-sm btn-action-daftar" style="width:100%; background-color:#1e375b; border-color:#1e375b;">Masuk</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('button.btn-action-daftar').click(function(e) {
            $('button.btn-action-daftar').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-action-daftar').prop('disabled', true);
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $("form#MyForm :input").each(function() {
                var inputName = $(this).attr('name');
                $('.invalid-' + inputName).text('');
            });
            var _form = $("form#MyForm");
            var formData = new FormData(_form[0]);
            $.ajax({
                url: "{{ url('akta-pemeriksaan/masuk') }}",
                type: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success) {
                        window.location.href = "{{ url('/admin')}}";
                    }
                },
                error: function(err) {
                    $.each(err.responseJSON.errors, function(i, error) {
                        var _field = $(document).find('[name="' + i + '"]');
                        _field.addClass('is-invalid');
                        var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                        el.css('display', 'block');
                        el.text(error[0]);
                    });
                    $('button.btn-action-daftar').html('Masuk');
                    $('button.btn-action-daftar').prop('disabled', false);
                }
            });
        });
    });
</script>
@stop