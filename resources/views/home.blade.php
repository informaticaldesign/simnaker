@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@if(!$users->biodata_id)
<div clas="row">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info-circle"></i> Pemberitahuan!</h5>
        Mohon lengkapi data diri terlebih dahulu. <a href="{{ url('profile') }}"><b>Klik disini</b></a>
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $transw }}</h3>

                <p>Data Perusahaan</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat Detail</a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $transp }}</h3>

                <p>Data Renja</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat Detail</a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $bbnw }}</h3>

                <p>Nota Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat Detail</a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $bbnp }}</h3>

                <p>LHP Pengawas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat Detail</a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-chart-line"></i> Jumlah Data Perusahaan</h3>
                    <a href="{{ url('transaksi') }}">Lihat Detail</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">{{ $transt }}</span>
                        <span>Total Perusahaan Terdaftar</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="visitors-chart" height="400" width="1064" class="chartjs-render-monitor" style="display: block; height: 200px; width: 532px;"></canvas>
                </div>

                <!-- <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Roda Dua
                    </span>

                    <span>
                        <i class="fas fa-square text-danger"></i> Roda Empat
                    </span>

                    <span>
                        <i class="fas fa-square text-warning"></i> Roda Tiga
                    </span>
                </div> -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-chart-bar"></i>Data Presebtasi Renja</h3>
                    <a href="{{ url('bbn') }}">Lihat Detail</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">{{ $bbnt }}</span>
                        <span>Total Presebtasi Renja</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="sales-chart" height="400" style="display: block; height: 200px; width: 532px;" width="1064" class="chartjs-render-monitor"></canvas>
                </div>

                <!-- <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Roda Dua
                    </span>

                    <span>
                        <i class="fas fa-square text-danger"></i> Roda Empat
                    </span>

                    <span>
                        <i class="fas fa-square text-warning"></i> Roda Tiga
                    </span>
                </div> -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title title-chart-pie"><i class="fas fa-chart-pie"></i>Nota Pemeriksaan</h3>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="visitors-pie" height="400" width="1064" class="chartjs-render-monitor" style="display: block; height: 200px; width: 532px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title title-chart-pie"><i class="fas fa-chart-pie"></i> LHP Pengawas</h3>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="bbns-pie" height="400" width="1064" class="chartjs-render-monitor" style="display: block; height: 200px; width: 532px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
<script>
    var urlDtrans = "{{ url('home/dtrans') }}";
    var urlDbbn = "{{ url('home/dbbn') }}";
</script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}?{{ date('YmdHis') }}"></script>
@stop