@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => ''])

@section('content')
<div class="section-body">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Believers</h4>
          </div>
          <div class="card-body">
            {{ $believer_count }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fa fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Active Challenges</h4>
          </div>
          <div class="card-body">
            {{ $challenge_count }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fa fa-trophy"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Challenges Completed <small>Active</small></h4>
          </div>
          <div class="card-body">
            {{ $completions }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
            <h4>Statistics - 10 Days</h4>
        </div>
        <div class="card-body">
            <canvas id="myChart" width="400" height="200"></canvas>
            <script>
            window.onload = function(){
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            @foreach($days as $day)
                                "{{ $day }}",
                            @endforeach
                        ],
                        datasets: [
                        {
                            label: 'New Believers',
                            fill: false,
                            backgroundColor: '#35AFC8',
                            borderColor: '#35AFC8',
                            data: [
                            @foreach($new_users as $users)
                                {{ $users }},
                            @endforeach
                            ],
                        },
                        {
                            label: 'Completed Challenges',
                            fill: false,
                            backgroundColor: '#ff0000',
                            borderColor: '#ff0000',
                            data: [
                            @foreach($challenges_completed as $completions)
                                {{ $completions }},
                            @endforeach
                            ],
                        },

                        ]
                    },
                });
            }
            </script>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
