@extends('layouts.client_layout')

@section('mainnav')
<li class="nav-item"><a href="/client/missions" class="nav-link">Missions</a></li>
<li class="nav-item active"><a href="/client/believers" class="nav-link">Believers</a></li>
<li class="nav-item"><a href="/client/referrals" class="nav-link">Referrals</a></li>
<li class="nav-item"><a href="/client/reports" class="nav-link">Reports</a></li>
@endsection

@section('content')

            <h2 class="section-title">{{ $user->first }} {{ $user->last }}
                <small class="text-muted">Joined on {{ $user->created_at }}</small>
            </h2>

            <div class="row">
              <div class="col-4">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="/images/placeholder.jpg" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Missions</div>
                        <div class="profile-widget-item-value">{{ $stats['completion_count'] }}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Rewards</div>
                        <div class="profile-widget-item-value">{{ $stats['redemptions_count'] }}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Points</div>
                        <div class="profile-widget-item-value">{{ $user->point_balance }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <p>{{ $user->email}}</p>
                    {{ $user->address1 }}<br />
                    @if($user->address2)
                    {{ $user->address2 }}<br />
                    @endif
                    {{ $user->city }}, {{ $user->province }}<br />
                    {{ $user->postal_code }}<br />
                  </div>
{{--                   <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">Follow {{ $user->first }}</div>
                    <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-instagram">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div> --}}
                </div>
              </div>
              <div class="col-8">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Missions Completed</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <td>Brand</td>
                                <td>Mission Title</td>
                                <td>Points</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($missions as $mission)
                        <tr>
                            <td>{{ $mission->client_info->name }}</td>
                            <td>{{ $mission->name }}</td>
                            <td>{{ $mission->points }}</td>
                            <td>{{ $mission->completed_at }}</td>

                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">

                    </div>
                  </form>
                </div>

                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Rewards Claimed</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <td>Reward</td>
                                <td>Points</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($rewards as $reward)
                        <tr>
                            <td>{{ $reward->title }}</td>
                            <td>{{ $reward->points }}</td>
                            <td>{{ $reward->claimed_at }}</td>

                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">

                    </div>
                  </form>
                </div>
              </div>
            </div>

@endsection
