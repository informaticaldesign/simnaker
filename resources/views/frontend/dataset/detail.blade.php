@extends('frontend.page')
@section('title', $dataset->title)
@section('content')
<main class="site-main">
    <div class="header-div">
        <div class="container">
            <div class="package-title-section">
                <h2 class="package-title">{{ $dataset->title }}</h2>
                <!--                <div class="package-title-buttons">
                                    <a class="btn datagovsg-btn btn-right btn-orange ga-dataset-download" data-ga="d1bc2e69-ca8a-4114-b3f3-421c2c52bb1b" role="button" href="#">
                                        <img class="button-icon" src="{{ asset('images/frontend/icons/Download.svg')}}">
                                        Download
                                    </a>
                                </div>-->
            </div>
        </div>
    </div>
    <section>
        @if($view == 'table')
        @include('frontend.dataset.partials.table')
        @elseif($view == 'chart')
        @include('frontend.dataset.partials.chart')
        @elseif($view == 'maps')
        @include('frontend.dataset.partials.maps')
        @endif
        <div class="container" style="margin-top: 20px !important;">
            <h2 class="section-title">Deskripsi Dataset</h2>
            <article class="card">
                <div class="dataset-description">
                    <p>{!! $dataset->description !!}</p>
                </div>
            </article>
        </div>
        <div class="container" style="margin-top: 20px !important;">
            <h2 class="section-title">Metadata</h2>
            <article class="card">
                <div class="dataset-metadata">
                    <article class="metadata-card">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Dikelola Oleh</th>
                                    <td><a href="/organisasi/{{ $dataset->organizations_slug }}">{{ $dataset->organizations_name }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Terakhir Diperbarui</th>
                                    <td>30 April 2020, 00:55 WIB</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dibuat</th>
                                    <td>14 Januari 2021, 11:59 WIB</td>
                                </tr>
                                <tr>
                                    <th scope="row">Cakupan</th>
                                    <td>1 Januari 2017 s/d 31 Desember 2020</td>
                                </tr>
                                <tr>
                                    <th scope="row">Frekuansi</th>
                                    <td>1 Tahun Sekali</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sumber</th>
                                    <td>{{ $dataset->organizations_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sumber URL</th>
                                    <td><a href="#" target="_blank"> - </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Lisensi</th>
                                    <td><a href="/open-data-licence">Banten Prov Open Data Lisensi</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </article>
                </div>
            </article>
        </div>
        @if( $datasets->count() > 0 )
        <div class="container" style="margin-top: 20px !important;">
            <h2 class="section-title">Rekomendasi Dataset</h2>
            <article class="card similar-datasets-card">
                <div class="row-flex">
                    @foreach ($datasets as $dataset)
                    <div class="package-card">
                        <!-- <div class="col-sm-6 col-md-4"> -->
                        <article class="card package-card">
                            <div class="package-card-details">
                                <h3 class="package-card-title">
                                    <a class="ga-dataset-card-title" data-ga="{{ $dataset->slug }}" href="/dataset/{{ $dataset->slug }}">
                                        {{ $dataset->title }}
                                    </a>
                                </h3>
                                <small class="package-card-meta text-muted">
                                    <a class="package-card-organization ga-dataset-card-org" data-ga="{{ $dataset->organizations_slug }}" href="/organisasi/{{ $dataset->organizations_slug }}">
                                        {{ $dataset->organizations_name }}
                                    </a>

                                    /
                                    {{ $dataset->created_at->format('d M Y') }}
                                </small>
                                <p class="package-card-description ga-search-dataset-card-description">{!! \Illuminate\Support\Str::limit(strip_tags($dataset->description), 250, $end='...') !!}</p>
                            </div>

                            <div class="resource-formats">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/CSV.svg/') }}">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/SHP.svg/') }}">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/PDF.svg/') }}">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/API.svg/') }}">
                                <img class="format-icon ga-search-dataset-card-file-icon" src="{{ asset('images/frontend/icons/file_type/KML.svg/') }}">
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