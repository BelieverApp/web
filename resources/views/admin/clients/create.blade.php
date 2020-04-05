@extends('layouts.admin_layout')
@include('admin.includes.nav', ['section' => 'clients'])

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
                    <small>A short description of the client. This is used in various places throughout the app.</small>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Landing Page Title<span class="req">*</span></label>
                        <small>This is the slightly larger text on the landing page.</small>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="landingpage_title" name="landingpage_title" required></textarea>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Landing Page Content<span class="req">*</span></label>
                    <small>This is the paragraph on the landing page describing Believer for your client's users.</small>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="landingpage_content" name="landingpage_content" required></textarea>
                        </div>
                    </div>                    

                    <div class="form-group"><label class="col-sm-12 control-label">Primary Logo<span class="req">*</span></label>
                        <small>This is the primary logo for the client. It will also be displayed on the landing page inline with the content on that page. Choose the hight resolution logo you have available. The logo will resize automatically to be optimized.</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="clientimage" name="clientimage" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Secondary Logo</label>
                        <small>This logo goes above the call to action on the right side of the landing page. Could be a logo, or an image of any sort. Choose the hight resolution logo you have available. The logo will resize automatically to be optimized.</small>
                        <div class="input-group col-12">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" id="clientimage2" name="clientimage2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-12 control-label">Banner Image<span class="req">*</span></label>
                        <small>Choose the highest resolution image you have available. The banner will resize to 800px x 150px automatically.</small>
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

            <div class="form-group">
                <label class="col-sm-6 control-label">Referee URL</label>
                <div class="col-sm-10">
                    <input type="text" id="referee_url" name="referee_url" class="form-control"  placeholder="URL of client referee landing page">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6 control-label">Referral Css URL</label>
                <div class="col-sm-10">
                    <input type="text" id="referral_css_url" name="referral_css_url" class="form-control"  placeholder="URL of client css file for all referral pages">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-6 control-label">Products</label>
                <div class="col-sm-10">
                    <button id="product-add" class="btn btn-secondary mb-3" type="button">Add</button>
                    <div id="product-group"></div>

                    <div id="product-template" class="d-flex mb-1" style="display: none !important">
                        <input type="text" class="product-field form-control" placeholder="Product Name">
                        <button class="product-delete btn btn-small btn-danger" type="button"><i class="fa fa-close"></i></button>
                    </div>
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

@section('scripts')
  $(document).ready(() => {
    const addElement = text => {
      const instance = $('#product-template').clone();
      instance.css('display', 'inherit');
      instance.appendTo('#product-group');
      instance.find('input').val(text);

      instance.find('.product-delete').on('click', function() {
        $(this).parent().remove();
      });
    };

    $('#product-add').on('click', () => addElement());
  });
@endsection
