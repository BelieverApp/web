@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'referrals'])

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Active Referrers</h2>
        <p>
          <a href="/client/referrals"><button class="btn btn-secondary">Referrals</button></a>
          <a><button class="btn btn-primary">Active Referrers</button></a>
        </p>
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-clients table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Referee</th>
                        <th>Email</th>
                        <th>Ref Code</th>
                        <th>Affiliation</th>
                        <th>Created</th>
                        <th>Client</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($entries as $e)
                <tr>
                    <td><a href="{{'/client/referrers-active/' . $e->id}}">{{ $e->name }}</a></td>
                    <td>{{ $e->email }}</td>
                    <td>{{ $e->refCode }}</td>
                    <td>{{ $e->affiliation === 0 ? 'Unassigned' : ($e->affiliation === 1 ? 'Customer' : 'Non-customer') }}</td>
                    <td>{{ $e->created }}</td>
                    <td>{{ $e->brand }}</td>
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
