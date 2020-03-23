@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'rewards'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/admin/rewards/create" role="button"><i class="fa fa-plus"></i> Add New Reward</a>
</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-rewards table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rewards as $reward)
                <tr id="reward{{ $reward->id }}">
                    <td><a href="/admin/rewards/{{ $reward->id }}">{{ $reward->title }}</a></td>
                    @if(!$reward->image)
                    <td><img src="https://res.cloudinary.com/believer/image/upload/c_scale,w_100/placeholder.jpg" width="100" /></td>
                    @else
                    <td><img src="https://res.cloudinary.com/believer/image/upload/c_scale,w_100/{{ $reward->image }}" width="100" /></td>
                    @endif
                    <td>{{ $reward->description }}</td>
                    <td>{{ $reward->points }}</td>
                    <td>
                        @if( $reward->active_status == 1 )
                            <h3><small>OFF</small><i class="fa fa-toggle-on publishReward" aria-hidden="true" data-state="1" data-item-id="{{ $reward->id }}"></i><small>ON</small></h3>
                        @else
                            <h3><small>OFF</small><i class="fa fa-toggle-off publishReward" aria-hidden="true" data-state="0" data-item-id="{{ $reward->id }}""></i><small>ON</small></h3>
                        @endif
                    </td>
                    <td>
                        <h5><a href="#" class="req deleteReward" data-item-id="{{ $reward->id }}"><i class="fa fa-trash"></i></a></h5>
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

