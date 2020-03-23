@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'rewards'])

@section('subnav')
<li class="nav-item"><h2>Edit: {{ $reward->title }}</h2></li>
@endsection

@section('content')

<form id="editreward" name="editreward" method="POST" enctype="multipart/form-data" action="/admin/updateReward" class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" name="reward_id" id="reward_id" value="{{ $reward->id }}" />
    <div class="card">
        <div class="card-header"><h4>Reward Details</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-12">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="title" name="title" class="form-control" value="{{ $reward->title }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Points<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="points" name="points" class="form-control" value="{{ $reward->points }}" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description">{{ $reward->description }}</textarea>

                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Image<span class="req">*</span></label>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="col-6">
                            @if(!$reward->image)
                            <img src="https://res.cloudinary.com/believer/image/upload/" width="150" />
                            @else
                            <img src="https://res.cloudinary.com/believer/image/upload/{{ $reward->image }}" width="150" />
                            @endif
                        </div>

                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="rewardimage" name="rewardimage">
                            </div>
                            <!-- <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div> -->
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>



    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="event-create btn btn-primary editReward" type="submit"><i class="fa fa-check"></i><span> Update Reward</span></button>
            <a class="btn btn-white" href="/admin/rewards"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>
@endsection

@section('scripts')

@endsection
