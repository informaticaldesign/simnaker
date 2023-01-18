@extends('frontend.page')
@section('title_prefix', 'Beranda - ')
@section('title', 'Sistem Informasi Pelaporan Pengawasan Ketenagakerjaan')
@section('content')
<link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!-- ======= Hero Section ======= -->
<div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 80px;">
    <div id="header-carousel">
        <img src="{{ asset('images/home-banner.jpg') }}" width="100%">
    </div>
    <section id="features" class="features-area item-full text-center cell-items default-padding" style="background: linear-gradient(to top, #586a85, #ffffff);">
        <div class="container">
            <div class="row features-items">
                <div class="col-md-4 col-sm-6 equal-height">
                    <a href="{{ url('/akses') }}">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-tv"></i>
                            </div>
                            <div class="info">
                                <h4>Daftar Perusahaan</h4>
                                <p>Daftar perusahaan yang sudah terdaftar di system ketenagakerjaan.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 equal-height">
                    <a target="_blank" href="https://smartk3.id/">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="info">
                                <h4>Layanan P2K3</h4>
                                <p>Layanan Panitia Pembina Keselamatan dan Kesehatan Kerja.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 equal-height">
                    <a href="{{ url('/layanan') }}">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="info">
                                <h4>Layanan PJK3</h4>
                                <p>Daftar Perusahaan Jasa Keselamatan dan Kesehatan Kerja.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 equal-height">
                    <a href="{{ url('/layanan-pengaduan') }}">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-pen-fancy"></i>
                            </div>
                            <div class="info">
                                <h4>Layanan Pengaduan</h4>
                                <p>Layanan Pengaduan Masyarakat Bidang ketenagakerjaan.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 equal-height">
                    <a href="{{ url('/akta-pemeriksaan') }}">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="info">
                                <h4>Akta Pengawasan</h4>
                                <p>Akta Pengawasan Ketenagakerjaan Provinsi Banten.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 equal-height">
                    <a href="{{ url('/regulasi') }}">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-diagnoses"></i>
                            </div>
                            <div class="info">
                                <h4>Regulasi Ketenagakerjaan</h4>
                                <p>Informasi Peraturan Perundang-undangan Bidang Ketenaagkerjaan.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('css')
