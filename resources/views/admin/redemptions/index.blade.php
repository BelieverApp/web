@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'redeem'])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-redemptions table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Reward</th>
                        <th>Redemption Date</th>
                        <th>Completed At</th>
                        <th>Complete</th>
                    </tr>
                </thead>
                <tbody>
                
                @if(count($redemptions) > 1)
                <tr>
                    <td colspan="5">
                    No redemptions yet....
                    </td>
                </tr>
                @else

                    @foreach($redemptions as $r)
                    <tr id="redemption{{ $r->id }}">
                        <td><strong>{{ $r->user->first }} {{ $r->user->last}}</strong>
                            <p style="font-weight: normal; line-height: 1.2">
                                {{$r->user->address1}}<br />
                                @if($r->user->address2)
                                {{$r->user->address2}}<br />
                                @endif
                                {{$r->user->city}}, {{$r->user->province}}<br />
                                {{$r->user->postal_code}}<br />
                                {{$r->user->email}}<br />
                            </p>
                        </td>
                        <td>{{ $r->reward->title }}</td>
                        <td>{{ $r->created_at }}</td>
                        <td>{{ $r->completed }}</td>
                        {{-- <td>{{ $client->total_believers }}</td>
                        <td>{{ $client->challenge_completions }}</td>
                        <td>{{ $client->total_points }}</td> --}}
                        <td>
                            <h5>
                                @if($r->completed)
                                <a href="#" class="redeemed markAsRedeemed" data-item-id="{{ $r->id }}"><i class="fa fa-check"></i></a>
                                @else
                                <a href="#" class="notRedeemed markAsRedeemed" data-item-id="{{ $r->id }}"><i class="fa fa-check"></i></a>
                                @endif
                            </h5>
                        </td>
                    </tr>

                    @endforeach
                    
                @endif
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
