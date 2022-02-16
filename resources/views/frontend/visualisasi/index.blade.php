@extends('frontend.page')
@section('title', 'Open Data - Visualisasi')
@section('content')
<!--<div class="container mt-3">
    <div class="mt-n4">
        <div class="col-md-12 text-white bg-biru-muda rounded pr-0">
            <h6 class="font-weight-bolder py-3 px-3">
                <a class="text-white text-decoration-none text-reset" href=""><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                &nbsp; / &nbsp;
                <a class="text-white text-decoration-none text-reset" href="">Visualisasi</a>
                &nbsp; / &nbsp;
                <span>Data Pemantauan COVID-19</span>
            </h6>
        </div>
    </div>
</div>-->
<div class="container search-header">
    <section class="content">
        <h1 class="section-title">
            Visualisasi
        </h1>
        <form class="search-box " action="/search" method="get">
            <input class="search-box-text ga-search-bar " type="text" name="q" value="" autocomplete="off" placeholder="Cari Visualisasi">
            <button type="submit">
                <img src="{{ asset('images/frontend/icons/Search.svg') }}">
            </button>
        </form>
    </section>
</div>
<main class="site-main">
    <div class="container search-main">
        <div class="search-container-right">
            <section class="search-results">
                <div class="search-results-header">
                    <h2 class="section-title">
                        @if( $visualisasis->count() > 0 )
                        {{ $visualisasis->count() }} Visualisasi ditemukan
                        @else
                        Visualisasi tidak ditemukan
                        @endif
                    </h2>
                    <div class="search-filter">
                        <span class="section-title filter-title">Urutkan: </span>
                        <select class="search-filter-select ga-search-sortby">
                            <option value="/search?sort=score+desc%2C+metadata_modified+desc" selected="selected">
                                Relevance
                            </option>
                            <option value="/search?sort=title_string+asc">
                                Name Ascending
                            </option>
                            <option value="/search?sort=title_string+desc">
                                Name Descending
                            </option>
                            <option value="/search?sort=metadata_modified+desc">
                                Last Modified
                            </option>
                        </select>
                    </div>
                </div>
                @if( $visualisasis->count() > 0 )
                <div class="row">
                    @foreach($visualisasis as $val)
                    <div class="col-md-3 mt-3">
                        <div class="card" style="padding: 0px !important; height: 280px">
                            <div class="embed-responsive embed-responsive-16by9">
                                <img alt="Card image cap" class="card-img-top embed-responsive-item" src="{{ url('/uploads/visualisasi/thumbnails') }}/{{ $val->icon }}" />
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="{{ url('/visualisasi') }}/{{ $val->slug }}"> {{ $val->name }}
                                    </a>
                                </h4>
                                <div _ngcontent-opendata-frontend-c103="" class="information"><div _ngcontent-opendata-frontend-c103="" class="mb-2"><a _ngcontent-opendata-frontend-c103="" class="organization d-flex align-items-center" href="/id/organisasi/dinas-tenaga-kerja-dan-transmigrasi?data=visualization"><i _ngcontent-opendata-frontend-c103="" class="fas fa-building icon-organization"></i><div _ngcontent-opendata-frontend-c103="" class="limit-1-row"> Dinas Tenaga Kerja Dan Transmigrasi </div></a></div><div _ngcontent-opendata-frontend-c103="" class="mb-2"><a _ngcontent-opendata-frontend-c103="" class="topic d-flex align-items-center" href="/id/hasil-pencarian?topic=9&amp;by=visualization"><i _ngcontent-opendata-frontend-c103="" class="fas fa-book icon-topic"></i><div _ngcontent-opendata-frontend-c103="" class="limit-1-row"> Kependudukan </div></a></div><div _ngcontent-opendata-frontend-c103="" class="d-flex align-items-center"><i _ngcontent-opendata-frontend-c103="" class="fas fa-eye icon-counter"></i><!----> 46 <!----><!----></div></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center mt-3">
                    <img src="{{ url('/images/frontend/data-not-found.svg') }}" class="rounded" alt="Data not found">
                </div>
                @endif
                <!--                <div class="text-center">
                                    <div class="pagination pagination-centered"><ul> <li class="active"><a href="/dataset?page=1">1</a></li> <li><a href="/dataset?page=2">2</a></li> <li><a href="/dataset?page=3">3</a></li> <li class="disabled"><a href="#">...</a></li> <li><a href="/dataset?page=95">95</a></li> <li><a href="/dataset?page=2">»</a></li></ul></div>
                                </div>-->
            </section>
        </div>
    </div>
</main>
@stop
@section('css')
<style>
    h1.heading {
        color: #fff;
        font-size: 1.15em;
        font-weight: 900;
        margin: 0 0 0.5em;
        color: #505050;
    }
    .card {
        display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
        width: 100%;
        height:170px;
        border-top-left-radius:2px;
        border-top-right-radius:2px;
        display:block;
        overflow: hidden;
    }
    .img-card img{
        width: 50%;
        height:170px;
        object-fit: contain;
        transition: all .25s ease;
        padding: 5px;
    } 
    .card-content {
        padding:15px;
        text-align:left;
    }
    .card-title {
        margin-top:0px;
        font-weight: 300;
        font-size: 1.0em;
    }
    .card-title a {
        color: #000;
        text-decoration: none !important;
    }
    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
        text-decoration: none !important;
        padding:10px;
        font-weight:600;
        text-transform: uppercase
    }
    .card-desc{
        margin-top:0px;
        font-weight: 100;
        color: #113355;
        font-size: 0.8em;
    }
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }

    .information{
        font-size: 0.8em;
    }

    .align-items-center {
        align-items: center!important;
    }

    .d-flex {
        display: flex!important;
    }

    a, a:hover {
        color: #616161;
        text-decoration: none;
    }

    a {
        color: #16a75c;
        background-color: initial;
    }

    .limit-1-row, .limit-2-row {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }

    .limit-1-row {
        -webkit-line-clamp: 1;
    }

    .icon-organization,.icon-topic,.icon-counter{
        margin-right: 12px !important;
    }

    .bg-biru-muda {
        background-color: #113355 !important;
    }
</style>
<link rel="stylesheet" href="{{ asset('css/frontend/search.min.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@stop

@section('js')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@stop