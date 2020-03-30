@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'referrals'])

@section('content')

<style>
    .swal-text{
        text-align: left !important;
        font-weight: normal !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-referrals table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Referred By</th>
                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($referrals as $r)
                <tr id="referral{{ $r->id }}">
                    <td>
                        @if($r->comments != "")
                        <a href="" onclick="(function(){swal(`{!!$r->comments!!}`); return false; })(); return false;">{{ $r->first_name }}</a>
                        @else
                        {{ $r->first_name }}
                        @endif
                    </td>
                    <td>
                        @if($r->comments != "")
                        <a href="" onclick="(function(){swal(`{!!$r->comments!!}`); return false; })(); return false;">{{ $r->last_name }}</a>
                        @else
                        {{ $r->last_name }}
                        @endif
                    </td>
                    <td>{{ $r->email }}</td>
                    <td>{{ $r->phone }}</td>
                    <td><a href="/client/believers/{{ $r->referred_by_details->id }}">{{ $r->referred_by_details->first }} {{ $r->referred_by_details->last }}</a></td>
                    <td>{{ $r->created_at }}</td>
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
