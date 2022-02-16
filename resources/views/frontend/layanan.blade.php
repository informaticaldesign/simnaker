@extends('frontend.page')
@section('title_prefix', 'Layanan K3 - ')
@section('title', 'Simnaker')
@section('content')
<!-- ======= Hero Section ======= -->
<div class="row p-1">
    <div class="col-sm-4">
        @include('frontend.auth.login')
    </div>
    <div class="col-sm-8">
        <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 layanan" src="{{ asset('images/s1.jpeg') }}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Layanan K3 Online</h5>
                        <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 layanan" src="{{ asset('images/s2.jpeg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Layanan K3 Online</h5>
                        <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 layanan" src="{{ asset('images/s3.jpeg') }}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Layanan K3 Online</h5>
                        <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 layanan" src="{{ asset('images/s4.jpeg') }}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Layanan K3 Online</h5>
                        <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 layanan" src="{{ asset('images/s5.jpeg') }}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Layanan K3 Online</h5>
                        <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" data-bs-target="#carouselExample" type="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" data-bs-target="#carouselExample" type="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<section id="clients" class="clients section-bg">
    <div class="container aos-init aos-animate" data-aos="zoom-in"></div>
</section>
<section id="featured-services" class="featured-services">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Layanan K3</h2>
            <h4>SELAMAT DATANG DILAYANAN K3 ONLINE</h4>
            <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box aos-init aos-animate" data-aos-delay="100">
                    <div class="icon"><i class="bx bx-book-open"></i></div>
                    <h4 class="title"><a href="">Syarat Pengajuan</a></h4>
                    <ul class="description" style="list-style-type:disc;">
                        <li>Memiliki Surat Keterangan Penunjukan (SKP) sebagai Perusahaan Jasa Keselamatan dan Kesehatan Kerja (PJK3) bidang Pemeriksaan dan Pengujian sesuai kualifikasi bidanganya yang Masih Berlaku, diterbitkan oleh Kementerian Ketenagakerjaan Republik Indonesia.</li>
                        <li>Memiliki Surat Keterangan Penunjukan (SKP) sebagai Perusahaan Jasa Keselamatan dan Kesehatan Kerja (PJK3) bidang Pemeriksaan dan Pengujian sesuai kualifikasi bidanganya yang Masih Berlaku, diterbitkan oleh Kementerian Ketenagakerjaan Republik Indonesia.</li>
                    </ul>
                    <!--<p class="description text-end"><a href="#">Unduh syarat pengajuan</a></p>-->
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon"><i class="bx bx-file"></i></div>
                    <h4 class="title"><a href="">Syarat Ketentuan</a></h4>
                    <ul class="description" style="list-style-type:disc;">
                        <li>Perusahaan yang belum memiliki akses online di SIMNAKER untuk melakukan pendaftar account terlebih dahulu.</li>
                        <li>PJK3 Wajib Mengisi formulir permohonan dengan benar dan lengkap agar proses verifikasi berjalan lebih cepat dan administrasi lebih terarah.</li>
                    </ul>
                    <!--<p class="description text-end"><a href="#">Unduh syarat pengajuan</a></p>-->
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon"><i class="bx bx-phone-call"></i></div>
                    <h4 class="title"><a href="">Hubungi Kami</a></h4>
                    <div class="row">
                        <div class="col-md-2 contact">
                            <div class="info-box mb-4 description" style="box-shadow: none !important; padding:0 !important;">
                                <i class="bx bx-map description" style="font-size: 30px !important; padding: 5px;"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <p class="description fw-normal fs-6">DINAS TENAGA KERJA DAN TRANSMIGRASI PROVINSI BANTEN
                                BIDANG PENGAWAS KETENAGAKERJAAN
                            </p>
                            <p class="description fw-lighter fs-6">
                                Kawasan Pusat Pemerintahan Provinsi Banten (KP3B)
                                JL. KH. Syech Nawawi Al-Bantani Palima
                                Kota Serang-Provinsi Banten.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 contact">
                            <div class="info-box mb-4" style="box-shadow: none !important; padding:0 !important;">
                                <i class="bx bx-phone-call description" style="font-size: 30px !important; padding: 5px;"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <p class="description fw-lighter fs-6 align-middle">Telephone/Fax : 0254-267111/112</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 contact">
                            <div class="info-box mb-4" style="box-shadow: none !important; padding:0 !important;">
                                <i class="bx bx-envelope description" style="font-size: 30px !important; padding: 5px;"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <p class="description fw-lighter fs-6">Email : info.simnaker@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@stop

@section('css')
<style>
    #bizland {
        width: 100%;
        height: 75vh;
        background-size: cover;
        position: relative;
    }
    img.layanan {
        height: 275px; 
        object-fit: cover;
    }
</style>
@stop
@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('button.btn-login').click(function (e) {
            $('button.btn-login').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-login').prop('disabled', true);
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $("form#MyFormLogin :input").each(function () {
                var inputName = $(this).attr('name');
                $('.invalid-' + inputName).text('');
            });
            $.ajax({
                url: "/login",
                method: 'post',
                data: $('#MyFormLogin').serialize(),
                success: function (result) {
                    window.location.href = "{{ url('home')}}";
                },
                error: function (err) {
                    console.log(err);
                    $.each(err.responseJSON.errors, function (i, error) {
                        var _field = $(document).find('[name="' + i + '"]');
                        _field.addClass('is-invalid');
                        var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                        el.css('display', 'block');
                        el.text(error[0]);
                    });
                    $('button.btn-login').html('<i class="fa fa-sign-in-alt"></i> Simpan');
                    $('button.btn-login').prop('disabled', false);
                }
            });
        });
    });
</script>
@stop