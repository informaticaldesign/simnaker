<link href="{{ asset('vendor/chart.js/Chart.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    var ctx = $('#myChart');
    $.ajax({
        url: 'https://dev.cybermedia.co.id/api/dindik/{{ $slug }}',
        success: function (json) {
            var jsondata = json.data;

            var _objYear = {};
            $(jsondata).each(function (i) {
                _objYear[jsondata[i].tahun] = jsondata[i].tahun;
            });

            var _label = [];
            var _labels = [];
            var _idx = 0;
            var objColour = ['#c64e26', '#ff7733', '#415961', '#65818a', '#b3d0d8', '#dae3e7'];
            var _datasets = [];
            jQuery.each(_objYear, function (i, v) {
                var _data = [];
                _label.push(i);
                _labels = [];
                $(jsondata).each(function (y) {
                    if (i == jsondata[y].tahun) {
                        _labels.push(jsondata[y].nama_kabupaten_kota);
                        _data.push(jsondata[y].jumlah);
                    }
                });

                _datasets[_idx] = {
                    label: i,
                    data: _data,
                    backgroundColor: objColour[_idx],
                    borderColor: objColour[_idx],
                    fill: false,
                }
                _idx++;

            });
            const initProgress = $('.progress-bar');
            const progress = $('.progress-bar');
            const config = {
                type: 'bar',
                data: {
                    labels: _labels,
                    datasets: _datasets,
                },
                options: {
                    responsive: true,
                        maintainAspectRatio: false,
                    legend: {
                       display: false
                    }
               }
              };
//            var config = {
//                type: 'bar',
//                data: {
//                    labels: _labels,
//                    datasets: _datasets,
//                },
//                options: {
//                    responsive: true,
//                    plugins: {
//                        legend: {
//                            display: false,
//                        }
//                    },
//                    animation: {
//                        duration: 2000,
//                        onProgress: function (context) {
//                            if (context.initial) {
//                                initProgress.value = context.currentStep / context.numSteps;
//                            } else {
//                                progress.value = context.currentStep / context.numSteps;
//                            }
//                        },
//                        onComplete: function (context) {
//                            if (context.initial) {
//                                console.log('Initial animation finished');
//                            } else {
//                                console.log('animation finished');
//                            }
//                        }
//                    },
//                }
//            };
            var myChart = new Chart(ctx, config)
        },
        dataType: "json"
    });

});
</script>