<style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    /********** Template CSS **********/
    :root {
        --primary: #009CFF;
        --secondary: #777777;
        --light: #F8F8F8;
        --dark: #252525;
    }

    .back-to-top {
        position: fixed;
        display: none;
        right: 30px;
        bottom: 30px;
        z-index: 99;
    }


    /*** Spinner ***/
    #spinner {
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s ease-out, visibility 0s linear .5s;
        z-index: 99999;
    }

    #spinner.show {
        transition: opacity .5s ease-out, visibility 0s linear 0s;
        visibility: visible;
        opacity: 1;
    }


    /*** Header ***/
    #header-carousel .carousel-caption {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .1);
        z-index: 1;
    }

    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(../images/carousel-1.jpg) center center no-repeat;
        background-size: cover;
    }


    /*** Footer ***/
    .footer .btn.btn-link {
        display: block;
        margin-bottom: 5px;
        padding: 0;
        text-align: left;
        color: var(--secondary);
        font-weight: normal;
        text-transform: capitalize;
        transition: .3s;
    }

    .footer .btn.btn-link::before {
        position: relative;
        content: "\f105";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: var(--secondary);
        margin-right: 10px;
    }

    .footer .btn.btn-link:hover {
        color: var(--primary);
        letter-spacing: 1px;
        box-shadow: none;
    }

    .footer .copyright {
        padding: 25px 0;
        font-size: 15px;
        border-top: 1px solid rgba(256, 256, 256, .1);
    }

    .footer .copyright a {
        color: var(--light);
    }

    .footer .copyright a:hover {
        color: var(--primary);
    }

    /** our services */
    section#features {
        padding: 20px 0;
        min-height: 50vh;
    }

    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .bg-gray {
        background-color: #f9f9f9;
    }

    .site-heading h2 {
        display: block;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .site-heading h2 span {
        color: #ffaf5a;
    }

    .site-heading h4 {
        display: inline-block;
        padding-bottom: 20px;
        position: relative;
        text-transform: capitalize;
        z-index: 1;
    }

    .site-heading h4::before {
        background: #ffaf5a none repeat scroll 0 0;
        bottom: 0;
        content: "";
        height: 2px;
        left: 50%;
        margin-left: -25px;
        position: absolute;
        width: 50px;
    }

    .site-heading {
        margin-bottom: 60px;
        overflow: hidden;
        margin-top: -5px;
    }


    .features-items,
    .features-items .items-box {
        overflow: hidden;
    }

    .features-area .equal-height::after {
        background: #e7e7e7 none repeat scroll 0 0;
        content: "";
        height: 100%;
        position: absolute;
        right: -1px;
        top: 0;
        width: 1px;
    }

    /* .features-area.item-full .equal-height::before {
        background: #e7e7e7 none repeat scroll 0 0;
        content: "";
        height: 1px;
        position: absolute;
        bottom: -1px;
        right: 0;
        width: 100%;
    } */

    .features-area .features-items .col-md-5,
    .features-area .features-items .col-md-7 {
        display: table-cell;
        float: none;
        vertical-align: middle;
    }

    .features-area .features-items.reversed .col-md-5,
    .features-area .features-items.reversed .col-md-7 {
        display: inline-block;
        float: left;
    }

    .features-area .features-items.reversed .info-box {
        float: right;
    }

    .features-area .features-items .item {
        padding: 15px 30px;
    }

    .features-area.item-full .features-items .item {
        padding: 30px;
    }

    .features-area .features-items .item h4 {
        position: relative;
    }

    .features-area.bottom-small {
        padding-bottom: 25px;
    }

    .features-area.default-padding.bottom-none {
        padding-bottom: 30px;
    }

    .features-area .item .icon {
        margin-bottom: 20px;
    }

    .features-area .item .info {
        color: black;
    }

    .features-area .item .icon i {
        background: #ffffff none repeat scroll 0 0;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -moz-box-shadow: 0 0 10px #cccccc;
        -webkit-box-shadow: 0 0 10px #cccccc;
        -o-box-shadow: 0 0 10px #cccccc;
        box-shadow: 0 0 10px #cccccc;
        color: #1e375b;
        display: inline-block;
        font-size: 30px;
        height: 100px;
        line-height: 100px;
        position: relative;
        text-align: center;
        width: 100px;
        z-index: 1;
        border-color: #9aa3b5;
        border-style: solid;
    }

    .features-area .features-items .items-box i {
        background: transparent;
    }

    .features-area .item .icon {
        margin-bottom: 25px;
    }

    .features-area .features-items.icon-solid i {
        border-radius: inherit;
        -moz-box-shadow: 0 0 10px #cccccc;
        -webkit-box-shadow: 0 0 10px #cccccc;
        -o-box-shadow: 0 0 10px #cccccc;
        box-shadow: 0 0 10px #cccccc;
        color: #1e375b;
        display: inline-block;
        font-size: 50px;
        height: 80px;
        line-height: 80px;
        position: relative;
        text-align: center;
        width: 80px;
    }


    .features-area .item .info h4 {
        font-weight: 600;
        text-transform: capitalize;
        font-size: 20px;
    }

    .features-area .item .info p {
        margin: 0;
    }

    .features-area .features-items.less-icon .items-box.inc-cell .item .info {
        padding-left: 0;
    }

    .features-area .features-items .items-box.inc-cell .item .info a {
        color: #666666;
        display: inline-block;
        margin-top: 15px;
        text-transform: uppercase;
    }

    .features-area .features-items .items-box.inc-cell .item .info a:hover {
        color: #ffaf5a;
    }
</style>
@stop