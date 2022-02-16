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
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a;">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ $profile->avatar_path }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $profile->name }}</h3>
                <hr>
                <strong><i class="fas fa-calendar mr-1"></i> Nomor Induk Pegawai</strong>
                <p class="text-muted">{{ $profile->nip }}</p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted">{{ $profile->address }}</p>
                <hr>
                <strong><i class="fas fa-phone mr-1"></i> Telpon</strong>
                <p class="text-muted">
                    {{ $profile->phone }}
                </p>
                <hr>
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted">
                    {{ $profile->email }}
                </p>
                <a href="{{ url('profile') }}" class="btn btn-primary btn-block" style="background-color:#1e375b; border-color: #1e375b;"><b>Edit Profile</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">{{ $user }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perusahaan</span>
                        <span class="info-box-number">{{ $company }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pengunjung</span>
                        <span class="info-box-number">{{ $visitor }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kotak Masuk</span>
                        <span class="info-box-number">{{ $inbox }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card" style="height: 425px">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><i class="fas fa-chart-bar"></i>&nbsp;Chart Pengunjung {{ date('Y') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{ $visitor }}</span>
                                <span>Chart Pengunjung {{ date('Y') }}</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-muted">Sejak Bulan Lalu</span>
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

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-success"></i> {{ date('Y') }}
                            </span>

                            <span class="mr-2">
                                <i class="fas fa-square text-warning"></i> {{ date('Y')-1 }}
                            </span>

                            <span class="mr-2">
                                <i class="fas fa-square text-danger"></i> {{ date('Y')-2 }}
                            </span>
                        </div> 
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-4">
                <div class="card" style="height: 425px">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title title-chart-pie"><i class="fas fa-chart-pie"></i>&nbsp;Browser Digunakan</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="218" width="438" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    <li><i class="far fa-circle text-danger"></i> Chrome</li>
                                    <li><i class="far fa-circle text-success"></i> IE</li>
                                    <li><i class="far fa-circle text-warning"></i> FireFox</li>
                                    <li><i class="far fa-circle text-info"></i> Safari</li>
                                    <li><i class="far fa-circle text-primary"></i> Opera</li>
                                </ul>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="card-footer bg-light p-0">
                        <ul class="nav nav-pills flex-column">     
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Chrome
                                    <span class="float-right text-success">
                                        <i class="fas fa-arrow-up text-sm"></i> 4%
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    IE
                                    <span class="float-right text-danger">
                                        <i class="fas fa-arrow-down text-sm"></i>
                                        12%</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Firefox
                                    <span class="float-right text-warning">
                                        <i class="fas fa-arrow-left text-sm"></i> 0%
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Safari
                                    <span class="float-right text-warning">
                                        <i class="fas fa-arrow-left text-sm"></i> 0%
                                    </span>
                                </a>
                            </li><!-- x -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Opera
                                    <span class="float-right text-warning">
                                        <i class="fas fa-arrow-left text-sm"></i> 0%
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<style>
    .card-primary.card-outline {
        border-top: 3px solid #1e375a !important;
    }
</style>
@stop

@section('js')
<script>
    var urlDtrans = "{{ url('/admin/visitor/chartline') }}";
</script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var mode = 'index'
        var intersect = true
        const DISPLAY = true;
        const BORDER = true;
        const CHART_AREA = true;
        const TICKS = true;

        var $salesChart = $('#sales-chart')
        var salesChart = new Chart($salesChart, {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    x: {
                        grid: {
                            display: DISPLAY,
                            drawBorder: BORDER,
                            drawOnChartArea: CHART_AREA,
                            drawTicks: TICKS,
                        }
                    },
                    y: {
                        grid: {
                            drawBorder: false,
                            color: function (context) {
                                if (context.tick.value > 0) {
                                    return Utils.CHART_COLORS.green;
                                } else if (context.tick.value < 0) {
                                    return Utils.CHART_COLORS.red;
                                }

                                return '#000000';
                            },
                        },
                    }
                }
            }
        });

        $.ajax({
            url: urlDtrans,
            dataType: 'JSON',
            method: 'POST',
            success: function (result) {
                if (result.success) {
                    salesChart.data.labels = result.data.labels;
                    salesChart.data.datasets = result.data.datasets2;
                    salesChart.update();
                }
            }
        });

        //-------------
        // - PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator'
            ],
            datasets: [
                {
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

        //-----------------
        // - END PIE CHART -
        //-----------------
    });
</script>
@stop