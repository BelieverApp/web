@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'missions'])

@section('content')

<form id="editclient" name="editclient" method="POST" enctype="multipart/form-data" action="/client/updateMission" class="form-horizontal">
    @csrf
    <input type="hidden" name="mission_id" id="mission_id" value="{{ $mission->id }}" />

    <div class="card">
        <div class="card-header"><h4>Edit Mission Details</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Title<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $mission->name }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Misson Type<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="challenge_type" name="challenge_type" required>
                                <option></option>
                                @foreach($challenge_types as $type)
                                    @if( $type->id == $mission->challenge_type)
                                    <option value="{{ $type->id }}" selected>{{ $type->type }}</option>
                                    @else
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Description<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description" required>{{ $mission->content }}</textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Start and End Date<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="mission_create_daterange" class="form-control" id="missionrange" name="missionrange" value="{{ $mission->start_trimmed }} - {{ $mission->end_trimmed }}">
                            <input type="hidden" id="start" name="start" value="{{ $mission->start }}" />
                            <input type="hidden" id="end" name="end" value="{{ $mission->end }}" />
                        </div>
                    </div>



                    <div class="form-group"><label class="col-sm-12 control-label">Image<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <img src="/uploads/missions/{{ $mission->image }}" />
                        </div>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="missionimage" name="missionimage" required>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <!-- <button class="event-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Update Client</span></button> -->
            <a class="event-create btn btn-primary editMission" href="#"><i class="fa fa-check"></i><span> Update Mission</span></button>
            <a class="btn btn-white" href="/client/missions"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>
@endsection

@section('scripts')

@endsection
