@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'missions'])


@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/client/missions/create" role="button"><i class="fa fa-plus"></i> Create a New Mission</a>
</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-missions table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Name</th>

                        <th>Start</th>
                        <th>End</th>
                        <th>Completed</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($missions as $mission)
                <tr id="mission{{ $mission->id }}">
                    <td><a href="/client/missions/{{ $mission->id }}">{{ $mission->name }}</a></td>

                    <td>{{ $mission->start }}</td>
                    <td>{{ $mission->end }}</td>
                    <td>{{ $mission->completion_count }}</td>
                    <td>
                        <h5><a href="#" class="req deleteMission" data-item-id="{{ $mission->id }}"><i class="fa fa-trash"></i></a></h5>
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
