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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
                <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <table id="table_id" class="datatable-believers table table-striped dataTable no-footer">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Joined</th>
                            <th>Points</th>
                            <th>Missions<br />Completed</th>
                            <th>Rewards<br />Claimed</th>
{{--                             <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($followers as $f)
                    <tr id="client{{ $f->id }}">
                        <td><a href="/client/believers/{{ $f->id }}">{{ $f->name }}</a></td>
                        <td>{{ $f->created_at }}</td>
                        <td>{{ $f->point_balance }}</td>
                        <td>{{ $f->mission_count }}</td>
                        <td>{{ $f->reward_count }}</td>
{{--                         <td>
                            <h3><a href="#" class="req deleteClient" data-item-id="{{ $f->id }}"><i class="fa fa-trash"></i></a></h3>
                        </td> --}}
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
