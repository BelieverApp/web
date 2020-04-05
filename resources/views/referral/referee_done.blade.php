<html>
  <head>
<?php
if(isset($externalCss)) {
?>
    <link rel="stylesheet" href={{ $externalCss }}>
<?php
}
?>

<?php
if(isset($cssUrl)) {
?>
    <link rel="stylesheet" href="{{ $cssUrl }}">
<?php
}
?>
  </head>
  <body>
    <div class="referee-submitted-page">
      <div class="submitted-message">
        Your request has been submitted and we will be in touch shortly.
      </div>
    </div>
  </body>
</html>
