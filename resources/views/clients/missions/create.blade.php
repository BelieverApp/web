@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'missions'])

@section('content')
<form method="POST" enctype="multipart/form-data" action="/client/missions" class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" id="challenge_type" name="challenge_type" value="1" />

    <div class="card">
        <div class="card-header"><h4>Create a New Mission</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-6">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Mission Type<span class="req">*</span></label>
                        <div class="col-sm-10">
                           <select class="form-control" id="challenge_type" name="challenge_type">
                               <option value="" id=""></option>
                               @foreach($challenge_types as $ct)
                               <option value="{{ $ct->id }}" id="challenge_type_{{ $ct->id }}">{{ $ct->type }}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Title<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Shareable URL<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="challenge_url" name="challenge_url" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Description<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-6 control-label">Start and End Date<span class="req">*</span></label>

                        <div class="col-sm-10">
                            <small><input type="checkbox" class="form-control-inline" id="no_end_date" name="no_end_date" value="no_end_date"> This Mission has no end date and starts now</small>

                            <input type="text" id="mission_create_daterange" class="form-control" id="missionrange" name="missionrange" value="">
                            <input type="hidden" id="start" name="start" value="" />
                            <input type="hidden" id="end" name="end" value="" />





                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Image<span class="req">*</span></label>
                        <small>Choose the highest resolution image you have. We will resize the image to fit the best for the user's phone, with the center of your image being the center of the image on the phone. Landscape oriented images work best.</small>
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
            <button class="client-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Create Mission</span></button>
            <a class="btn btn-white" href="/admin/clients"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>

@endsection
