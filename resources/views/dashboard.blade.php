@extends("layouts.app")
@section('content')
<div class="row">
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="row w-100 flex-grow">
            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <p class="card-title">  Data Penduduk Kelurahan
                    @foreach($informations as $information)
                    {{ $information->village_name  }}
                    @endforeach
                       </p>

                        <p class="text-muted">
                          Kecamatan
                    @foreach($informations as $information)
                    {{ $information->sub_district_name  }}
                    @endforeach

                    Kota
                    @foreach($informations as $information)
                    {{ $information->district_name  }}
                    @endforeach</p>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between traffic-status">
                                    <div class="item">
                                        <p class="mb-">Penduduk Aktif</p>
                                        <h1 class="font-weight-bold mb-0">{{$countCitizens}}</h1>


                                        <div class="color-border"></div>
                                    </div>
                                    <div class="item">
                                        <p class="mb-">Total Laki Laki</p>
                                        <h1 class="font-weight-bold mb-0">{{$countCitizensMen}}</h1>
                                        <div class="color-border"></div>
                                    </div>
                                    <div class="item">
                                        <p class="mb-">Total Perempuan</p>
                                        <h1 class="font-weight-bold mb-0">{{$countCitizensWomen}}</h1>
                                        <div class="color-border"></div>
                                    </div>
                                    <div class="item">
                                        <p class="mb-">Total KK</p>
                                        <a href="/family"><h1 class="font-weight-bold mb-0">{{$countKK}}</h1></a>
                                        <div class="color-border"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <canvas id="audience-chart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Penduduk Pindah</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="d-flex align-items-center flex-wrap mb-3">
                        <i class="mdi mdi-exit-to-app icon-lg text-info"></i>
                        <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countMove}}</h1>
                            <a href="/move" class="link-primary">Selengkapnya</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Penduduk DTKS</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="d-flex align-items-center flex-wrap mb-3">
                        <i class="mdi mdi-dropbox icon-lg text-warning"></i>
                        <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countDtks}}</h1>
                        <a href="/dtks" class="link-primary">Selengkapnya</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Penduduk Meninggal</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="d-flex align-items-center flex-wrap mb-3">
                        <i class="mdi mdi-account-multiple-minus icon-lg text-danger"></i>
                        <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countDeath}}</h1>
                        <a href="/death" class="link-primary">Selengkapnya</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>

    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="row w-100 flex-grow">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Rentang Usia</p>
                        <p class="text-muted"></p>
                        <div class="regional-chart-legend d-flex align-items-center flex-wrap mb-1"
                            id="regional-chart-legend"></div>
                        <canvas height="280" id="regional-chart"></canvas>
                          <!-- <p class="text">0-5 Th: <b>{{$countAge05}}</b> | 6-10 Th: <b>{{$countAge610}}</b>| 11-19 Th: <b>{{$countAge1119}} </b>
                          | 20-57 Th: <b>{{$countAge2057}}</b> 58+ Th: <b>{{$countAge58}}</b></p> -->

                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Berdasarkan Agama</p>
                        <!-- <div class="d-flex align-items-center flex-wrap server-status-legend mt-3 mb-3 mb-md-0">
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0"></h5>
                                    </div>
                                    <p class="mb-">Islam</p>
                                </div>
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0">92%</h5>
                                    </div>
                                    <p class="mb-">Kristen Protestan</p>
                                </div>
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0">16%</h5>
                                    </div>
                                    <p class="mb-">Kristen Katolik</p>
                                </div>
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0">16%</h5>
                                    </div>
                                    <p class="mb-">Hindu</p>
                                </div>
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0">16%</h5>
                                    </div>
                                    <p class="mb-">Buddha</p>
                                </div>
                                <div class="item me-3">
                                    <div class="d-flex align-items-center">
                                        <div class="color-bullet"></div>
                                        <h5 class="font-weight-bold mb-0">16%</h5>
                                    </div>
                                    <p class="mb-">Konguchu</p>
                                </div>
                            </div> -->
                        <p class="text-muted"></p>
                        <canvas height="280" id="activity-chart"></canvas>
                    </div>
                </div>
            </div>




            <div class="col-md-6 stretch-card">
                <div class="card">
                    <div class="card-body pb-0">
                        <p class="card-title">Berdasarkan Pernikahan</p>
                        <div class="d-flex justify-content-between flex-wrap">
                            <p class="text-muted">Data pernikahan</p>
                            <div class="d-flex align-items-center flex-wrap server-status-legend mt-3 mb-3 mb-md-0">



                            </div>
                        </div>
                    </div>
                    <canvas height="300" id="status-chart"></canvas>
                </div>
            </div>

            <div class="col-md-6 stretch-card">
                <div class="card">
                    <div class="card-body pb-0">
                        <p class="card-title">Berdasarkan Pekerjaan</p>
                        <div class="d-flex justify-content-between flex-wrap">
                            <p class="text-muted">Last update: 2 Hours ago</p>
                            <div class="d-flex align-items-center flex-wrap server-status-legend mt-3 mb-3 mb-md-0">



                            </div>
                        </div>
                    </div>
                    <canvas height="300" id="jobs-chart"></canvas>
                </div>
            </div>

        </div>
    </div>


    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="row w-100 flex-grow">

        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Berdasarkan Pendidikan</p>
                        <p class="text-muted"></p>

                        <canvas height="300" id="education-chart"></canvas>
                          <!-- <p class="text">0-5 Th: <b>{{$countAge05}}</b> | 6-10 Th: <b>{{$countAge610}}</b>| 11-19 Th: <b>{{$countAge1119}} </b>
                          | 20-57 Th: <b>{{$countAge2057}}</b> 58+ Th: <b>{{$countAge58}}</b></p> -->

                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Berdasarkan Disabilitas</p>
                        <p class="text-muted"></p>
                        <canvas height="300" id="disability-chart"></canvas>
                    </div>
                </div>
            </div>




        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Status Vaksin 1</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-check icon-lg text-success"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine1Y}}</h1>
                            </div>
                            </div>
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-multiple-minus icon-lg text-warning"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine1N}}</h1>
                            </div>
                            </div>
                        </div>

                    </div>
                    <canvas id="vaccine1-chart"></canvas>
                </div>
            </div>

            <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Status Vaksin 2</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-check icon-lg text-success"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine2Y}}</h1>
                            </div>
                            </div>
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-multiple-minus icon-lg text-warning"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine2N}}</h1>
                            </div>
                            </div>
                        </div>

                    </div>
                    <canvas id="vaccine2-chart"></canvas>
                </div>
            </div>

            <div class="col-md-4 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="card-title">Status Vaksin 3</p>
                            <!-- <p class="text-success font-weight-medium">20.15 %</p> -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-check icon-lg text-success"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine3Y}}</h1>
                            </div>
                            </div>
                            <div class="col-6">
                             <div class="d-flex align-items-center flex-wrap mb-3">
                              <i class="mdi mdi-account-multiple-minus icon-lg text-warning"></i>
                              <h1 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3"> {{$countVaccine3N}}</h1>
                            </div>
                            </div>
                        </div>

                    </div>
                    <canvas id="vaccine3-chart"></canvas>
                </div>
            </div>


    </div>
