<html>
  <head>
<?php
if(isset($externalCss)) {
?>
    <link rel="stylesheet" href={{ $externalCss }}>
<?php
}
?>
  </head>
  <body>
    <div class="generate-link-page">
      <div class="instructions">
          Enter your name and email to get your personal referral link. Then use it to invite your friends to book a new home consultation
      </div>

      <form class="generate-link-form" action="generate-link" method="get" target="_self">
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
