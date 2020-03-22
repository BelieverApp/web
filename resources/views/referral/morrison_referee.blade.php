<html>
  <head>
    <style>
      iframe {
        border: none;
      }
    </style>
  </head>
  <body>
    <div>
      <h1>morrison referee</h1>
      <iframe id="believer-frame" src=""></iframe>
    </div>
  </body>
  <script>
    const params = new URLSearchParams(document.location.search.substring(1));
    document.getElementById('believer-frame').src = '{{env('APP_URL')}}/referee?css=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css&id=' + params.get('id');
  </script>
</html>
