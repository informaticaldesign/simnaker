@extends('frontend.page')
@section('title_prefix', 'Regulasi K3 - ')
@section('title', 'Simnaker')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="services" class="services">
    <div class="container">

        <div class="section-title">
            <h2>Regulasi K3</h2>
            <h3>PENCARIAN PERATURAN PERUNDANG-UNDANGAN</h3>
            <p>Keselamatan dan Kesehatan Kerja</p>
        </div>

        <div class="row">
            <div class="col-sm-8">
                @if( $data->count() > 0 )
                @foreach ($data as $regulasi)
                <div class="row m-1" style="--bs-gutter-x: 0rem !important;">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:#1e375b;"><i class="fa fa-eye"></i> di lihat {{ $regulasi->view }} kali</div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="/regulasi/{{ $regulasi->slug }}">{{ $regulasi->judul }}</a></h5>
                            <p class="card-text">{{ $regulasi->type }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row m-1" style="--bs-gutter-x: 0rem !important;">
                    <nav aria-label="page">
                        <ul class="pagination">
                            <li class="page-item {{ $page==1?'disabled':''}}">
                                @if($page==1)
                                <span class="page-link">Previous</span>
                                @else
                                <a class="page-link" href="{{ url('/regulasi') }}?page={{ $page-1 }}">Previous</a>
                                @endif
                            </li>
                            @for($x=1;$x<= ($totalpage);$x++)
                            <li class="page-item {{ $page==$x?'active':''}}">
                                @if($page==$x)
                                <span class="page-link">{{ $x }}<span class="sr-only">(current)</span></span>
                                @else
                                <a class="page-link" href="{{ url('/regulasi') }}?page={{ $x }}">{{ $x }}</a>
                                @endif
                            </li>
                            @endfor
                            <li class="page-item {{ $page==$totalpage?'disabled':''}}">
                                <a class="page-link" href="{{ url('/regulasi') }}?page={{ $totalpage }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                @else
                <div class="text-center" style="padding-top: 50px !important;">
                    <img src="{{ url('/images/frontend/data-not-found.svg') }}" class="rounded" alt="Data not found" width="55%">
                </div>
                @endif
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header text-white text-center" style="background-color:#1e375b;"><i class="fa fa-search"></i>&nbsp;Pencarian Regulasi</div>
                    <div class="card-body">
                        <form method="get" action="{{ url('regulasi') }}">
                            <div class="mb-3">
                                <label for="keyword" class="form-label">Kata kunci</label>
                                <input type="text" class="form-control" id="keyword" placeholder="masukan kata kunci" name="keyword">
                            </div>
                            <div class="mb-3">
                                <label for="nomor" class="form-label">Nomor Peraturan</label>
                                <input type="text" class="form-control" id="nomor" placeholder="nomor peraturan" name="nomor">
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Peraturan</label>
                                <select class="form-select" aria-label="Default select example" name="tahun">
                                    <option selected>Semua Tahun</option>
                                    @foreach($tahun as $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Bentuk Peraturan</label>
                                <select class="form-select" aria-label="Default select example" name="jenis">
                                    <option selected>Semua Bentuk</option>
                                    @foreach($bentuk as $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button class="btn btn-primary" type="submit" style="background-color:#1e375b; border-color: #1e375b;"><i class="fa fa-search"></i>&nbsp;Cari</button>
                                <a class="btn btn-primary" style="background-color:#1e375b; border-color: #1e375b;" href="{{ url('regulasi') }}"><i class="fa fa-brush"></i>&nbsp;Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
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