@extends('layouts.admin_layout')

@section('subnav')
<li><h2>Add a New Client</h2></li>
@endsection

@section('content')
<form method="POST" action="/admin/clients" class="form-horizontal">
    @csrf

    <div class="card">
        <div class="card-header"><h4>Client Details</h4></div>

        <div class="card-body">        
            <div class="row">

                <div class="col-6">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Unique Name<span class="req">*</span></label>
                        <small>This the landing page alias (i.e. believerapp.com/<strong>timhortons</strong>). Needs to be one word, lowercase. Can contain dashes(-) or underscores(_).</small>
                        <div class="col-sm-10">
                            <input type="text" id="unique_name" name="unique_name" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Description<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description"></textarea>

                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Logo<span class="req">*</span></label>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="input-group mb-3 col-sm-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                    </div>
            </div>


        
        <div class="col-6">
       
            <div class="form-group">
                <label class="col-sm-6 control-label">Address<span class="req">*</span></label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control" value="" placeholder="Address Line 1"><br />
                    <input type="text" id="name" name="name" class="form-control" value="" placeholder="Address Line 2 (optional)">
                </div>
            </div>


            <div class="input-group form-group col-10">
                <input type="text" class="form-control" placeholder="City">
                <input type="text" class="form-control" placeholder="Province/State">
                <input type="text" class="form-control" placeholder="Postal/Zip Code">
            </div>            

            <div class="form-group">
                <label class="col-sm-6 control-label">Phone<span class="req">*</span></label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control" value="" placeholder="Phone 1"><br />
                    <input type="text" id="name" name="name" class="form-control" value="" placeholder="Phone 2 (optional)">
                </div>
            </div>


        </div>
        </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="client-create btn btn-lg btn-primary" type="submit"><i class="fa fa-check"></i><span> Create New Client</span></button>
            <a class="btn btn-lg btn-white" href="/admin/clients"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>
@endsection