@extends('frontend.master')
@stack('css')
@yield('css')
@section('body')
@include('frontend.partials.topbar')
{{-- @include('frontend.partials.header') --}}
@yield('content')
@include('frontend.partials.footer')
@stack('js')
@yield('js')
@stop