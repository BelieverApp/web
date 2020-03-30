@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'believers'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/client/believers/invite" role="button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Invite</a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link" href="/client/believers/audiences" role=""><i class="fa fa-users" aria-hidden="true"></i> Audiences</a>
</li> --}}
@endsection

@section('content')
<section class="section">

<div class="section-header">
    <h1>{{ $audience->name }}</h1>
{{--     <div class="section-header-breadcrumb">
        <form method="POST" class="form-inline" action="/client/believers/audiences">

            @csrf

            <label>Mission for this Audience: &nbsp;&nbsp;</label>
            <select class="form-control">
                @foreach($missions as $mission)
                <option value="{{ $mission->id }}">{{ $mission->name }}</option>
                @endforeach
            </select>

        </form>
    </div> --}}
</div>

<div class="section-body container">
    <div class="row justify-content-around">
    <div class="card" style="width: 49%;">
        <div class="card-body">
            <h6>Believers</h6>
                <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <table id="table_id" class="datatable-audience_believers table table-striped dataTable no-footer" style="font-size: 11px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Date Joined</th>
                                <th>Points</th>
                                <th>Missions</th>
                                <th>Rewards</th>
    {{--                             <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($followers as $f)
                        <tr id="client{{ $f->id }}">
                            <th><a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                            <td><a href="/client/believers/{{ $f->id }}">{{ $f->name }}</a></td>
                            <td>{{ $f->created_at }}</td>
                            <td>{{ $f->point_balance }}</td>
                            <td>{{ $f->mission_count }}</td>
                            <td>{{ $f->reward_count }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    <div class="card" style="width: 49%;">
        <div class="card-body">
            <h6>Audience Members</h6>
                <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <table id="table_id" class="datatable-audience_members table table-striped dataTable no-footer" style="font-size: 11px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Date Joined</th>
                                <th>Points</th>
                                <th>Missions</th>
                                <th>Rewards</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($audience_members as $a)
                        <tr id="client{{ $a->id }}">
                            <th><a href="#"><i class="fa fa-minus-square" aria-hidden="true"></i></a></th>
                            <td><a href="/client/believers/{{ $a->details->id }}">{{ $a->details->name }}</a></td>
                            <td>{{ $a->details->created_at }}</td>
                            <td>{{ $a->details->point_balance }}</td>
                            <td>{{ $a->details->mission_count }}</td>
                            <td>{{ $a->details->reward_count }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    </div>
</div>

<script>

    var members = [
        @foreach($audience_members as $a)
        {{ $a->details->id }},
        @endforeach
    ];

    console.log(members);

</script>


</section>
@endsection
