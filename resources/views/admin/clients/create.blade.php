@extends('layouts.admin_layout')

@section('mainnav')
<li class="nav-item active"><a href="/admin/clients" class="nav-link">Clients</a></li>
<li class="nav-item"><a href="/admin/rewards" class="nav-link">Rewards</a></li>
<li class="nav-item"><a href="/admin/reports" class="nav-link">Reports</a></li>
@endsection

@section('subnav')
<li><h2>Add a New Client</h2></li>
@endsection

@section('content')
<form method="POST" enctype="multipart/form-data" action="/admin/clients" class="form-horizontal needs-validation">
    @csrf

    <div class="card">
        <div class="card-header"><h4>Client Details</h4></div>

        <div class="card-body">
            <div class="row">

                <div class="col-6">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Name<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Unique Name<span class="req">*</span></label>
                        <small>This the landing page alias (i.e. believerapp.com/<strong>timhortons</strong>). Needs to be one word, lowercase. Can contain dashes(-) or underscores(_).</small>
                        <div class="col-sm-10">
                            <input type="text" id="unique_name" name="unique_name" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Description<span class="req">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>

                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Primary Logo<span class="req">*</span></label>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="clientimage" name="clientimage" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Secondary Logo</label>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="clientimage2" name="clientimage2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Banner Image<span class="req">*</span></label>
                        <small>Some info about the specs for a logo file should go here...</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="bannerimage" name="bannerimage" required>
                            </div>
                        </div>
                    </div>
            </div>



        <div class="col-6">

            <div class="form-group">
                <label class="col-sm-6 control-label">Address<span class="req">*</span></label>
                <div class="col-sm-10">
                    <input type="text" id="address1" name="address1" class="form-control" value="" placeholder="Address Line 1" required><br />
                    <input type="text" id="address2" name="address2" class="form-control" value="" placeholder="Address Line 2 (optional)">
                </div>
            </div>


            <div class="input-group form-group col-10">
                <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
                <input type="text" id="province" name="province" class="form-control" placeholder="Province/State" required>
                <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Postal/Zip Code" required>
            </div>

            <div class="form-group">
                <label class="col-sm-6 control-label">Phone<span class="req">*</span></label>
                <div class="col-sm-10">
                    <input type="text" id="phone1" name="phone1" class="form-control" value="" placeholder="Phone 1" required><br />
                    <input type="text" id="phone2" name="phone2" class="form-control" value="" placeholder="Phone 2 (optional)">
                </div>
            </div>


        </div>
        </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="client-create btn btn-primary" type="submit"><i class="fa fa-check"></i><span> Create New Client</span></button>
            <a class="btn btn-white" href="/admin/clients"><i class="fa fa-close"></i> Cancel</a>

        </div>
    </div>
</form>
@endsection
