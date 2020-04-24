<html>
  <head>
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
      <div class="instructions">
        Enter your name and email to get your personal referral link. Then use it to invite your friends and family to explore building a new home with Morrison.
      </div>

      <form class="generate-link-form" action="generate-link" method="post" target="_self">
        <input name="partyId" type="hidden" value="{{ $partyId }}">

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

        <button class="generate-link-submit" type="submit"><i class="generate-link-icon"></i>Get Your Link</button>
      </form>
    </div>
  </body>
</html>
