@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'messages'])


@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/client/messages/create" role="button"><i class="fa fa-plus"></i> Create a New Message</a>
</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-messages table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Sent To</th>
                        <th>Subject</th>
                        <th>Body</th>
                        <th>Created</th>
                        <th>Start</th>
                        <th>End</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                <tr id="message{{ $message->id }}">
                    <td>{{ $message->sendCount }}</td>
                    <td><a href="/client/messages/{{ $message->id }}">{{ $message->subject }}</a></td>
                    <td>{!! $message->trunc_body !!}</td>
                    <td>{{ $message->created_at }}</td>
                    <td>{{ $message->start }}</td>
                    <td>{{ $message->end }}</td>
                    <td>
                        <h5><a href="#" class="req deleteMessage" data-item-id="{{ $message->id }}"><i class="fa fa-trash"></i></a></h5>
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
