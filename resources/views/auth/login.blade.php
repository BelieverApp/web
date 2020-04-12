<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Believer</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/css/app.css">

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary">
              <div class="login-brand">
              <img src="/images/logo-light.png" alt="logo" width="250" class="">
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="/password/reset" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control">
                        <input name="remember" type="checkbox" class="form-check-input" id="remember" tabindex="3">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="/signup">Create One</a>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
