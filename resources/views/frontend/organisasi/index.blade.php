@extends('frontend.page')
@section('title', 'Open Data - Organisasi')
@section('content')
<div class="container search-header">
    <section class="content">
        <h1 class="section-title">
            Organisasi
        </h1>
        <form class="search-box " action="{{ url('/organisasi') }}" method="get">
            <input class="search-box-text ga-search-bar " type="text" name="q" value="" autocomplete="off" placeholder="Cari Organisasi">
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
                        {{ $total }} Organisasi ditemukan
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
                @if( $organizations->count() > 0 )
                <div class="row">
                    @foreach($organizations as $val)
                    <div class="col-md-3 mt-3">
                        <div class="card" style="padding: 0px !important; height: 270px">
                            <a class="img-card text-center" href="{{ url('/organisasi') }}/{{ $val->slug }}">
                                <img src="{{ asset('uploads/organisasi') }}/{{ $val->icon }}" />
                            </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="{{ url('/organisasi') }}/{{ $val->slug }}"> {{ $val->name }}
                                    </a>
                                </h4>
                                <p class="card-desc">
                                    {{ $val->count_dataset }} Dataset
                                </p>
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
                @if($totalpage > 1)
                <div class="text-center">
                    <div class="pagination pagination-centered">
                        <ul> 
                            @if($page > 1)
                            <li><a href="{{ url('/organisasi') }}?page={{ $page-1 }}">«</a></li>
                            @endif
                            @for($x=1;$x<=$totalpage;$x++)
                            <li class="{{ $page==$x?'active':''}}"><a href="{{ url('/organisasi') }}?page={{ $x }}">{{ $x }}</a></li> 
                            @endfor
                            @if($page < $totalpage)
                            <li><a href="{{ url('/organisasi') }}?page={{ $page+1 }}">»</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endif
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
</style>
<link rel="stylesheet" href="{{ asset('css/frontend/search.min.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@stop

@section('js')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@stop