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
                    <span class="info-box-icon bg-info"><i class="far fa-calendar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Renja ({{ date('Y') }})</span>
                        <span class="info-box-number">{{ $rjall }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-check-double"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Renja Disetujui ({{ date('Y') }})</span>
                        <span class="info-box-number">{{ $rjapprove }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-hourglass-half"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Renja Proses ({{ date('Y') }})</span>
                        <span class="info-box-number">{{ $rjwaiting }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-times-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Renja Ditolak ({{ date('Y') }})</span>
                        <span class="info-box-number">{{ $rjreject }}</span>
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
                            <h3 class="card-title"><i class="fas fa-chart-bar"></i>&nbsp;Chart Rencana Kerja ({{ date('Y') }})</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{ $rjwaiting }}</span>
                                <span>Chart Rencana Kerja ({{ date('Y') }})</span>
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
                                <i class="fas fa-square text-success"></i> Disetujui
                            </span>

                            <span class="mr-2">
                                <i class="fas fa-square text-warning"></i> Proses
                            </span>

                            <span class="mr-2">
                                <i class="fas fa-square text-danger"></i> Ditolak
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
                            <h3 class="card-title title-chart-pie"><i class="fas fa-chart-pie"></i>&nbsp;Status Rencana Kerja</h3>
                        </div>
                        <div class="card-body mb-2" style="padding:5px !important;">
                            <canvas id="visitors-pie" width="500" height="500" class="chartjs-render-monitor"></canvas>
                        </div>
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
    var urlDtrans = "{{ url('/admin/renja/chartbar') }}";
    var urlDbbn = "{{ url('/admin/renja/chartpie') }}";
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
            type: 'bar',
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

        var $bbns = $('#visitors-pie');
        var dataPie = {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor: [
                        '#ffc107',
                        '#28a745',
                        '#dc3545',
                        
                        
                    ],
                    hoverOffset: 4
                }
            ]
        };
        var pieChartBbns = new Chart($bbns, {
            type: 'pie',
            data: dataPie,
            options: {
                "hover": {
                    "animationDuration": 0
                },
                legend: {
                    "display": true,
                    position: 'bottom',
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function () {
                        var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                console.log(index);
                                if (index == 0) {
                                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                }
                            });
                        });
                    }
                },
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

        $.ajax({
            url: urlDbbn,
            method: 'POST',
            dataType: 'JSON',
            success: function (result) {
                if (result.success) {
                    pieChartBbns.data.labels = result.data.labels;
                    pieChartBbns.data.datasets[0].data = result.data.status;
                    pieChartBbns.update();
                }
            }
        });
    });
</script>
@stop