@extends('frontend.page')
@section('title', $visualisasi->title )
@section('content')
<main class="site-main">
    <div class="header-div">
        <div class="container">
            <div class="package-title-section">
                <h2 class="package-title">{{ $visualisasi->title }}</h2>
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
                <div class="resource-views-header" style="padding: 10px 0px !important;">
                    <div class="resource-selector-header">
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fas fa-calendar"></i> {{ $visualisasi->created_at->format('d M Y') }}
                                <i class="fas fa-eye" style="margin-left: 12px"></i> {{ $visualisasi->counter }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="resource-views-body">
                    <div class="resource-detail-container" style="padding: 10px 0px !important;">
                        <div class="resource-detail container-fluid" style="padding: 0px 0px !important;">
                            <div class="resource-controls">
                                <span>Tampilan: </span>
                                <a class="view-tab ga-dataset-resource-view-selector active chart" data-ga="Wholesale" and="" retail="" trade="" href="/dataset/business-expectations-for-the-services-sector?view_id=811c7966-63b7-4208-8ab1-46639215ffd5&amp;resource_id=4779dc47-673a-42a3-896f-7bfc90315c09">
                                    <div></div>
                                    <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/active/chart.svg')}}">
                                    <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/chart.svg')}}">
                                    <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/chart.svg')}}">
                                </a>
                                <a class="view-tab ga-dataset-resource-view-selector  table" data-ga="Table" href="/dataset/business-expectations-for-the-services-sector?view_id=b412d801-9097-4e62-acae-899b9db28ca8&amp;resource_id=4779dc47-673a-42a3-896f-7bfc90315c09">
                                    <div></div>
                                    <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/active/table.svg')}}">
                                    <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/table.svg')}}">
                                    <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/table.svg')}}">
                                </a>
                                <a class="view-tab ga-dataset-resource-view-selector  table" data-ga="Table" href="/dataset/business-expectations-for-the-services-sector?view_id=b412d801-9097-4e62-acae-899b9db28ca8&amp;resource_id=4779dc47-673a-42a3-896f-7bfc90315c09">
                                    <div></div>
                                    <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/active/map.svg')}}">
                                    <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/map.svg')}}">
                                    <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/map.svg')}}">
                                </a>
                            </div>
                            <div id="view-811c7966-63b7-4208-8ab1-46639215ffd5" class="resource-view chart-view">
                                <iframe frameborder="0" src="https://data.gov.sg/dataset/business-expectations-for-the-services-sector/resource/4779dc47-673a-42a3-896f-7bfc90315c09/view/811c7966-63b7-4208-8ab1-46639215ffd5"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 20px !important;">
            <article class="card">
                <div class="dataset-description">
                    <p>{{ $visualisasi->description }}</p>
                </div>
            </article>
        </div>
        @if( $visualisasis->count() > 0 )
        <div class="container" style="margin-top: 20px !important;">
            <h2 class="section-title">Visualisasi Terkait</h2>
            <article class="card similar-datasets-card">
                <div class="row-flex">
                    @foreach ($visualisasis as $visualisasi)
                    <div class="package-card">
                        <!-- <div class="col-sm-6 col-md-4"> -->
                        <article class="card package-card">
                            <div class="package-card-details">
                                <h3 class="package-card-title">
                                    <a class="ga-dataset-card-title" data-ga="{{ $visualisasi->slug }}" href="/dataset/{{ $visualisasi->slug }}">
                                        {{ $visualisasi->title }}
                                    </a>
                                </h3>
                                <small class="package-card-meta text-muted">
                                    <a class="package-card-organization ga-dataset-card-org" data-ga="{{ $visualisasi->organizations_slug }}" href="/organisasi/{{ $visualisasi->organizations_slug }}">
                                        {{ $visualisasi->organizations_name }}
                                    </a>

                                    /
                                    {{ $visualisasi->created_at->format('d M Y') }}
                                </small>


                                <p class="package-card-description ga-search-dataset-card-description">{{ $visualisasi->description }}</p>
                            </div>

                            <div class="resource-formats">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/CSV.svg/')}}">
                            </div>

                        </article>
                    </div>
                    @endforeach
                </div>
            </article>
        </div>
        @endif
    </section>
</main>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('css/frontend/search.min.css') }}">
@stop

@section('js')
@stop