@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'clients'])


@section('subnav')
    <h2 style="float: left; width: 100%;">{{ $client->name }}
    <span style="float: right; font-size: 60%;">
        <span class="nav-item">
            <a href="/{{ $client->unique_name }}" target="_blank">believerapp.com/<strong>{{ $client->unique_name }}</strong></a>
        </span>
        <span class="nav-item">
            <a class="btn btn-primary" href="/admin/clients/{{ $client->id }}/edit" role="button"><i class="fa fa-pencil-square-o"></i> Edit</a>
        </span>
    </span>
    </h2>
@endsection

@section('content')
<div class="row" style="padding: 10px 0px; background: url('https://res.cloudinary.com/believer/image/upload/c_fill,g_center,h_150,w_800,x_0/b_rgb:000000,co_rgb:ffffff,e_gradient_fade:0,f_jpg,o_80/{{ $client->banner }}') top left no-repeat; background-size: 100%;">
    <img src="https://res.cloudinary.com/believer/image/upload/c_fill,f_jpg,h_150,q_auto,w_150/{{$client-> logo }}" style="width: 150px; margin-left: 20px; border-radius: 75px; border: 1px solid white;" />
</div>

<div class="row" style="padding-top: 10px;">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Believers</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['follower_count'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-flag" aria-hidden="true"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Active Missions</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['active_missions'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Completions</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['mission_completions'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fa fa-trophy"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Points</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['total_points'] }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Leaderboard</h4>
                </div>
                <div class="card-body">
                    @php
                    $count = 1;
                    @endphp
                    @foreach($stats['leaderboard'] as $leader)


                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">{{ $leader->point_balance }}</div>
                        <div class="font-weight-bold mb-1">
                            @if ($count == 1)
                            <i class="fa fa-trophy" style="color: gold;" aria-hidden="true"></i>
                            @elseif ($count == 2)
                            <i class="fa fa-trophy" style="color: silver;" aria-hidden="true"></i>
                            @elseif ($count ==3 )
                            <i class="fa fa-trophy" style="color: tan;" aria-hidden="true"></i>
                            @else
                                {{ $count }}
                            @endif
                            &nbsp;&nbsp;&nbsp;{{ $leader->first }} {{ $leader->last }}
                        <small class="text-muted">&nbsp;&nbsp;{{ $leader->city }}, {{ $leader->province }}</small>
                        </div>

                    </div>
                    @php
                    $count++;
                    @endphp
                    @endforeach

                </div>
              </div>

            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>This Week Stats</h4>
                  <div class="card-header-action">
                  </div>
                </div>
                <div class="card-body">
                  <div class="summary">
                    <div class="summary-info">
                      <h4>{{ $stats['total_points_this_week'] }} points</h4>
                      <div class="text-muted">on {{ $stats['mission_completions_this_week'] }} completed missions.</div>
                      <div class="d-block mt-2">
                        {{-- <a href="#">View All</a> --}}
                      </div>
                      <br />
                      <h4>{{ $stats['new_followers_this_week'] }} new Believers</h4>

                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
@endsection