</div>
<!-- row end -->
<!-- <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-facebook d-flex align-items-center">
            <div class="card-body py-5">
                <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-facebook text-white icon-lg"></i>
                    <div class="ms-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">2.62 Subscribers</h5>
                        <p class="mt-2 text-white card-text">You main list growing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-google d-flex align-items-center">
            <div class="card-body py-5">
                <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-google-plus text-white icon-lg"></i>
                    <div class="ms-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">3.4k Followers</h5>
                        <p class="mt-2 text-white card-text">You main list growing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-twitter d-flex align-items-center">
            <div class="card-body py-5">
                <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-twitter text-white icon-lg"></i>
                    <div class="ms-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">3k followers</h5>
                        <p class="mt-2 text-white card-text">You main list growing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- row end -->
@endsection

  <!-- base:js -->
  <script src="{{asset('/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="{{asset('/js/dashboard.js')}}"></script> -->
<script>


(function($) {
  'use strict';
  $(function() {

    if ($("#vaccine1-chart").length) {
      var Vaccine1ChartCanvas = $("#vaccine1-chart").get(0).getContext("2d");
      var Vaccine1Chart = new Chart(Vaccine1ChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Sudah Vaksin", "Belum Vaksin"],
          datasets: [
            {
              label: 'Data Vaksin',
              data: [<?= $countVaccine1Y ?>,<?= $countVaccine1N ?>],
              backgroundColor: '#6640b2'
            },
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }

    if ($("#vaccine2-chart").length) {
      var Vaccine2ChartCanvas = $("#vaccine2-chart").get(0).getContext("2d");
      var Vaccine2Chart = new Chart(Vaccine2ChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Sudah Vaksin", "Belum Vaksin"],
          datasets: [
            {
              label: 'Data Vaksin',
              data: [<?= $countVaccine1Y ?>,<?= $countVaccine1N ?>],
              backgroundColor: '#6640b2'
            },
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }

    if ($("#vaccine3-chart").length) {
      var Vaccine3ChartCanvas = $("#vaccine3-chart").get(0).getContext("2d");
      var Vaccine3Chart = new Chart(Vaccine3ChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Sudah Vaksin", "Belum Vaksin"],
          datasets: [
            {
              label: 'Data Vaksin',
              data: [<?= $countVaccine3Y ?>,<?= $countVaccine3N ?>],
              backgroundColor: '#6640b2'
            },
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }

    if ($("#audience-chart").length) {
      var AudienceChartCanvas = $("#audience-chart").get(0).getContext("2d");
      var AudienceChart = new Chart(AudienceChartCanvas, {
        type: 'doughnut',
        data: {
          labels: ["Laki Laki", "Perempuan"],
          datasets: [
            {
              label: 'Offline Sales',
              data: [<?= $countCitizensMen ?>,<?= $countCitizensWomen ?>],
              backgroundColor: [
              '#73D2DE','#FBB13C'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: 400,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }

    if ($("#balance-chart").length) {
      var areaData = {
        labels: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun","Mon","Tue","Wed","Thu"],
        datasets: [
          {
            data: [2600, 1400, 2200, 1200, 2300, 2400, 2700, 1200, 2800, 2600, 1250, 1900, 1800, 2800, 2800, 1200, 2500, 2600, 1800, 1200, 2000, 1800, 2700, 1600, 2800, 2000, 2100, 1200, 2000, 1200, 1200, 2500],
            borderColor: [
              '#1faf47'
            ],
            borderWidth: 3,
            fill: false,
            label: "services"
          },
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              display: false,
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              fontColor: "#000",
              fontSize: 14,
              padding: 18,
              stepSize: 1000,
              max: 3000,
              fontSize: 10,
              fontColor: "#b1b0b0",
              callback: function(value) {
                var ranges = [
                    { divider: 1e6, suffix: 'M' },
                    { divider: 1e3, suffix: 'k' }
                ];
                function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                          return (n / ranges[i].divider).toString() + ranges[i].suffix;
                      }
                    }
                    return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              drawBorder: false,
              color: "#f8f8f8",
              zeroLineColor: "#f8f8f8"
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: 0
          },
          point: {
            radius: 0
          }
        }
      }
      var balanceChartCanvas = $("#balance-chart").get(0).getContext("2d");
      var balanceChart = new Chart(balanceChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#task-chart").length) {
      var taskChartCanvas = $("#task-chart").get(0).getContext("2d");
      var taskChart = new Chart(taskChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug"],
          datasets: [{
              label: 'Profit',
              data: [-3, -5, -5, 3, 4, -5, -1, 9],
              backgroundColor: '#f83e37'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                drawBorder: false,
                color: '#f1f3f9',
                zeroLineColor: '#f1f3f9'
              },
              ticks: {
                display: true,
                fontColor: "#9fa0a2",
                fontSize: 10,
                padding: 0,
                stepSize: 10,
                min: -10,
                max: 10
              }
            }],
            xAxes: [{
              display: false,
              stacked: false,
              categoryPercentage: 1,
              ticks: {
                display: false,
                beginAtZero: false,
                display: true,
                padding: 10,
                fontSize: 11
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              position: 'bottom',
              barPercentage: 0.7
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        }
      });
    }

    if ($("#regional-chart").length) {
      var regionalChartCanvas = $("#regional-chart").get(0).getContext("2d");
      var regionalChart = new Chart(regionalChartCanvas, {
        type: 'horizontalBar',
        data: {
          labels: ["0-5 Th", "6-10 Th", "11-19 Th", "20-57 Th", "58+ Th"],
          datasets: [
            {
              label: '',
              data: [<?= $countAge05 ?>,<?= $countAge610 ?>,<?= $countAge1119 ?>,<?= $countAge2057 ?>,<?= $countAge58 ?>],
              backgroundColor: [
              '#73D2DE','#FBB13C','#5e239d','#F61067','#04724d'
            ],
            },
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: -7,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                display: true,
                min: 0,
                max: 400,
                stepSize: 100,
                fontColor: '#2c2c2c', // X-Axis font color
          fontStyle: 'bold',    // X-Axis font style
                fontSize: 12,
                padding: 0
              },
              barPercentage: 1,
              categoryPercentage: .6,
            }],
            xAxes: [{
              display: true,
              stacked: false,
              ticks: {
                display: false,
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                display: true,
                drawBorder: false,
                lineWidth: 1,
                color: "#f5f5f5",
                zeroLineColor: "#f5f5f5"
              }
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          },
          legendCallback : function(chart) {
            var text = [];
              text.push('<div class="item me-4 d-flex align-items-center">');
                text.push('<div class="item-box me-2" style=" background-color: ' + chart.data.datasets[0].backgroundColor + ' "></div><p class="text-black mb-0"> ' + chart.data.datasets[0].label + '</p>');
              text.push('</div>');

            return text.join('');
          }
        },
      });
      document.querySelector('#regional-chart-legend').innerHTML = regionalChart.generateLegend();
    }

      if ($("#activity-chart").length) {
      var _ydata=JSON.parse('{!!json_encode($religionCounts)!!}');

      console.log("religioncounts",_ydata);
      var ActivityChartCanvas = $("#activity-chart").get(0).getContext("2d");
      var ActivityChart = new Chart(ActivityChartCanvas, {
        type: 'pie',
        data: {

          labels: [
            @foreach($religions as $data)
            '{{$data->religion}}',
            @endforeach

          ],

          datasets: [
            {
              data: Object.values(_ydata),
              backgroundColor: [
              '#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }


    if ($("#status-chart").length) {
      var countMarriage=JSON.parse('{!!json_encode($countMarriage)!!}');

      var StatusChartCanvas = $("#status-chart").get(0).getContext("2d");
      var StatusChart = new Chart(StatusChartCanvas, {
        type: 'bar',
        data: {

          labels: [
            @foreach($marriage as $data)
            '{{$data->marriage}}',
            @endforeach

          ],

          datasets: [
            {
              data: Object.values(countMarriage),
              backgroundColor: [
              '#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }

    if ($("#jobs-chart").length) {
      var countJobs=JSON.parse('{!!json_encode($countJobs)!!}');

      var JobsChartCanvas = $("#jobs-chart").get(0).getContext("2d");
      var JobsChart = new Chart(JobsChartCanvas, {
        type: 'pie',
        data: {

          labels: [
            @foreach($jobs as $data)
            '{{$data->job}}',
            @endforeach

          ],

          datasets: [
            {
              data: Object.values(countJobs ),
              backgroundColor: [
              '#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067'
              ,'#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }
    if ($("#education-chart").length) {
      var countEducations=JSON.parse('{!!json_encode($countEducations)!!}');

      var EducationChartCanvas = $("#education-chart").get(0).getContext("2d");
      var EducationChart = new Chart(EducationChartCanvas, {
        type: 'pie',
        data: {

          labels: [
            @foreach($educations as $data)
            '{{$data->last_education}}',
            @endforeach

          ],

          datasets: [
            {
              data: Object.values(countEducations ),
              backgroundColor: [
              '#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067'
              ,'#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }
    if ($("#disability-chart").length) {
      var countDisability=JSON.parse('{!!json_encode($countDisability)!!}');

      var DisabilityChartCanvas = $("#disability-chart").get(0).getContext("2d");
      var DisabilityChart = new Chart(DisabilityChartCanvas, {
        type: 'pie',
        data: {

          labels: [
            @foreach($disability as $data)
            '{{$data->disability}}',
            @endforeach

          ],

          datasets: [
            {
              data: Object.values(countDisability ),
              backgroundColor: [
              '#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067'
              ,'#F61067,#04724d','#73D2DE','#FBB13C','#5e239d','#F61067','#F61067'
            ],
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#f8f8f8",
                zeroLineColor: "#f8f8f8"
              },
              ticks: {
                display: true,
                min: 0,
                max: <?= $countCitizens ?>,
                stepSize: 100,
                fontColor: "#b1b0b0",
                fontSize: 10,
                padding: 10
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b0b0",
                fontSize: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: .9,
              categoryPercentage: .7,
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3,
              backgroundColor: '#ff4c5b'
            }
          }
        },
      });
    }


  });
})(jQuery);
</script>
