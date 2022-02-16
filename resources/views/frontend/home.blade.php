@extends('frontend.page')
@section('title_prefix', 'Beranda - ')
@section('title', 'Sistem Informasi Pelaporan Pengawasan Ketenagakerjaan')
@section('content')
<link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!-- ======= Hero Section ======= -->
<section id="bizland" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100" style="max-width: 100% !important; padding-right: var(--bs-gutter-x,.0rem) !important;padding-left: var(--bs-gutter-x,.0rem) !important;">
        <div id="map"></div>
    </div>
</section>
@if(!Auth::user())
<section id="clients" class="clients section-bg">
    <div class="container aos-init aos-animate" data-aos="zoom-in"></div>
</section>
<div class="row m-1">
    <div class="col-sm-4">
        @include('frontend.auth.login')
    </div>
    <div class="col-sm-8">
        <div class="row mt-1 pt-1">
            <p class="fw-bold" style="margin-bottom:5px !important;">CEK KEABSAHAN BERKAS K3</p>
        </div>
        <div class="row d-flex align-items-start mt-1">
            <div class="col-md-1">
                <i class="fa fa-barcode fa-3x" style="color:#1e375b !important;"></i>
            </div>
            <div class="col-md-11 pt-1">
                {{ Form::open(array('id' => 'MyFormCekBerkas','name'=>'MyFormCekBerkas', 'class'=>'row','style'=>"margin-bottom:0px !important;")) }}
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Nomor Berkas" name="no_berkas">
                    <div class="invalid-feedback invalid-no_berkas"></div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mb-3 btn-cek-berkas" style="background-color:#1e375b !important; color:#fff !important; border-color: #1e375b !important;"><i class="fa fa-check"></i>&nbsp;Cek Sekarang</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 contact">
                <div class="info-box mb-1 description" style="box-shadow: none !important; padding:0 !important;">
                    <i class="bx bx-map description" style="font-size: 30px !important; padding: 5px;"></i>
                </div>
            </div>
            <div class="col-md-10">
                <p class="description fw-normal fs-6" style="margin-bottom:0px !important;">DINAS TENAGA KERJA DAN TRANSMIGRASI PROVINSI BANTEN
                    BIDANG PENGAWAS KETENAGAKERJAAN
                </p>
                <p class="description fw-lighter fs-6" style="margin-bottom:0px !important;">
                    Kawasan Pusat Pemerintahan Provinsi Banten (KP3B)
                    JL. KH. Syech Nawawi Al-Bantani Palima
                    Kota Serang-Provinsi Banten.
                </p>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-md-1 contact">
                <div class="info-box mb-2" style="box-shadow: none !important; padding:0 !important;">
                    <i class="bx bx-phone-call description" style="font-size: 30px !important; padding: 5px;"></i>
                </div>
            </div>
            <div class="col-md-10">
                <p class="description fw-lighter fs-6 align-middle">Telephone/Fax : 0254-267111/112</p>
            </div>
        </div>
        <div class="row d-flex align-items-start">
            <div class="col-md-1 contact">
                <div class="info-box mb-1" style="box-shadow: none !important; padding:0 !important;">
                    <i class="bx bx-envelope description" style="font-size: 30px !important; padding: 5px;"></i>
                </div>
            </div>
            <div class="col-md-10">
                <p class="description fw-lighter fs-6">Email : info.simnaker@gmail.com</p>
            </div>
        </div>
    </div>
</div>
<div id="WAButton"></div>
@endif
@stop

@section('css')
<style>
    #bizland {
        width: 100%;
        height: 75vh;
        background-size: cover;
        position: relative;
    }

    #map {
        height: 75vh;
        width: 100%;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
@stop
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgaWFBpt4UyShxn_m-Ax5PVquLK4VemSw"></script>
<script src="{{ asset('js/markerclusterer.js') }}"></script>
<script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
<script>
var urlFetch = "{{ route('beranda.fetch') }}";
var urlMarker = "{{ asset('bizland/img/m') }}";
var urlLogo = "{{ url('/') }}/";
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#WAButton').floatingWhatsApp({
            phone: '+62 813 8000 1903',
            headerTitle: 'Butuh bantuan!',
            popupMessage: 'Hello, bagaimana kami dapat membantu Anda?',
            showPopup: true,
            buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
            headerColor: '#1e375b',
            backgroundColor: '#1e375b',
            position: "right"
        });

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
        $('button.btn-cek-berkas').click(function (e) {
            $('button.btn-cek-berkas').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $('button.btn-cek-berkas').prop('disabled', true);
            e.preventDefault();
            var _field = $(document).find('[name="no_berkas"]');
            _field.addClass('is-invalid');
            var el = $(document).find('[class="invalid-feedback invalid-no_berkas"]');
            el.css('display', 'block');
            el.text('Nomor Berkas Tidak Terdaftar');
            $('button.btn-cek-berkas').html('<i class="fa fa-check"></i>&nbsp;Cek Sekarang');
            $('button.btn-cek-berkas').prop('disabled', false);
        });
    });

    var markers = [];
    const infoWindow = new google.maps.InfoWindow({
        maxWidth: 200
    });
    function initialize() {
        var center = new google.maps.LatLng(-6.364233, 106.272860);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });


        map.addListener('click', () => {
            if (infoWindow) {
                infoWindow.close();
            }
        });

        var request = $.ajax({
            type: 'GET',
            dataType: 'json',
            url: urlFetch,
        });
        request.done(function (data) {
            if (data.photos.length > 0) {
                $.each(data.photos, function (i, item) {
                    var dataPhoto = data.photos[i];
                    var latLng = new google.maps.LatLng(dataPhoto.latitude, dataPhoto.longitude);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        title: dataPhoto.name,
                        animation: google.maps.Animation.DROP,
                        label: {
                            fontFamily: "'Font Awesome 5 Free'",
                            text: '\uf1ad',
                            fontWeight: '500',
                            fontSize: "16px",
                            color: '#fff',
                        }
                    });
                    markers.push(marker);
                    marker.addListener('click', function () {
                        infoWindow.setContent(`
                            <img src="` + urlLogo + dataPhoto.logo_path + `" alt="` + dataPhoto.name + `" width="100" class="center">
                            <h6>` + dataPhoto.name + `</h6>
                            <hr>
                            <p>` + dataPhoto.address + `<br>
                            <i class="fa fa-phone"></i>&nbsp;` + dataPhoto.phone + `<br><i class="fa fa-envelope"></i>&nbsp;` + dataPhoto.email + `</p>
                          `);
                        infoWindow.open(map, marker);
                    });
                });
                var markerCluster = new MarkerClusterer(map, markers, {imagePath: urlMarker});
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop