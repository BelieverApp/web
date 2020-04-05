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
    <div class="generate-link-page">
      <form class="generate-link-form" action="generate-link" method="post" target="_self">
        <input name="partyId" type="hidden" value="{{ $partyId }}">
        <input name="externalCss" type="hidden" value="{{ $externalCss ?? null }}">

        <div class="referrer-fields">
          <div class="input-group">
            <label for="referrer-name">Name</label>
            <input class="referrer-name" name="name" id="referrer-name" type="text" placeholder="Name" required>
          </div>

          <div class="input-group">
            <label for="referrer-email">Email</label>
            <input class="referrer-email" name="email" id="referrer-email" type="email" placeholder="Email" required>
          </div>
        </div>

        <button class="generate-link-submit" type="submit">Generate Link</button>
      </form>
    </div>
  </body>
</html>
