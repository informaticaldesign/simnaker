@extends('frontend.page')
@section('title', $infografik->title )
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .carousel{
        position: relative;
    }
    .carousel-indicators{
        position: absolute;
        top:540px;
        left:300px;
        height:105px;
        width: 100%; 
    }
    .carousel-indicators li{
        text-indent:0;
        display:inherit;
        float:left;
        width: 10%;
        height: 100px;
        margin:5px 0px;
    }
    .carousel-indicators li img{
        width: 95%;
        height: 50px;
        border:2px solid #CCCCCC;
        padding: 2px;
    }
    .carousel-indicators .active img{
        border:2px solid #04BEF5;
    }
    .carousel-indicators .active{
        margin:5px 0px;
        width: 10%;
        height: 100px;
    }
    .carousel-control.right,
    .carousel-control.left{
        background-image: none;
    }
    @media screen and (min-width:320px) and (max-width:360px) {
        .carousel-indicators{
            top:115px;
            left:95px;
        }
        .carousel-indicators li img{
            width:95%;
            height:50px;
        }
        .carousel-indicators li{
            width:20%;
            height:50px;
        }
        .carousel-indicators .active{
            width:20%;
            height:50px;
        }
    }
    @media screen and (min-width:768px) and (max-width:980px){
        .carousel-indicators{
            top:240px;
            left:213px;
        }
    }
    .border-lg-right {
        border-right: 1px solid #dee2e6!important;
    }
</style>
<main class="site-main">
    <div class="header-div">
        <div class="container">
            <div class="package-title-section">
                <h2 class="package-title">{{ $infografik->title }}</h2>
                <div class="package-title-buttons">
                    <a class="btn datagovsg-btn btn-right btn-orange ga-dataset-download" data-ga="d1bc2e69-ca8a-4114-b3f3-421c2c52bb1b" role="button" href="/dataset/d1bc2e69-ca8a-4114-b3f3-421c2c52bb1b/download">
                        <img class="button-icon" src="{{ asset('images/frontend/icons/Download.svg')}}">
                        Download
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="dataset-resource-views">
                <div class="resource-views-header" style="padding: 10px 0px !important; background: #FFFFFF;">
                    <div class="resource-selector-header">
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fas fa-calendar"></i> {{ $infografik->created_at->format('d M Y') }}
                                <i class="fas fa-eye" style="margin-left: 12px"></i> {{ $infografik->counter }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-6 mt-3 mb-4" style="padding: 10px 0px !important;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                        $imgNo = 0
                        @endphp
                        @foreach($details as $detail)
                        <div class="item {{ $imgNo == 0 ? 'active' : ''  }}" style="width: 540px;">
                            <img src="{{ url('/uploads/infografiks/details') }}/{{ $detail->fullpath }}" width="100%">
                        </div>
                        @php
                        $imgNo++
                        @endphp
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <ul class="carousel-indicators">
                        @php
                        $imgNo = 0
                        @endphp
                        @foreach($details as $detail)
                        <li data-target="#myCarousel" data-slide-to="0" class="{{ $imgNo == 0 ? 'active' : ''  }}"><img src="{{ url('/uploads/infografiks/details') }}/{{ $detail->fullpath }}"></li>
                        @php
                        $imgNo++
                        @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mt-3 mb-4" style="padding: 10px 0px !important;">
                {!! $infografik->description !!}
                <div class="information">
                    <div class="card" style="padding: 10px;">
                        <div class="card-body">
                            <div class="row"><div class="col-lg-6 mb-sm-0 mb-md-3 mb-lg-0 mb-3 border-lg-right px-4">
                                    <div class="mb-2"> Topik </div>
                                    <div class="d-flex text-charcoal">
                                        <a class="text topic" href="#">
                                            <i class="fas fa-book mr-2 mt-1"></i> {{ $infografik->topic_name }} </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-sm-0 mb-md-3 mb-lg-0 mb-3 px-4">
                                    <div class="mb-2"> Divisualisasikan oleh </div>
                                    <div class="d-flex text-charcoal">
                                        <i class="fas fa-chart-area mr-2 mt-1"></i>
                                        <div class="text"> {{ $infografik->organizations_name }} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@stop
@section('css')
@stop

@section('js')
@stop