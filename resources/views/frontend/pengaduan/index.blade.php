@extends('frontend.page')
@section('title_prefix', 'Register - ')
@section('title', 'Simnaker')
@section('content')
<div style="margin-top: 110px !important; background: linear-gradient(to top, #586a85, #ffffff);">
    <nav aria-label="breadcrumb" style="padding-left: 20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Layanan Pengaduan</li>
        </ol>
    </nav>
    <div class="row" style="--bs-gutter-x: 0rem; padding:20px 20px 20px 20px;">
        <div class="col-md-6">
            <div class="text-center">
                <img src="{{ asset('images/frontend/layananpengaduan.png') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Form Layananan Pengaduan</h5>
                </div>
                <div class="card-body">
                    {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-1">
                                <label for="nib" class="col-sm-12 col-form-label">Pilih Klasifikasi Laporan Anda<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="radio" name="jenis" id="rdo-pengaduan" checked value="pengaduan"> Pengaduan
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="jenis" id="rdo-aspirasi" value="aspirasi"> Aspirasi
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="jenis" id="rdo-permintaan-informasi" value="permintaan_informasi"> Permintaan Informasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="name" class="col-sm-12 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" placeholder="">
                                    <div class="invalid-feedback invalid-name"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="email" class="col-sm-12 col-form-label">Alamat Email <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" placeholder="">
                                    <div class="invalid-feedback invalid-email"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="phone" class="col-sm-12 col-form-label">Nomor Telephone <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="phone" placeholder="">
                                    <div class="invalid-feedback invalid-phone"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="kategori" class="col-sm-12 col-form-label">Kategori Pengaduan<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="kategori" name="kategori">
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        @foreach ($categories as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback invalid-kategori"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="lokasi" class="col-sm-12 col-form-label">Lokasi Kejadian<span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="lokasi" name="lokasi">
                                        <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                        @foreach ($kotas as $key => $kota)
                                        <option value="{{ $key }}">{{ $kota }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback invalid-lokasi"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="judul" class="col-sm-12 col-form-label">Judul Laporan <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="judul" placeholder="">
                                    <div class="invalid-feedback invalid-judul"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="laporan" class="col-sm-12 col-form-label">Isi Laporan <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="laporan" rows="5"></textarea>
                                    <div class="invalid-feedback invalid-laporan"></div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="lampiran" class="col-sm-12 col-form-label">Upload Bukti <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="lampiran">
                                    <div class="invalid-feedback invalid-lampiran"></div>
                                    <div class="alert alert-warning mt-1">
                                        <h6><i class="icon fas fa-exclamation-triangle"></i> Informasi!</h6>
                                        <ul>
                                            <li>Dokumen bukti yang di upload berformat image atau pdf </li>
                                            <li>Maksimal ukuran file untuk di upload tidak boleh lebih dari 2MB</li>
                                            <li>Untuk dokumen yang lebih dari 1 file, bisa di <a href="https://pdfsimpli.com/" target="_blank">gabungin</a> menjadi 1 file format pdf.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary float-end btn-action-daftar mr-2" style="background-color:#1e375b; border-color: #1e375b;">
                                        Kirim&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                    <a class="btn btn-default" href="{{ url('/') }}">
                                    <i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali
                                    </a>
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
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <input class="form-control controls mt-1" id="pac-input" type="text" placeholder="Ketik Alamat" />
                <div id="map"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-pick"><i class="far fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger btn-action-close" data-dismiss="modal">Tutup</button>
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
                url: "{{ url('layanan-pengaduan/submit') }}",
                type: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success) {
                        Swal.fire({
                            title: 'Pengaduan Diterima',
                            text: "Kami akan verifikasi dan proses pengaduan anda 1x24, terima kasih sudah menggunakan layanan pengaduan online kami.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#1e375b',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            window.location.href = "{{ url('/')}}";
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: "Pengaduan gagal disimpan",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#dc3741',
                            confirmButtonText: 'Tutup'
                        });
                    }
                },
                error: function(err) {
                    $.each(err.responseJSON.message, function(i, error) {
                        var _field = $(document).find('[name="' + i + '"]');
                        _field.addClass('is-invalid');
                        var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                        el.css('display', 'block');
                        el.text(error[0]);
                    });
                    $('button.btn-action-daftar').html('<i class="far fa-save"></i> Simpan');
                    $('button.btn-action-daftar').prop('disabled', false);
                }
            });
        });
    });
</script>
@stop