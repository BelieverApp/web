@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'referrals'])

@section('content')
<div>
    <div class="card">
        <div class="card-header"><h4>Referral Details</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data['name'] }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" class="form-control" value="{{ $data['email'] }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $data['phone'] }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Product</label>
                        <div class="col-sm-10">
                            <input type="text" id="product" name="product" class="form-control" value="{{ $data['product'] ?? 'None' }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Closed</label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="closed" name="closed" class="form-control" <?php if ($data['closed']) echo 'checked' ?>  disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h4>Referrer Details</h4></div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data['referrerName'] }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" class="form-control" value="{{ $data['referrerEmail'] }}" required disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
