@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'referrals'])

@section('content')
<div>
    <div class="card">
        <div class="card-header"><h4>Active Referrer Details</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" class="form-control" value="{{ $data->email }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Reference Code</label>
                        <div class="col-sm-10">
                            <input type="text" id="ref-code" name="ref-code" class="form-control" value="{{ $data->refCode }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Brand</label>
                        <div class="col-sm-10">
                            <input type="text" id="brand" name="brand" class="form-control" value="{{ $data->brand }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Created</label>
                        <div class="col-sm-10">
                            <input type="text" id="brand" name="brand" class="form-control" value="{{ $data->created }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Customer Affiliation</label>
                        <div class="col-sm-10">
                            <select class="custom-select detail-customer-affiliation" name="customer-affiliation" id="customer-affiliation" data-referrer-id="{{$data->id}}">
                                <option value="0" {{ $data->customerAffiliation == 1 ? 'selected="selected"' : '' }}>Unassigned</option>
                                <option value="1" {{ $data->customerAffiliation == 2 ? 'selected="selected"' : '' }}>Customer</option>
                                <option value="2" {{ $data->customerAffiliation == 3 ? 'selected="selected"' : '' }}>Non-Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
