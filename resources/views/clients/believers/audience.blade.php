@extends('layouts.client_layout')

@section('mainnav')
<li class="nav-item"><a href="/client/missions" class="nav-link">Missions</a></li>
<li class="nav-item active"><a href="/client/believers" class="nav-link">Believers</a></li>
<li class="nav-item"><a href="/client/messages" class="nav-link">Messages</a></li>
<li class="nav-item"><a href="/client/referrals" class="nav-link">Referrals</a></li>
<li class="nav-item"><a href="/client/reports" class="nav-link">Reports</a></li>
@endsection

@section('subnav')
<li class="nav-item">
    <a class="nav-link" href="/client/believers/invite" role=""><i class="fa fa-envelope-o" aria-hidden="true"></i> Invite</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/client/believers/audiences" role=""><i class="fa fa-users" aria-hidden="true"></i> Audiences</a>
</li>
@endsection

@section('content')
<section class="section">

<div class="section-header">
    <h1>{{ $audience->name }}</h1>
    <div class="section-header-breadcrumb">
        <form method="POST" class="form-inline" action="/client/believers/audiences">

            @csrf

            <label>Mission for this Audience: &nbsp;&nbsp;</label>
            <select class="form-control">
                @foreach($missions as $mission)
                <option value="{{ $mission->id }}">{{ $mission->name }}</option>
                @endforeach
            </select>

        </form>
    </div>
</div>

<div class="section-body container">
    <div class="row justify-content-around">
    <div class="card col-5">
        <div class="card-body p-10">
            <h6>Believers</h6>
            <select multiple="" class="form-control" id="" style="height: 200px;">
                @foreach($followers as $follower)
                    <option value="{{ $follower->id }}">{{ $follower->first }} {{ $follower->last }}</option>
                @endforeach

            </select>

        </div>
    </div>

    <div class="card col-5">
        <div class="card-body p-10">
            <h6>Audience Members</h6>
        </div>
    </div>



    </div>
</div>

</section>
@endsection
