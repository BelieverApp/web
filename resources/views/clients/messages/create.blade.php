@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'messages'])


@section('content')

<form method="POST" id="message-form" enctype="multipart/form-data" action="/client/messages" class="form-horizontal">
    @csrf
    <input type="hidden" name="brand_id" id="brand_id" value="{{ $brand_id }}" />
    <input type="hidden" name="body" id="body" value="{{ $brand_id }}" />
    <div class="card">
        <div class="card-header"><h4>Create a New Message</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-7">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Subject<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="subject" name="subject" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Banner Image<span class="req">*</span></label>
                        <small>Recommended Size: 800px x 150px</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="bannerimage" name="bannerimage" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Message<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <div class="editable" required></div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Action Title<span class="req">*</span></label>
                        <small>This is the text that will appear on the action button at the bottom of your message.</small>
                        <div class="col-sm-10">
                            <input type="text" id="action_title" name="action_title" class="form-control" value="" required />
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Action URL<span class="req">*</span></label>
                        <small>When the action button is clicked, this is where the user will be taken. <br />
                        <strong>Don't foget to include 'https://'</strong></small>
                        <div class="col-sm-10">
                            <input type="text" id="action_url" name="action_url" class="form-control" value="" required />
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    {{-- <div class="form-group">
                        <label class="col-sm-12 control-label">Audience</label>
                        <small>Select an audience to send this message to, or send to all your followers.</small>
                        <div class="col-sm-10">
                            <select name="audience_select" id="audience_select" class="form-control">
                                <option value="all">Send to all followers</option>
                                @foreach($audiences as $audience)
                                    <option value="{{ $audience->id }}">{{ $audience->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Start and End Date<span class="req">*</span></label>
                        <small>Messages will automatically be removed from a users inbox after the end date</small>

                        <small><input type="checkbox" class="form-control-inline" id="no_end_date" name="no_end_date" value="no_end_date"> This Message has no end date and will be sent now</small>

                        <div class="col-sm-10">
                            <input type="text" id="message_create_daterange" class="form-control" id="messagerange" name="messagerange" value="">
                            <input type="hidden" id="start" name="start" value="{{ date("Y-m-d H:i:s") }}" />
                            <input type="hidden" id="end" name="end" value="" />
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="message-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Create Message</span></button>
            <a class="btn btn-white" href="/clients/messages"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>

@endsection
