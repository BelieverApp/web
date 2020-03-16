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
    <form class="generate-link-form" action="generate-link" method="post" target="_self">
      <input class="generate-link-name" name="name" type="text" placeholder="Name" required>
      <input class="generate-link-email" name="email" type="email" placeholder="Email" required>
      <input name="partyId" type="hidden" value="{{ $partyId }}">
      <button class="generate-link-submit" type="submit">Generate Link</button>
    </form>
  </body>
</html>
