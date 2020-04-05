<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>

<div style="margin-bottom: 20px;">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/admin"><img src="/images/logo-dark.png" width="150" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        @yield('mainnav')
      </ul>
    </div>

    @include('clients.includes.user_nav')
  </nav>

  @if(View::hasSection('subnav'))
  <nav class="navbar navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">

          @yield('subnav')

      </div>
    </div>
  </nav>
  @endif

</div>


  <main role="main" class="container" style="clear: both;">
    @yield('content')
  </main>

  <script src="/js/app.js"></script>
  <script>
    (() => {
      @yield('scripts')
    })();
  </script>
</body>

