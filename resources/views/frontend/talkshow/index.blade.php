@extends('frontend.page')
@section('title_prefix', 'Talkshow - ')
@section('title', 'Simnaker')
@section('content')

<?php

use Carbon\Carbon; ?>
<!-- ======= Hero Section ======= -->
<section id="services" class="services" style="padding: 20px 0 !important;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Talkshow</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-8">
                <div class="embed-responsive embed-responsive-16by1 mb-2">
                    <iframe class="embed-responsive-item" width="100%" height="500" src="{{ $thumbnail->url }}" frameborder="0" style="height:500px;width:100%;top:0px;left:0px;right:0px;" frameborder="0" title="{{ $thumbnail->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <h5>{{ $thumbnail->title }}</h5>
                <p class="text-gray">{{ $thumbnail->publisher }}&nbsp;&bull;&nbsp;{{ Carbon::parse($thumbnail->created_at)->format('d M Y')}}</p>
            </div>
            <div class="col-sm-4">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Telusuri" aria-label="Telusuri" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <h5 class="text-left">Related Videos</h5>
                <hr>
                @foreach($data as $key)
                <div class="row">
                    <div class="col-sm-4">
                        <div class="embed-responsive embed-responsive-16by1">
                            <iframe class="embed-responsive-item rounded" width="100%" height="90" src="{{ $key->url}}" frameborder="0" title="{{ $key->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row"><a href="{{ url('talkshow') }}/{{ $key->slug }}"><h6>{{ $key->title }}</h6></a></div>
                        <div class="row">
                            <p class="text-gray">{{ $key->publisher }}&nbsp;&bull;&nbsp;{{ Carbon::parse($key->created_at)->format('d M Y')}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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
</style>
@stop
@section('js')
<script>

</script>
@stop