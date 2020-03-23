@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'manager'])

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
    <h2>Manager Accounts</h2>
        <div class="card">
            <div class="card-body p-10">
            <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <table id="table_id" class="datatable-manageraccounts table table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Account Name</th>
                        <th>Account Email</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                <tr id="manageraccount{{ $account->id }}">
                    <td>{{ $account->brand }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->created_at }}</td>
                    <td>
                        <h5><a href="#" class="req deleteManagerAccount" data-item-id="{{ $account->id }}"><i class="fa fa-trash"></i></a></h5>
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
