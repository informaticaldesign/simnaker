@extends('frontend.page')
@section('title', 'Open Data - '.$topic->name )
@section('content')
<div class="container search-header">
    <div class="whitespace"></div>
    <section class="content">
        <span class="search-headline">{{ $topic->name }}</span>
        <!--        <a class="search-download-list ga-download-dataset-list" href="/dataset/dataset-listing">
                    <img class="button-icon" src="{{ asset('images/frontend/icons/Download.svg') }}">
                    Dataset List
                </a>-->
        <form class="search-box " action="/search" method="get">
            <input class="search-box-text ga-search-bar " type="text" name="q" value="" autocomplete="off" placeholder="Cari dataset">
            <button type="submit">
                <img src="{{ asset('images/frontend/icons/Search.svg') }}">
            </button>
        </form>
    </section>
</div>
<main class="site-main">
    <div class="container search-main">
        <div class="search-container-left">
            <section class="search-filters">
                <div class="search-filter">
                    <h2 class="section-title filter-title">Topik</h2>
                    <div class="search-topics-list">
                        @foreach ($topics as $val)
                        <a class="ga-topic-filters" data-ga="{{ $val->name }}" href="{{ url('/group') }}/{{ $val->slug }}">
                            <div class="search-topic {{ $topic->id == $val->id ? 'selected' :'' }}">
                                <img class="select-on hover-on" src="{{ asset('images/frontend/group_icons/selected'). '/' . $val->icon }}" height="30px">
                                <img class="select-off hover-off" src="{{ asset('images/frontend/group_icons/inactive'). '/' .  $val->icon }}" height="30px">
                                {{ $val->name }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="search-filter">
                    <h2 class="section-title filter-title">Format File</h2>
                    <select class="search-filter-select ga-file-format-filter">
                        <option value="/search">
                            Pilih Format File
                        </option>
                        <option value="/search?res_format=CSV">
                            CSV
                        </option>
                        <option value="/search?res_format=PDF">
                            PDF
                        </option>
                        <option value="/search?res_format=KML">
                            KML
                        </option>
                        <option value="/search?res_format=SHP">
                            SHP
                        </option>
                        <option value="/search?res_format=API">
                            API
                        </option>
                    </select>
                </div>
                <div class="search-filter filter-sort">
                    <h2 class="section-title filter-title">Sort by </h2>
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
            </section>
        </div>
        <div class="search-container-right">
            <section class="search-results">
                <div class="search-results-header">
                    <h2 class="section-title">
                        @if( $total > 0 )
                        {{ $total }}  Dataset ditemukan di {{ $topic->name }}
                        @else
                        Tidak ada dataset ditemukan di {{ $topic->name }}
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
                @if( $datasets->count() > 0 )
                <div class="row">
                    @foreach ($datasets as $dataset)
                    <div class="col-12">
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
                @else
                <div class="row">
                    <div class="search-no-results">Tidak dapat menemukan yang Anda cari? Kirimkan permintaan set data <a class="site-link ga-nav-request" href="#"><u>di sini</u></a>.</div>
                </div>
                <div class="text-center" style="padding-top: 50px !important;">
                    <img src="{{ url('/images/frontend/data-not-found.svg') }}" class="rounded" alt="Data not found" width="55%">
                </div>
                @endif
                @if($totalpage > 1)
                <div class="text-center">
                    <div class="pagination pagination-centered">
                        <ul> 
                            @if($page > 1)
                            <li><a href="{{ url('/group') }}/{{ $slug }}?page={{ $page-1 }}">«</a></li>
                            @endif

                            @if($page < 5)
                            @for($x=1;$x<= ($page+2);$x++)
                            <li class="{{ $page==$x?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page={{ $x }}">{{ $x }}</a></li> 
                            @endfor
                            <li class="disabled"><a href="#">...</a></li>
                            <li class="{{ $page==$totalpage?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page={{ $totalpage }}">{{ $totalpage }}</a></li>
                            @endif

                            @if($page >= 5)
                            <li class="{{ $page==1?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page=1">1</a></li> 
                            <li class="disabled"><a href="#">...</a></li>
                            @if(($totalpage == $page) || (($totalpage-3) == $page) || (($totalpage-2) == $page) || (($totalpage-1) == $page ))
                            @for($x=($page-2);$x<= ($totalpage);$x++)
                            <li class="{{ $page==$x?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page={{ $x }}">{{ $x }}</a></li> 
                            @endfor
                            @else
                            @for($x=($page-2);$x<= ($page+2);$x++)
                            <li class="{{ $page==$x?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page={{ $x }}">{{ $x }}</a></li> 
                            @endfor
                            <li class="disabled"><a href="#">...</a></li>
                            <li class="{{ $page==$totalpage?'active':''}}"><a href="{{ url('/group') }}/{{ $slug }}?page={{ $totalpage }}">{{ $totalpage }}</a></li>
                            @endif
                            @endif
                            @if($page < $totalpage)
                            <li><a href="{{ url('/group') }}/{{ $slug }}?page={{ $page+1 }}">»</a></li>
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
<link rel="stylesheet" href="{{ asset('css/frontend/search.min.css') }}">
@stop

@section('js')
@stop