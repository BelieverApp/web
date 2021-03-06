@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'reports'])

@section('content')
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Referrals</h4>
        </div>
        <div class="card-body">
          <div class="form-row mb-2">
            <div class="col-auto">
              <label for="filter-date-range">Date Range</label>
              <select id="filter-date-range" class="form-control" style="width: 200px;">
                <option value="last_week">Last Week</option>
                <option value="last_month">Last Month</option>
                <option value="last_year">Last Year</option>
                <option value="custom">Custom</option>
              </select>
            </div>

            <div id="filter-date-range-input-container" class="col-auto filter-date-group" style="display: none">
              <label for="filter-date-range-input">Range</label>
              <input id="filter-date-range-input" type="text" class="form-control" name="" value="" style="min-width: 220px;">
            </div>

            <div class="col-auto">
              <label for="filter-area">Area</label>
              <select id="filter-area" class="form-control" style="width: 200px;">
                <option value="all">All Areas</option>

                @foreach ($areas as $area)
                  <option value="{{ $area }}">{{ $area }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-home"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Unique Visits</h4>
          </div>
          <div id="unique-visits" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-friends"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Active Referrers</h4>
          </div>
          <div id="active-referrers" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-check"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Influential Referrers</h4>
          </div>
          <div id="influential-referrers" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-trophy"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Successful Referrers</h4>
          </div>
          <div id="successful-referrers" class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-sign-in-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Referred Visitors</h4>
          </div>
          <div id="referred-visitors" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-clipboard-check"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Referred Leads</h4>
          </div>
          <div id="referred-leads" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Referred Sales</h4>
          </div>
          <div id="referred-sales" class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-percentage"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Online Referral Rate</h4>
          </div>
          <div id="online-referral-rate" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-percentage"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Lead Conversion Rate</h4>
          </div>
          <div id="lead-conversion-rate" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-percentage"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Sales Conversion Rate (sales to total online referrals)</h4>
          </div>
          <div id="sales-stor" class="card-body">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-percentage"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Sales Conversion Rate (sales to lead conversion)</h4>
          </div>
          <div id="sales-slc" class="card-body">
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="/js/app/reportsClient.js"></script>
@endsection
