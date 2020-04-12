<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CLIENT</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@5.23.2/dist/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.10.2/css/all.css">

</head>

<body>

<div style="margin-bottom: 20px;">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/client"><img src="/images/logo-dark.png" width="150" /></a>
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
        <ul class="navbar-nav mr-auto">
          @yield('subnav')
        </ul>
      </div>
    </div>
  </nav>
  @endif

</div>


  <main role="main" class="container" style="clear: both;">
    @yield('content')
  </main>
  <script src="//cdn.jsdelivr.net/npm/medium-editor@5.23.2/dist/js/medium-editor.min.js"></script>
  <script src="/js/app.js"></script>
    @yield('scripts')
</body>

