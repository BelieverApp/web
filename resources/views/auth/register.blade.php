<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Believer</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/css/app.css">

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="/images/logo-light.png" alt="logo" width="250" class="">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">

                <form class="form" id="registration_form">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="control-label" for="first_name">First Name <span class="req">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required />
                        </div>
                        <div class="col-6">
                            <label class="control-label" for="last_name">Last Name <span class="req">*</span></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="control-label" for="email">Email Address <span class="req">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" required />
                            <label class="control-label" for="email">Confirm Email Address <span class="req">*</span></label>
                            <input type="text" class="form-control" name="confirm_email" id="confirm_email" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="control-label">Address <span class="req">*</span></label>
                            <input type="text" id="address1" name="address1" class="form-control" value="" placeholder="Address Line 1" required>
                            <input type="text" id="address2" name="address2" class="form-control" value="" placeholder="Address Line 2 (optional)">

                            <div class="input-group form-group">
                                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="" required>
                                <input type="text" class="form-control" name="province" id="province" placeholder="Province/State" value="" required>
                                <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal/Zip Code" value="" required>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="control-label" for="password">Password <span class="req">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" required />
                            <br />
                            <input class="btn btn-lg btn-primary registerWithBrand" type="button" name="button" value="Register" />
                            <a href="{{ env("BELIEVER_APP_STORE_LINK") }}"><img src="/images/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" width="auto" /></a>
                        </div>

                    </div>

          {{--     <form method="POST" action="{{ route('register') }}">
                        @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" name="frist_name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" name="last_name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password-confirm">
                    </div>
                  </div>

                  <div class="form-divider">
                    Your Home
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Country</label>
                      <select class="form-control selectric">
                        <option>Indonesia</option>
                        <option>Palestine</option>
                        <option>Syria</option>
                        <option>Malaysia</option>
                        <option>Thailand</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label>Province</label>
                      <select class="form-control selectric">
                        <option>West Java</option>
                        <option>East Java</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>City</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-6">
                      <label>Postal Code</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form> --}}
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Culturebrand, Inc. <?=date('Y')?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <!-- General JS Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
