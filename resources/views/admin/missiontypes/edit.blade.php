@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'mission'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/admin/missiontypes/create" role="button"><i class="fa fa-plus"></i> Add New Mission Type</a>
</li>
@endsection

@section('content')

<form method="POST" action="/admin/missiontypes/update" class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" name="mission_type_id" id="mission_type_id" value="{{ $mission_type->id }}" />
    <div class="card">
        <div class="card-header"><h4>Edit Mission Type: {{ $mission_type->type }}</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-12">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name<span class="req">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" id="type" name="type" class="form-control" value="{{$mission_type->type}}" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Points<span class="req">*</span></label>
                        <div class="col-sm-12">
                            <input type="number" id="points" name="points" class="form-control" value="{{$mission_type->points}}" required>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="client-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Save Mission Types</span></button>
            <a class="btn btn-white" href="/admin/missiontypes"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>
@endsection

@section('scripts')

@endsection
