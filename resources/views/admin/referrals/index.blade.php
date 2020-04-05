@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'referrals'])

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Referrals</h2>
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-clients table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Referee</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Referrer</th>
                        <th>Closed</th>
                        <th>Client</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($entries as $e)
                <tr>
                    <td><a href="/admin/referrals/{{ $e['id'] }}">{{ $e['name'] }}</a></td>
                    <td>{{ $e['email'] }}</td>
                    <td>{{ $e['phone'] }}</td>
                    <td>{{ $e['product'] ?? 'None' }}</td>
                    <td>{{ $e['created_at'] }}</td>
                    <td>{{ $e['referrerName'] }}</td>
                    <td><input class="req toggleClosed" type="checkbox" <?php if ($e['closed']) echo 'checked'?> data-referral-id="{{ $e['id'] }}"></input></td>
                    <td>{{ $e['client'] }}</td>
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
