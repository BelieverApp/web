@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'manager'])

@section('subnav')
<li class="nav-item">
    <h2>Create a Manager Account</h2>
    <p>Here is where you will be able to associate a manager (client) account with a brand. Please make sure that you have first created the new brand. That can be done <a href="/admin/clients/create">here</a>.</p>
    <p>
        If a user with the same email exists then a new account will not be made and the existing user will be made the manager.
    </p>
</li>
@endsection

@section('content')

<form method="POST" enctype="multipart/form-data" action="/admin/clients" class="form-horizontal needs-validation">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-10">
                <div class="row">
                    <div class="col-12">
                        <label class="control-label" for="email">Select a Client <span class="req">*</span></label>
                        <select class="form-control" id="brand_select" name="brand_select" class="brand_select">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" data-clientid="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="control-label" for="first_name">First Name <span class="req">*</span></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required />
                    </div>
                    <div class="col-6">
                        <label class="control-label" for="last_name">Last Name <span class="req">*</span></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label class="control-label" for="email">Email Address <span class="req">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" required />
                        <label class="control-label" for="email">Confirm Email Address <span class="req">*</span></label>
                        <input type="text" class="form-control" name="confirm_email" id="confirm_email" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label class="control-label" for="password">Password <span class="req">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" required />
                        <br />
                        <input class="btn btn-lg btn-primary createManagerAccount" type="button" name="button" value="Create Manager Account" />
                    </div>

                </div>


            </div>
        </div>
        </div>
    </div>
@endsection

</form>
