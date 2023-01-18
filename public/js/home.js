/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
  //'use strict'
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  };
  var mode = 'index';
  var intersect = true;
  var $salesChart = $('#sales-chart'); // eslint-disable-next-line no-unused-vars

  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [] //            datasets: [
      //                {
      //                    backgroundColor: '#007bff',
      //                    borderColor: '#007bff',
      //                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
      //                },
      //                {
      //                    backgroundColor: '#ced4da',
      //                    borderColor: '#ced4da',
      //                    data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
      //                }
      //            ]

    },
    options: {
      maintainAspectRatio: false,
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
        yAxes: [{
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  });
  var $visitorsChart = $('#visitors-chart');
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: [],
      datasets: []
    },
    options: {
      maintainAspectRatio: false,
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
        yAxes: [{
          display: true,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          }
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  });
  var $visitorsPie = $('#visitors-pie');
  var dataPie = {
    labels: [],
    datasets: [{
      data: [],
      backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8'],
      hoverOffset: 4
    }]
  };
  var pieChartM = new Chart($visitorsPie, {
    type: 'pie',
    data: dataPie,
    options: {
      "hover": {
        "animationDuration": 0
      },
      legend: {
        "display": true,
        position: 'right'
      },
      "animation": {
        "duration": 1,
        "onComplete": function onComplete() {
          var chartInstance = this.chart,
              ctx = chartInstance.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function (bar, index) {
              var data = dataset.data[index]; //console.log(index);
              //if (index == 0) {
              //    ctx.fillText(data, bar._model.x, bar._model.y - 5);
              //}
            });
          });
        }
      }
    }
  });
  var $bbns = $('#bbns-pie');
  var dataPie = {
    labels: [],
    datasets: [{
      data: [],
      backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8'],
      hoverOffset: 4
    }]
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
        position: 'right'
      },
      "animation": {
        "duration": 1,
        "onComplete": function onComplete() {
          var chartInstance = this.chart,
              ctx = chartInstance.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function (bar, index) {
              var data = dataset.data[index]; //console.log(index);
              //if (index == 0) {
              //    ctx.fillText(data, bar._model.x, bar._model.y - 5);
              //}
            });
          });
        }
      }
    }
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // $.ajax({
  //   url: urlDtrans,
  //   dataType: 'JSON',
  //   method: 'POST',
  //   success: function success(result) {
  //     if (result.success) {
  //       visitorsChart.data.labels = result.data.labels;
  //       visitorsChart.data.datasets = result.data.datasets1;
  //       visitorsChart.update();
  //       salesChart.data.labels = result.data.labels;
  //       salesChart.data.datasets = result.data.datasets2;
  //       salesChart.update();
  //     }
  //   }
  // });
  // $.ajax({
  //   url: urlDbbn,
  //   method: 'POST',
  //   dataType: 'JSON',
  //   success: function success(result) {
  //     if (result.success) {
  //       pieChartM.data.labels = result.data.labels;
  //       pieChartM.data.datasets[0].data = result.data.status;
  //       pieChartM.update();
  //       pieChartBbns.data.labels = result.datax.labels;
  //       pieChartBbns.data.datasets[0].data = result.datax.status;
  //       pieChartBbns.update();
  //     }
  //   }
  // });
});
/******/ })()
;