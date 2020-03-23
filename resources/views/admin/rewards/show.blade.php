@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'rewards'])

@section('subnav')
<li class="nav-item"><h2>{{ $reward->title }}</h2></li>
</ul>
<ul class="navbar-nav pull-right" style="float: right;">

    <li class="nav-item">
        <a class="btn btn-primary" href="/admin/rewards/{{ $reward->id }}/edit" role="button"><i class="fa fa-pencil-square-o"></i> Edit</a>
    </li>

@endsection

@section('content')
<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-gift" aria-hidden="true"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Redemptions</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['redemptions_count'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-gift" aria-hidden="true"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Redeptions This Week</h4>
                  </div>
                  <div class="card-body">
                    {{ $stats['redemptions_this_week_count'] }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="card">
{{--                 <div class="card-header">
                  <h4>Redemptions</h4>
                </div> --}}
                <div class="card-body">

                    <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="table_id" class="datatable-redemptions table table-striped dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Date Claimed</th>
                                <th>Remaining Points</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($stats['claims'] as $claim)
                        <tr id="reward{{ $reward->id }}">
                            <td>{{ $claim->first }} {{ $claim->last }}<br />
                                <small class="text-muted">{{ $claim->email }}</small>
                            </td>
                            <td>{{ $claim->address1 }}<br />
                                {{ $claim->address2}}
                                {{ $claim->city }}, {{ $claim->province }}<br />
                                {{ $claim->postal_code }}
                            </td>
                            <td>{{ $claim->redeemed_at }}</td>
                            <td>{{ $claim->point_balance }}<br />
                                 <small class="text-muted">as of {{ now() }}</small>
                            </td>
                        </tr>

                        @endforeach
                        </tbody>
                        </table>
                    </div>
              </div>

            </div>

          </div>
        </div>

@endsection
