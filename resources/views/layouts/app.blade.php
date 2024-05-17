<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
  </script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <!-- <meta name="twitter:site" content="@bootstrapdash">
    <meta name="twitter:creator" content="@bootstrapdash">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png"> -->

  <!-- Facebook -->
  <!-- <meta property="og:url" content="https://www.bootstrapdash.com/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600"> -->

  <!-- Meta -->
  <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
  <meta name="author" content="BootstrapDash">

  <title>{{ $title ?? 'Dashboard' }} - No Surat App</title>

  <!-- vendor css -->
  <link href="{{asset('vendor/azia/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/typicons.font/typicons.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/select2/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/pickerjs/picker.min.css')}}" rel="stylesheet">

  <!-- azia CSS -->
  <link rel="stylesheet" href="{{asset('vendor/azia/css/azia.css')}}">

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <div class="az-header">
    <div class="container">
      <div class="az-header-left">
        <a href="/dashboard" class="az-logo"><span></span> No Surat </a>
        <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
      </div><!-- az-header-left -->
      <div class="az-header-menu">
        <div class="az-header-menu-header">
          <a href="/dashboard" class="az-logo"><span></span> No Surat</a>
          <a href="" class="close">&times;</a>
        </div><!-- az-header-menu-header -->
        <ul class="nav">
          @if (Auth::user()->role_id == 1)
          <li class="nav-item @if(Request::path()=='dashboard')  active show @endif">
            <a href="/dashboard" class="nav-link"><i class="typcn typcn-chart-area-outline"></i>
              Dashboard</a>
          </li>
          @endif
          <li class="nav-item @if(Request::path()=='hari-ini' || Request::path()=='kastem')  active show @endif">
            <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Nomor Surat</a>
            <nav class="az-menu-sub">
              <a href="/hari-ini" class="nav-link @if(Request::path()=='hari-ini')  active  @endif">Hari ini</a>
              <a href="/kastem" class="nav-link @if(Request::path()=='kastem')  active  @endif">Kastem</a>
            </nav>
          </li>
          <li class="nav-item ">
            <a href="chart-chartjs.html" class="nav-link"><i class="typcn typcn-user-outline"></i>
              My Profile</a>
          </li>
          @if (Auth::user()->role_id == 1)

          <li
            class="nav-item @if(Request::path()=='data-pt' || Request::path()=='role' || Request::path()=='data-users' || Request::path()=='data-no-surat')  active show @endif">
            <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i> Data Master</a>
            <div class="az-menu-sub">
              <div class="container">
                <div>
                  <nav class="nav">
                    <a href="/role" class="nav-link @if(Request::path()=='role')  active @endif">Role</a>
                    <a href="/data-pt" class="nav-link @if(Request::path()=='data-pt')  active @endif">Data PT</a>
                    <a href="/data-users" class="nav-link  @if(Request::path()=='data-users')  active @endif">Data
                      Users</a>
                    <a href="/data-no-surat" class="nav-link @if(Request::path()=='data-no-surat')  active @endif">Data
                      No Surat</a>
                  </nav>
                </div>
              </div><!-- container -->
            </div>
          </li>
          @endif

        </ul>
      </div><!-- az-header-menu -->
      <div class="az-header-right">
        <div class="dropdown az-profile-menu">
          <a href="" class="az-img-user"><img src="{{asset('vendor/azia/img/faces/face1.jpg')}}" alt=""></a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header d-sm-none">
              <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <div class="az-header-profile">
              <div class="az-img-user">
                <img src="{{asset('vendor/azia/img/faces/face1.jpg')}}" alt="">
              </div><!-- az-img-user -->
              <h6>{{Auth::user()->first_name}} </h6>
              <span>
                @if(Auth::user()->status == TRUE)
                aktif
                @else
                tidak aktif
                @endif
              </span>
            </div><!-- az-header-profile -->

            <a href="/my-profile" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
            <a href="/activity-logs" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
            <a href="/logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign
              Out</a>
          </div><!-- dropdown-menu -->
        </div>
      </div><!-- az-header-right -->
    </div><!-- container -->
  </div><!-- az-header -->

  {{$slot}}

  <div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Nomor Surat
        2024</span>
    </div><!-- container -->
  </div><!-- az-footer -->

  @include('sweetalert::alert')

  <script src="{{asset('vendor/azia/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/ionicons/ionicons.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/chart.js/Chart.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/azia/lib/peity/jquery.peity.min.js')}}"></script>

  <script src="{{asset('vendor/azia/js/azia.js')}}"></script>
  <script src="{{asset('vendor/azia/js/chart.flot.sampledata.js')}}"></script>
  <script src="{{asset('vendor/azia/js/dashboard.sampledata.js')}}"></script>

  <script src="{{asset('vendor/lib/select2/js/select2.min.js')}}"></script>
  <script src="{{asset('vendor/lib/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
  <script src="{{asset('vendor/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
  <script src="{{asset('vendor/lib/pickerjs/picker.min.js')}}"></script>
  <script src="{{asset('vendor/js/azia.js')}}"></script>

  <script src="{{asset('vendor/azia/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script>
    $(function(){
        'use strict'

    		var plot = $.plot('#flotChart', [{
          data: flotSampleData3,
          color: '#007bff',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        },{
          data: flotSampleData4,
          color: '#560bd0',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 8
          },
    			yaxis: {
            show: true,
    				min: 0,
    				max: 100,
            ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
            tickColor: '#eee'
    			},
    			xaxis: {
            show: true,
            color: '#fff',
            ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
          }
        });

        $.plot('#flotChart1', [{
          data: dashData2,
          color: '#00cccc'
        }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0.2 }, { opacity: 0.2 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 35
          },
    			xaxis: {
            show: false,
            max: 50
          }
    		});

        $.plot('#flotChart2', [{
          data: dashData2,
          color: '#007bff'
        }], {
    			series: {
    				shadowSize: 0,
            bars: {
              show: true,
              lineWidth: 0,
              fill: 1,
              barWidth: .5
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 35
          },
    			xaxis: {
            show: false,
            max: 20
          }
    		});


        //-------------------------------------------------------------//


        // Line chart
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
          type: 'bar',
          data: {
            labels: [0,1,2,3,4,5,6,7],
            datasets: [{
              data: [2, 4, 10, 20, 45, 40, 35, 18],
              backgroundColor: '#560bd0'
            }, {
              data: [3, 6, 15, 35, 50, 45, 35, 25],
              backgroundColor: '#cad0e8'
            }]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              enabled: false
            },
            legend: {
              display: false,
                labels: {
                  display: false
                }
            },
            scales: {
              yAxes: [{
                display: false,
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  max: 80
                }
              }],
              xAxes: [{
                barPercentage: 0.6,
                gridLines: {
                  color: 'rgba(0,0,0,0.08)'
                },
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  display: false
                }
              }]
            }
          }
        });

        // Donut Chart
        var datapie = {
          labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
          datasets: [{
            data: [25,20,30,15,10],
            backgroundColor: ['#6f42c1', '#007bff','#17a2b8','#00cccc','#adb2bd']
          }]
        };

        var optionpie = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // For a doughnut chart
        var ctxpie= document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie,
          options: optionpie
        });

      });
  </script>
  @stack('role')
  @stack('data-pt')
  @stack('data-users')
  @stack('data-no-surat')
  @stack('hari-ini')
  @stack('kastem')
  @stack('kastem-admin')
</body>

</html>