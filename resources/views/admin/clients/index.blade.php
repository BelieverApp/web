@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'clients'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/admin/clients/create" role="button"><i class="fa fa-plus"></i> Add New Client</a>
</li>

<li class="nav-item">
    <a class="btn btn-primary" href="/admin/manager" role="button"><i class="fa fa-eye"></i> Administer Manager Accounts</a>
</li>

<li class="nav-item">
    <a class="btn btn-primary" href="/admin/manager/create" role="button"><i class="fa fa-plus"></i> Add a Manager Account</a>
</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Clients</h2>
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-clients table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Date Joined</th>
                        <th>Believers</th>
                        <th>Missions<br />Completed</th>
                        <th>Points<br />Awarded</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                <tr id="client{{ $client->id }}">
                    <td><a href="/admin/clients/{{ $client->id }}">{{ $client->name }}</a></td>
                    <td>{{ $client->created_at }}</td>
                    <td>{{ $client->total_believers }}</td>
                    <td>{{ $client->challenge_completions }}</td>
                    <td>{{ $client->total_points }}</td>
                    <td>
                        <h5><a href="#" class="req deleteClient" data-item-id="{{ $client->id }}"><i class="fa fa-trash"></i></a></h5>
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
